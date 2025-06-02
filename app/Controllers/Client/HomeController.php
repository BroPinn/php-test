<?php
namespace App\Controllers\Client;

use App\Models\Product;
use App\Models\Slider;

/**
 * Home Controller
 * Handles home page and general client requests
 */
class HomeController extends ClientController {
    
    private $productModel;
    private $sliderModel;
    
    public function __construct() {
        parent::__construct();
        $this->productModel = new Product();
        // $this->sliderModel = new Slider(); // Will be created later
    }
    
    /**
     * Display home page
     */
    public function home() {
        $this->setTitle('Welcome');
        $this->setMeta('OneStore - Your favorite online shopping destination');
        
        $this->view('pages.home', [
            'message' => 'Your new PHP application is working!',
            'featured_products' => []
        ]);
    }
    
    /**
     * Display about page
     */
    public function about() {
        $this->setTitle('About Us');
        $this->setMeta('Learn more about OneStore and our mission');
        $this->addBreadcrumb('About');
        
        $this->view('pages.about');
    }
    
    /**
     * Display shop page
     */
    public function shop() {
        $this->setTitle('Shop');
        $this->setMeta('Browse our collection of products');
        $this->addBreadcrumb('Shop');
        
        $this->view('pages.shop', [
            'products' => []
        ]);
    }
    
    /**
     * Display checkout page
     */
    public function checkout() {
        $this->setTitle('Shopping Cart');
        $this->setMeta('Review your cart and proceed to checkout');
        $this->addBreadcrumb('Shopping Cart');
        
        // Sample cart items for demonstration
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Fresh Strawberries',
                'image' => 'item-cart-04.jpg',
                'price' => 36.00,
                'quantity' => 1,
                'total' => 36.00
            ],
            [
                'id' => 2,
                'name' => 'Lightweight Jacket',
                'image' => 'item-cart-05.jpg',
                'price' => 16.00,
                'quantity' => 1,
                'total' => 16.00
            ]
        ];
        
        $subtotal = array_sum(array_column($cartItems, 'total'));
        $shipping = 0; // Free shipping
        $total = $subtotal + $shipping;
        
        $this->view('pages.checkout', [
            'cart_items' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }
    
    /**
     * Display blog page
     */
    public function blog() {
        $this->setTitle('Blog');
        $this->setMeta('Read our latest news and updates');
        $this->addBreadcrumb('Blog');
        
        $this->view('pages.blog', [
            'posts' => []
        ]);
    }
    
    /**
     * Display contact page
     */
    public function contact() {
        $this->setTitle('Contact Us');
        $this->setMeta('Get in touch with us');
        $this->addBreadcrumb('Contact');
        
        $this->view('pages.contact');
    }
    
    /**
     * Display homepage
     */
    public function index() {
        // Set page metadata
        $this->setTitle('Welcome to OneStore');
        $this->setMeta('OneStore - Your trusted e-commerce partner offering quality products at best prices', 'ecommerce, shopping, online store, products');
        
        try {
            // Get featured products
            $featuredProducts = $this->productModel->getFeatured(8);
            
            // Get sliders (placeholder for now)
            $sliders = [
                [
                    'title' => 'Welcome to OneStore',
                    'subtitle' => 'Best Products at Best Prices',
                    'image' => 'slider/slider1.jpg',
                    'link_url' => '/shop',
                    'button_text' => 'Shop Now'
                ],
                [
                    'title' => 'New Collection',
                    'subtitle' => 'Discover Latest Trends',
                    'image' => 'slider/slider2.jpg',
                    'link_url' => '/shop',
                    'button_text' => 'Explore'
                ]
            ];
            
            // Render the view
            $this->view('pages.home', [
                'featured_products' => $featuredProducts,
                'sliders' => $sliders,
                'page_type' => 'homepage'
            ]);
            
        } catch (\Exception $e) {
            // Log error and show fallback
            error_log("Homepage error: " . $e->getMessage());
            
            $this->view('pages.home', [
                'featured_products' => [],
                'sliders' => [],
                'error' => 'Unable to load homepage content. Please try again later.'
            ]);
        }
    }
    
    /**
     * Handle AJAX requests for featured products
     */
    public function ajaxFeaturedProducts() {
        if (!$this->isAjax()) {
            $this->json(['error' => 'Invalid request'], 400);
        }
        
        try {
            $limit = $this->getInput('limit', 8);
            $category = $this->getInput('category');
            
            if ($category) {
                $products = $this->productModel->getByCategory($category, $limit);
            } else {
                $products = $this->productModel->getFeatured($limit);
            }
            
            $this->json([
                'success' => true,
                'products' => $products,
                'count' => count($products)
            ]);
            
        } catch (\Exception $e) {
            error_log("AJAX featured products error: " . $e->getMessage());
            $this->json(['error' => 'Unable to load products'], 500);
        }
    }
}
?> 