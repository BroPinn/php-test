<?php use App\Helpers\Helper; ?>

<!-- Shop Title -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Products
                </button>

                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" 
                            data-filter=".<?= strtolower(Helper::sanitize($category['name'])) ?>">
                        <?= Helper::sanitize($category['name']) ?>
                    </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Filter
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="dis-none panel-filter w-full p-t-10">
            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                <div class="filter-col1 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">Sort By</div>
                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-sort="newest">
                                Newest Products
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-sort="price-low">
                                Price: Low to High
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-sort="price-high">
                                Price: High to Low
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col2 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">Price</div>
                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-price="0-50">
                                $0.00 - $50.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-price="50-100">
                                $50.00 - $100.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-price="100-150">
                                $100.00 - $150.00
                            </a>
                        </li>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-price="150+">
                                $150.00+
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col3 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">Tags</div>
                    <div class="flex-w p-t-4 m-r--5">
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $tag): ?>
                            <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5" data-tag="<?= Helper::sanitize($tag) ?>">
                                <?= Helper::sanitize($tag) ?>
                            </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="dis-none panel-search w-full p-t-10 p-b-15">
            <div class="bor8 dis-flex p-l-15">
                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
            </div>
        </div>

        <!-- Product -->
        <div class="row isotope-grid" id="product-grid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= strtolower($product['catName'] ?? 'general') ?>">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="<?= Helper::upload($product['image_path'] ?: 'placeholder.jpg') ?>" 
                                 alt="<?= Helper::sanitize($product['productName']) ?>">

                            <a href="/product/<?= $product['productID'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="/product/<?= $product['productID'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    <?= Helper::sanitize($product['productName']) ?>
                                </a>

                                <span class="stext-105 cl3">
                                    <?= Helper::formatCurrency($product['price']) ?>
                                    <?php if (!empty($product['sale_price']) && $product['sale_price'] < $product['price']): ?>
                                        <span class="old-price text-muted text-decoration-line-through">
                                            <?= Helper::formatCurrency($product['sale_price']) ?>
                                        </span>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" 
                                   data-product-id="<?= $product['productID'] ?>">
                                    <img class="icon-heart1 dis-block trans-04" 
                                         src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" 
                                         src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/client/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center p-t-50 p-b-50">
                        <i class="zmdi zmdi-shopping-cart fs-60 cl6 m-b-20"></i>
                        <h4 class="mtext-111 cl2 p-b-16">No Products Found</h4>
                        <p class="stext-113 cl6">Try adjusting your filters or search terms.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Load more -->
        <?php if (!empty($products) && count($products) >= $per_page): ?>
        <div class="flex-c-m flex-w w-full p-t-45">
            <button id="load-more-btn" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" 
                    data-page="<?= $current_page + 1 ?>">
                Load More
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productGrid = document.getElementById('product-grid');
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    // Filter functionality
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            filterProducts(filter);
            
            // Update active button
            document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('how-active1'));
            this.classList.add('how-active1');
        });
    });
    
    // Search functionality
    const searchInput = document.querySelector('input[name="search-product"]');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            searchProducts(this.value);
        }, 300));
    }
    
    // Load more functionality
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            loadMoreProducts(page);
        });
    }
    
    // Wishlist functionality
    document.querySelectorAll('.js-addwish-b2').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            addToWishlist(productId);
        });
    });
    
    function filterProducts(filter) {
        const products = document.querySelectorAll('.isotope-item');
        products.forEach(product => {
            if (filter === '*' || product.classList.contains(filter.replace('.', ''))) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }
    
    function searchProducts(query) {
        if (query.length < 2) return;
        
        fetch('/shop/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateProductGrid(data.products);
            }
        })
        .catch(error => console.error('Search error:', error));
    }
    
    function loadMoreProducts(page) {
        fetch(`/shop/load-more?page=${page}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.products.length > 0) {
                appendProducts(data.products);
                loadMoreBtn.setAttribute('data-page', parseInt(page) + 1);
                
                if (data.products.length < <?= $per_page ?>) {
                    loadMoreBtn.style.display = 'none';
                }
            } else {
                loadMoreBtn.style.display = 'none';
            }
        })
        .catch(error => console.error('Load more error:', error));
    }
    
    function addToWishlist(productId) {
        fetch('/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Added to wishlist!', 'success');
            } else {
                showNotification(data.message || 'Failed to add to wishlist', 'error');
            }
        })
        .catch(error => {
            console.error('Wishlist error:', error);
            showNotification('An error occurred', 'error');
        });
    }
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    function updateProductGrid(products) {
        // Implementation for updating product grid
        // This would replace the current products with search results
    }
    
    function appendProducts(products) {
        // Implementation for appending more products
        // This would add new products to the existing grid
    }
    
    function showNotification(message, type) {
        // Reuse the notification function from cart.php
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show position-fixed`;
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 5000);
    }
});
</script> 