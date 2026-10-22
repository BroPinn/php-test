<?php
namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Helpers\Helper;
use App\Models\Cart;

/**
 * Client Base Controller
 * Base controller for all client-side controllers
 */
abstract class ClientController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        
        // Client-specific initialization
        $this->setData('site_name', APP_NAME);
        $this->setData('page_title', APP_NAME);
        $this->loadSharedCartData();
    }
    
    /**
     * Get view path for client views
     */
    protected function getViewPath($view) {
        return ROOT_PATH . '/app/Views/Client/' . str_replace('.', '/', $view) . '.php';
    }
    
    /**
     * Get current customer if logged in
     */
    protected function getCurrentUser() {
        if (isset($_SESSION['customer_id'])) {
            // Load customer data from database
            return [
                'id' => $_SESSION['customer_id'],
                'name' => $_SESSION['customer_name'] ?? '',
                'email' => $_SESSION['customer_email'] ?? ''
            ];
        }
        return null;
    }
    
    /**
     * Check if customer is logged in
     */
    protected function requireAuth() {
        if (!$this->getCurrentUser()) {
            Helper::flash('error', 'Please login to continue');
            $this->redirect('/login');
        }
    }
    
    /**
     * Get cart item count
     */
    protected function getCartCount() {
        if ($this->getData('cart_count') !== null) {
            return (int) $this->getData('cart_count');
        }

        $cartItems = $this->resolveCurrentCartItems();
        return array_reduce($cartItems, function ($sum, $item) {
            return $sum + (int) ($item['quantity'] ?? 0);
        }, 0);
    }
    
    /**
     * Render client view with layout
     */
    protected function view($view, $data = []) {
        // Use default client layout
        $layout = $data['layout'] ?? 'layouts.main';
        unset($data['layout']);
        
        $this->renderWithLayout($view, $layout, $data);
    }
    
    /**
     * Set page title
     */
    protected function setTitle($title) {
        $this->setData('page_title', $title . ' - ' . APP_NAME);
    }
    
    /**
     * Set meta description
     */
    protected function setMeta($description, $keywords = '') {
        $this->setData('meta_description', $description);
        $this->setData('meta_keywords', $keywords);
    }
    
    /**
     * Add breadcrumb
     */
    protected function addBreadcrumb($title, $url = null) {
        $breadcrumbs = $this->getData('breadcrumbs') ?? [];
        $breadcrumbs[] = ['title' => $title, 'url' => $url];
        $this->setData('breadcrumbs', $breadcrumbs);
    }

    protected function resolveCurrentCartItems() {
        $user = $this->getCurrentUser();
        $customerID = $user ? $user['id'] : null;
        $sessionId = $customerID ? null : session_id();

        $cartModel = new Cart();
        return $cartModel->getCartItems($customerID, $sessionId);
    }

    protected function calculateCartSubtotal($cartItems) {
        return array_reduce($cartItems, function ($sum, $item) {
            $lineTotal = $item['total'] ?? ((float) ($item['price'] ?? 0) * (int) ($item['quantity'] ?? 0));
            return $sum + (float) $lineTotal;
        }, 0.0);
    }

    protected function loadSharedCartData() {
        $cartItems = $this->resolveCurrentCartItems();
        $subtotal = $this->calculateCartSubtotal($cartItems);
        $shipping = $subtotal > 100 ? 0.0 : ($subtotal > 0 ? 10.0 : 0.0);
        $totalItems = array_reduce($cartItems, function ($sum, $item) {
            return $sum + (int) ($item['quantity'] ?? 0);
        }, 0);

        $this->setData('header_cart_items', $cartItems);
        $this->setData('header_cart_totals', [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
            'total_items' => $totalItems,
        ]);
        $this->setData('cart_count', $totalItems);
    }
}
?> 
