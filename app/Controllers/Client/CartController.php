<?php
namespace App\Controllers\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Helpers\Helper;
use Exception;

/**
 * CartController - Handles shopping cart operations
 * 
 * Endpoints:
 * - GET  /cart       - Display cart page
 * - GET  /cart/get   - Get cart data (AJAX)
 * - POST /cart/add   - Add item to cart
 * - POST /cart/update - Update item quantity
 * - POST /cart/remove - Remove item from cart
 * - POST /cart/clear  - Clear entire cart
 */
class CartController extends ClientController
{
    private Cart $cartModel;
    private Product $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new Cart();
        $this->productModel = new Product();
    }


    public function index()
    {
        $cartData = $this->getCartData();

        // Clear error flash if cart is empty (show nice empty state instead)
        if (empty($cartData['items'])) {
            unset($_SESSION['flash']['error']);
            $this->data['flash_messages'] = [];
        }

        $this->setData('cart_items', $cartData['items']);
        $this->setData('subtotal', $cartData['subtotal']);
        $this->setData('shipping', $cartData['shipping']);
        $this->setData('total', $cartData['total']);
        $this->setData('page_title', 'Shopping Cart - ' . APP_NAME);

        $this->view('pages.cart');
    }

    public function get()
    {
        $this->ensureSession();
        $this->jsonResponse();

        try {
            $cartData = $this->getCartData();

            echo json_encode([
                'success' => true,
                'cart_items' => $cartData['items'],
                'cart_totals' => [
                    'subtotal' => $cartData['subtotal'],
                    'shipping' => $cartData['shipping'],
                    'total' => $cartData['total'],
                    'total_items' => $cartData['count']
                ]
            ]);
        } catch (Exception $e) {
            $this->errorResponse('Error loading cart', $e);
        }

        exit;
    }

    public function add()
    {
        $this->ensureSession();
        $this->jsonResponse();

        try {
            $input = $this->getJsonInput();
            $productID = $input['product_id'] ?? null;
            $quantity = (int) ($input['quantity'] ?? 1);

            // Validate
            if (!$productID) {
                return $this->error('Product ID is required');
            }

            $product = $this->productModel->find($productID);
            if (!$product) {
                return $this->error('Product not found');
            }

            if ($product['stock_quantity'] < $quantity) {
                return $this->error('Insufficient stock');
            }

            // Add to cart
            [$customerID, $sessionId] = $this->getCartIdentifier();
            $result = $this->cartModel->addItem($customerID, $sessionId, $productID, $quantity);

            if ($result) {
                $cartData = $this->getCartData();
                $this->success('Item added to cart', $cartData);
            } else {
                $this->error('Failed to add item to cart');
            }

        } catch (Exception $e) {
            $this->errorResponse('An error occurred', $e);
        }
    }

    public function update()
    {
        $this->ensureSession();
        $this->jsonResponse();

        try {
            $input = $this->getJsonInput();
            $cartID = $input['cart_id'] ?? null;
            $productID = $input['productID'] ?? $input['product_id'] ?? null;
            $quantity = (int) ($input['quantity'] ?? 1);

            [$customerID, $sessionId] = $this->getCartIdentifier();

            // Remove if quantity is 0 or less
            if ($quantity <= 0) {
                $result = $this->removeItemInternal($cartID, $productID, $customerID, $sessionId);
                if ($result) {
                    $cartData = $this->getCartData();
                    $this->success('Item removed from cart', $cartData, 'removed');
                } else {
                    $this->error('Failed to remove item');
                }
                return;
            }

            // Update quantity
            if ($productID && !$cartID) {
                $result = $this->cartModel->updateByProduct($customerID, $sessionId, $productID, $quantity);
            } elseif ($cartID) {
                $result = $this->cartModel->updateQuantity($cartID, $quantity);
            } else {
                return $this->error('Cart ID or Product ID is required');
            }

            if ($result) {
                $cartData = $this->getCartData();
                $this->success('Cart updated', $cartData, 'updated');
            } else {
                $this->error('Failed to update cart');
            }

        } catch (Exception $e) {
            $this->errorResponse('An error occurred', $e);
        }
    }

    public function remove()
    {
        $this->jsonResponse();

        try {
            $input = $this->getJsonInput();
            $cartID = $input['cart_id'] ?? null;
            $productID = $input['product_id'] ?? null;

            if (!$cartID && !$productID) {
                return $this->error('Cart ID or Product ID is required');
            }

            [$customerID, $sessionId] = $this->getCartIdentifier();
            $result = $this->removeItemInternal($cartID, $productID, $customerID, $sessionId);

            if ($result) {
                $cartData = $this->getCartData();
                $this->success('Item removed from cart', $cartData);
            } else {
                $this->error('Failed to remove item');
            }

        } catch (Exception $e) {
            $this->errorResponse('An error occurred', $e);
        }
    }

    public function clear()
    {
        $this->jsonResponse();

        try {
            [$customerID, $sessionId] = $this->getCartIdentifier();
            $result = $this->cartModel->clearCart($customerID, $sessionId);

            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Cart cleared',
                    'cart_count' => 0,
                    'cart_total' => Helper::formatCurrency(0)
                ]);
            } else {
                $this->error('Failed to clear cart');
            }

        } catch (Exception $e) {
            $this->errorResponse('An error occurred', $e);
        }
    }



    /**
     * Ensure session is started
     */
    private function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set JSON response header
     */
    private function jsonResponse(): void
    {
        header('Content-Type: application/json');
    }

    /**
     * Get JSON input from request body
     */
    private function getJsonInput(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    /**
     * Get customer ID and session ID for cart operations
     * @return array [customerID, sessionId]
     */
    private function getCartIdentifier(): array
    {
        $user = $this->getCurrentUser();
        $customerID = $user ? $user['id'] : null;
        $sessionId = $customerID ? null : session_id();
        return [$customerID, $sessionId];
    }

    /**
     * Get complete cart data
     */
    private function getCartData(): array
    {
        [$customerID, $sessionId] = $this->getCartIdentifier();
        $items = $this->cartModel->getCartItems($customerID, $sessionId);

        $subtotal = array_sum(array_column($items, 'total'));
        $shipping = $subtotal > 100 ? 0 : 10.00; // Free shipping over $100
        $count = array_sum(array_column($items, 'quantity'));

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
            'count' => $count
        ];
    }

    /**
     * Internal method to remove item by cartID or productID
     */
    private function removeItemInternal(?int $cartID, ?int $productID, ?int $customerID, ?string $sessionId): bool
    {
        if ($cartID) {
            return $this->cartModel->removeItem($cartID);
        } elseif ($productID) {
            return $this->cartModel->removeByProduct($customerID, $sessionId, $productID);
        }
        return false;
    }

    private function success(string $message, array $cartData, ?string $action = null): void
    {
        $response = [
            'success' => true,
            'message' => $message,
            'cart_count' => $cartData['count'],
            'cart_total' => Helper::formatCurrency($cartData['subtotal']),
            'cart_items' => $cartData['items']
        ];

        if ($action) {
            $response['action'] = $action;
        }

        echo json_encode($response);
    }

    /**
     * Send error JSON response
     */
    private function error(string $message): void
    {
        echo json_encode(['success' => false, 'message' => $message]);
    }

    /**
     * Send error response with exception logging
     */
    private function errorResponse(string $message, Exception $e): void
    {
        error_log("Cart error: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $message . ': ' . $e->getMessage(),
            'cart_items' => [],
            'cart_totals' => ['subtotal' => 0, 'shipping' => 0, 'total' => 0, 'total_items' => 0]
        ]);
    }
}