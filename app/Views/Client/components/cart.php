<?php use App\Helpers\Helper; ?>

<?php
$header_cart_items = $header_cart_items ?? [];
$header_cart_totals = $header_cart_totals ?? [
    'subtotal' => 0,
    'shipping' => 0,
    'total' => 0,
    'total_items' => 0,
];
?>

<!-- Modal Shopping Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">Your Cart</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="header-cart-items">
                <?php foreach ($header_cart_items as $item): ?>
                    <li class="header-cart-item flex-w flex-t m-b-12" data-product-id="<?= (int) ($item['product_id'] ?? $item['productID'] ?? 0) ?>" data-cart-id="<?= (int) ($item['cartID'] ?? 0) ?>">
                        <div class="header-cart-item-img">
                            <img src="<?= Helper::upload($item['image_path'] ?? $item['image'] ?? 'placeholder.jpg') ?>"
                                 alt="<?= Helper::sanitize($item['name'] ?? $item['productName'] ?? 'Product') ?>"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </div>

                        <div class="header-cart-item-txt p-t-8 flex-grow-1">
                            <a href="<?= Helper::url('product/' . ((int) ($item['product_id'] ?? $item['productID'] ?? 0))) ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                <?= Helper::sanitize($item['name'] ?? $item['productName'] ?? 'Product') ?>
                            </a>

                            <div class="flex-w flex-sb-m">
                                <span class="header-cart-item-info">
                                    <?= (int) ($item['quantity'] ?? 0) ?> x <?= Helper::formatCurrency($item['price'] ?? 0) ?>
                                </span>
                                <button class="btn-remove-header-cart cl2 hov-cl1 trans-04"
                                        data-product-id="<?= (int) ($item['product_id'] ?? $item['productID'] ?? 0) ?>"
                                        data-cart-id="<?= (int) ($item['cartID'] ?? 0) ?>">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <!-- Empty Cart Message -->
            <div id="empty-cart-message" class="text-center p-t-20 p-b-20" style="<?= empty($header_cart_items) ? '' : 'display: none;' ?>">
                <p class="stext-113 cl6">Your cart is empty</p>
            </div>
            
            <!-- Cart Summary -->
            <div id="cart-summary" style="<?= empty($header_cart_items) ? 'display: none;' : '' ?>">
                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40" id="header-cart-total">
                        Total: <?= Helper::formatCurrency($header_cart_totals['total'] ?? 0) ?>
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="<?= Helper::url('/checkout') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-lr-auto">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.OneStoreClient = Object.assign(window.OneStoreClient || {}, {
    baseUrl: '<?= APP_URL ?>',
    uploadsUrl: '<?= Helper::uploadBase() ?>',
    url: function(path) {
        const cleanPath = (path || '').replace(/^\//, '');
        const baseUrl = '<?= APP_URL ?>';
        return baseUrl + (cleanPath ? '/' + cleanPath : '');
    },
    resolveUploadUrl: function(path) {
        if (!path) {
            return this.uploadsUrl + 'placeholder.jpg';
        }

        const originalPath = String(path);
        if (/^(?:https?:)?\/\//.test(originalPath) || originalPath.startsWith('data:')) {
            return originalPath;
        }

        const cleanPath = originalPath
            .replace(/^\/+/, '')
            .replace(/^public\/uploads\//, '')
            .replace(/^uploads\//, '');

        return this.uploadsUrl + cleanPath;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const itemsContainer = document.getElementById('header-cart-items');
    const emptyMessage = document.getElementById('empty-cart-message');
    const summaryElement = document.getElementById('cart-summary');
    const totalElement = document.getElementById('header-cart-total');

    if (!itemsContainer || !emptyMessage || !summaryElement || !totalElement) {
        return;
    }

    const escapeHtml = (value) => {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    };

    const formatMoney = (value) => `$${Number(value || 0).toFixed(2)}`;

    const updateCartCount = (count) => {
        document.querySelectorAll('.icon-header-noti[data-notify]').forEach((element) => {
            element.setAttribute('data-notify', String(count || 0));
        });
    };

    const renderCart = (items, totals) => {
        if (!Array.isArray(items) || items.length === 0) {
            itemsContainer.innerHTML = '';
            emptyMessage.style.display = 'block';
            summaryElement.style.display = 'none';
            updateCartCount(0);
            return;
        }

        itemsContainer.innerHTML = items.map((item) => {
            const productId = item.product_id || item.productID || 0;
            const cartId = item.cartID || 0;
            const productName = escapeHtml(item.name || item.productName || 'Product');
            const price = formatMoney(item.price);
            const imageUrl = window.OneStoreClient.resolveUploadUrl(item.image_path || item.image || 'placeholder.jpg');

            return `
                <li class="header-cart-item flex-w flex-t m-b-12" data-product-id="${productId}" data-cart-id="${cartId}">
                    <div class="header-cart-item-img">
                        <img src="${imageUrl}" alt="${productName}" style="width: 60px; height: 60px; object-fit: cover;">
                    </div>
                    <div class="header-cart-item-txt p-t-8 flex-grow-1">
                        <a href="${window.OneStoreClient.url(`/product/${productId}`)}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            ${productName}
                        </a>
                        <div class="flex-w flex-sb-m">
                            <span class="header-cart-item-info">
                                ${Number(item.quantity || 0)} x ${price}
                            </span>
                            <button class="btn-remove-header-cart cl2 hov-cl1 trans-04" data-product-id="${productId}" data-cart-id="${cartId}">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                        </div>
                    </div>
                </li>
            `;
        }).join('');

        emptyMessage.style.display = 'none';
        summaryElement.style.display = 'block';
        totalElement.textContent = `Total: ${formatMoney(totals?.total || 0)}`;
        updateCartCount(totals?.total_items || items.reduce((sum, item) => sum + Number(item.quantity || 0), 0));
    };

    const refreshCart = async () => {
        try {
            const response = await fetch(window.OneStoreClient.url('/cart/get'), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();

            if (data.success) {
                renderCart(data.cart_items || [], data.cart_totals || {});
            }
        } catch (error) {
            console.error('Error refreshing mini cart:', error);
        }
    };

    const showNotification = (message, type) => {
        if (typeof swal !== 'undefined') {
            swal(message, '', type === 'error' ? 'error' : 'success');
            return;
        }

        alert(message);
    };

    const addToCart = async (button) => {
        const productId = button.getAttribute('data-product-id');
        const productName = button.getAttribute('data-product-name') || 'Item';

        if (!productId) {
            return;
        }

        try {
            const response = await fetch(window.OneStoreClient.url('/cart/add'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            });
            const data = await response.json();

            if (!data.success) {
                showNotification(data.message || 'Failed to add item to cart', 'error');
                return;
            }

            await refreshCart();
            document.dispatchEvent(new CustomEvent('cartUpdated'));
            showNotification(`${productName} added to cart!`, 'success');
        } catch (error) {
            console.error('Error adding to cart:', error);
            showNotification('An error occurred while adding to cart', 'error');
        }
    };

    const removeFromCart = async (button) => {
        const cartId = button.getAttribute('data-cart-id');
        const productId = button.getAttribute('data-product-id');
        const requestBody = cartId ? { cart_id: cartId } : { product_id: productId };

        try {
            const response = await fetch(window.OneStoreClient.url('/cart/remove'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(requestBody)
            });
            const data = await response.json();

            if (!data.success) {
                showNotification(data.message || 'Failed to remove item', 'error');
                return;
            }

            await refreshCart();
            document.dispatchEvent(new CustomEvent('cartUpdated'));
        } catch (error) {
            console.error('Error removing from cart:', error);
            showNotification('An error occurred', 'error');
        }
    };

    document.addEventListener('click', (event) => {
        const addButton = event.target.closest('.add-to-cart-btn');
        if (addButton) {
            event.preventDefault();
            addToCart(addButton);
            return;
        }

        const removeButton = event.target.closest('.btn-remove-header-cart');
        if (removeButton) {
            event.preventDefault();
            removeFromCart(removeButton);
        }
    });
});
</script> 
