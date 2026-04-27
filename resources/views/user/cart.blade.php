@extends("user.layouts.master-layouts.plain")

<title>Inhouse Textiles | Shopping Cart</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@push("style")
<style>
:root {
    --primary-color: #111827;
    --primary-hover: #000000;
    --secondary-color: #ffffff;
    --secondary-hover: #f3f4f6;
    --accent-color: #10b981;
    --accent-hover: #059669;
    --text-on-primary: #FFFFFF;
    --text-on-secondary: #1f2937;
    --background-color: #ffffff;
    --card-background: #FFFFFF;
    --border-color: #e5e7eb;
    --success-color: #10B981;
    --error-color: #EF4444;
    --warning-color: #F59E0B;
}

    /* Modern Cart Styles */
    .cart-container {
        animation: fadeIn 0.6s ease-out;
    }

    .cart-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 1.5rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .cart-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 40px rgba(139, 115, 85, 0.15);
    }

    .cart-item-image {
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cart-item-image:hover {
        transform: scale(1.05);
    }

    .cart-quantity-control {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }

    .cart-quantity-btn {
        transition: all 0.2s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--background-color);
    }

    .cart-quantity-btn:hover:not(:disabled) {
        background: var(--primary-color);
        color: white;
    }

    .cart-quantity-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .cart-remove-btn {
        transition: all 0.3s ease;
        opacity: 0.6;
    }

    .cart-remove-btn:hover {
        opacity: 1;
        transform: rotate(90deg);
        color: var(--error-color);
    }

    .order-summary {
        position: sticky;
        top: 100px;
        border-radius: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f9f7f3 100%);
        box-shadow: 0 10px 40px rgba(139, 115, 85, 0.1);
    }

    .badge-discount {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        font-size: 12px;
        font-weight: bold;
        padding: 4px 12px;
        border-radius: 20px;
        animation: pulse 2s infinite;
    }

    .progress-bar-cart {
        height: 6px;
        background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        border-radius: 3px;
        position: relative;
        overflow: hidden;
    }

    .progress-bar-cart::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: shimmer 2s infinite;
    }

    .empty-cart-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: var(--border-color);
        margin-bottom: 2rem;
        animation: float 3s ease-in-out infinite;
    }

    .floating-checkout-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.3);
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        z-index: 1000;
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
    }

    .floating-checkout-btn:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 40px rgba(139, 115, 85, 0.4);
    }

    .cart-item-deleting {
        animation: fadeOut 0.3s ease-out forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(-100px);
        }
    }

    .cart-item-updating {
        animation: pulse 0.5s ease-in-out;
    }

    .loading-spinner {
        width: 20px;
        height: 20px;
        border: 3px solid var(--border-color);
        border-top-color: var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .mobile-cart-item {
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .floating-checkout-btn {
            bottom: 20px;
            right: 20px;
            padding: 12px 24px;
            font-size: 14px;
        }

        .order-summary {
            position: static;
            margin-top: 2rem;
        }
    }

    /* Custom scrollbar for cart items */
    .cart-items-container::-webkit-scrollbar {
        width: 6px;
    }

    .cart-items-container::-webkit-scrollbar-track {
        background: rgba(139, 115, 85, 0.1);
        border-radius: 10px;
    }

    .cart-items-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
    }

    /* Price animation */
    .price-change {
        animation: pricePulse 0.5s ease-in-out;
    }

    @keyframes pricePulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Coupon input animation */
    .coupon-input:focus {
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

    /* Shipping progress animation */
    .free-shipping-progress {
        transition: width 0.6s ease-in-out;
    }

    /* Additional styles for discount display */
    .line-through {
        text-decoration: line-through;
    }

    .badge-discount {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        white-space: nowrap;
    }

    .text-success-color {
        color: var(--success-color);
    }
</style>
@endpush

@section("content")

<!-- Breadcrumb Navigation -->
<nav class="bg-white shadow-sm py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="breadcrumb-item text-gray-600 hover:text-primary transition-all">
                <i class="fas fa-home mr-1"></i> Home
            </a>
            <span class="text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('product') }}" class="breadcrumb-item text-gray-600 hover:text-primary transition-all">
                Products
            </a>
            <span class="text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <span class="text-primary font-medium">Shopping Cart</span>
        </div>
    </div>
</nav>

<!-- Main Cart Section -->
<div class="container mx-auto px-4 py-8 cart-container">

    {{-- LOGIC: Check if cart has items at the TOP level --}}
    @if($cartItems->count() > 0)

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                    Your Shopping Cart
                </h1>
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">
                        <span id="cart-count">{{ $cartItems->count() }}</span> item(s)
                    </p>
                    <a href="{{ route('product') }}" class="text-primary hover:text-primary-hover font-semibold flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>

            @if($grandTotal < 50)
            <div class="mb-8 bg-gradient-to-r from-primary/5 to-secondary/5 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-primary"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Free Shipping!</p>
                            <p class="text-sm text-gray-600">Get free shipping on orders over Rs.50</p>
                        </div>
                    </div>
                    <span class="font-bold text-primary">
                        Rs.{{ number_format(50 - $grandTotal, 2) }} away
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="progress-bar-cart free-shipping-progress"
                        style="width: {{ min(($grandTotal / 50) * 100, 100) }}%"></div>
                </div>
            </div>
            @endif

            <div class="space-y-4 cart-items-container">
                @foreach($cartItems as $item)
                <div class="cart-item p-6" id="cart-item-{{ $item->id }}">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <div class="md:col-span-3">
                            <div class="cart-item-image">
                                <img src="{{ $item->product->images->first() ? asset('storage/app/public/' . $item->product->images->first()->image_path) : asset('images/default-product.jpg') }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>
                        </div>

                        <div class="md:col-span-6">
                            <div class="h-full flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900 mb-2">
                                        {{ $item->product->name }}
                                    </h3>

                                    @if($item->color_name || $item->size_name)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($item->color_name)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                            <span class="w-3 h-3 rounded-full mr-2 bg-{{ $item->color_name }}-500"></span>
                                            {{ $item->color_name }}
                                        </span>
                                        @endif

                                        @if($item->size_name)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                            <i class="fas fa-expand-alt mr-2"></i>
                                            {{ $item->size_name }}
                                        </span>
                                        @endif
                                    </div>
                                    @endif

                                    <p class="text-sm text-gray-500 mb-1">
                                        SKU: {{ $item->product->sku ?? 'N/A' }}
                                    </p>

                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center text-sm text-green-700">
                                            <i class="fas fa-check-circle mr-1"></i> In Stock
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    @if($item->is_sale_applied)
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="badge-discount">{{ $item->discount_percent }}% OFF</span>
                                    </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl font-bold text-primary price-change">
                                            Rs.{{ number_format($item->final_line_total, 2) }}
                                        </span>
                                        @if($item->is_sale_applied)
                                        <span class="text-lg text-gray-400 line-through">
                                            Rs.{{ number_format($item->original_line_total, 2) }}
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($item->is_sale_applied)
                                        <span class="text-sm text-gray-500">
                                            Rs.{{ number_format($item->final_unit_price, 2) }} each
                                        </span>
                                        <span class="text-sm text-gray-400 line-through">
                                            Rs.{{ number_format($item->price, 2) }}
                                        </span>
                                        @else
                                        <span class="text-sm text-gray-500">
                                            Rs.{{ number_format($item->price, 2) }} each
                                        </span>
                                        @endif
                                    </div>
                                    
                                    @if($item->is_sale_applied)
                                    <div class="mt-1">
                                        <span class="text-xs text-green-600 font-semibold">
                                            You save Rs.{{ number_format($item->line_saved_amount, 2) }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <div class="h-full flex flex-col justify-between items-end">
                                <div class="flex items-center gap-4">
                                    <div class="cart-quantity-control flex items-center">
                                        <button class="cart-quantity-btn decrease-quantity"
                                            data-id="{{ $item->id }}"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="w-12 text-center font-semibold cart-quantity"
                                            data-id="{{ $item->id }}">
                                            {{ $item->quantity }}
                                        </span>
                                        <button class="cart-quantity-btn increase-quantity"
                                            data-id="{{ $item->id }}"
                                            {{ $item->quantity >= 10 ? 'disabled' : '' }}>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <button class="cart-remove-btn text-gray-400 hover:text-error-color"
                                        data-id="{{ $item->id }}"
                                        title="Remove item">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </div>

                                <div class="text-right mt-4">
                                    <p class="text-sm text-gray-500">Item Total</p>
                                    <p class="text-lg font-bold text-primary item-total" data-id="{{ $item->id }}">
                                        Rs.{{ number_format($item->final_line_total, 2) }}
                                    </p>
                                    @if($item->is_sale_applied)
                                    <p class="text-xs text-gray-400 line-through">
                                        Rs.{{ number_format($item->original_line_total, 2) }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="order-summary p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h3>

                @if($activeSale)
                <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center gap-2 text-green-800">
                        <i class="fas fa-tag"></i>
                        <span class="font-semibold">{{ $activeSale->discount_percent }}% Sale Active!</span>
                    </div>
                    @if($activeSale->name)
                    <p class="text-sm text-green-700 mt-1">{{ $activeSale->name }}</p>
                    @endif
                </div>
                @endif

                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Original Subtotal</span>
                        <span class="font-semibold" id="original-subtotal">
                            Rs.{{ number_format($cartItems->sum('original_line_total'), 2) }}
                        </span>
                    </div>

                    @if($totalSaved > 0)
                    <div class="flex justify-between text-green-600">
                        <span class="text-gray-600">Discount Applied</span>
                        <span class="font-semibold" id="discount-total">
                            -Rs.{{ number_format($totalSaved, 2) }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between border-t border-gray-100 pt-2">
                        <span class="text-gray-600">Subtotal after Discount</span>
                        <span class="font-semibold" id="subtotal-after-discount">
                            Rs.{{ number_format($grandTotal, 2) }}
                        </span>
                    </div>
                    @endif

                    {{-- Shipping logic --}}
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                       
                        <span class="font-semibold">Rs.250</span>
                    </div>

                    {{-- Tax Estimate --}}
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax Estimate</span>
                        <span class="font-semibold" id="tax">
                            0
                        </span>
                    </div>
                </div>

                <div class="border-t border-gray-200 my-6"></div>

                <div class="flex justify-between items-center mb-8">
                    <span class="text-lg font-bold text-gray-900">Total</span>
                    <div>
                        @php
                            $shipping = 250;
                            $tax = $grandTotal * 0.08;
                            $finalTotal = $grandTotal + $shipping ;
                        @endphp
                        <div class="text-2xl font-bold text-primary" id="total">
                            Rs.{{ number_format($finalTotal, 2) }}
                        </div>
                        @if($totalSaved > 0)
                        <p class="text-sm text-green-600 text-right">
                            You save Rs.{{ number_format($totalSaved, 2) }}
                        </p>
                        @endif
                    </div>
                </div>

                <button id="checkout-btn"
                    class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-hover transition-all mb-4">
                    <i class="fas fa-lock mr-3"></i> Proceed to Checkout
                </button>

                <a href="{{ route('product') }}"
                    class="block w-full text-center py-3 border-2 border-primary text-primary rounded-xl font-semibold hover:bg-primary/5 transition-all">
                    Continue Shopping
                </a>

                <div class="mt-8 p-4 bg-green-50 rounded-xl border border-green-200 text-center">
                    <div class="flex items-center justify-center gap-2 text-green-800 font-semibold">
                        <i class="fas fa-shield-alt"></i> Secure Checkout
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    {{-- LOGIC: This Block Only Runs if Cart is Empty --}}

    <div class="empty-cart-state bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center max-w-2xl mx-auto mt-10">
        <div class="empty-cart-icon mb-6">
            <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto">
                <i class="fas fa-shopping-cart text-5xl text-gray-300"></i>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 mb-4">Your cart is empty</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto text-lg">
            Looks like you haven't added any products to your cart yet.
            Start shopping to find amazing products!
        </p>
        <a href="{{ route('product') }}"
            class="inline-flex items-center gap-2 bg-primary text-white px-10 py-4 rounded-full font-bold hover:bg-primary-hover transition-all shadow-lg shadow-primary/30 hover:-translate-y-1">
            <i class="fas fa-store mr-2"></i>
            Start Shopping
        </a>
    </div>

    @endif
</div>

<!-- Floating Checkout Button (Mobile) -->
@if($cartItems->isNotEmpty())
    @php
        $shipping = $grandTotal >= 50 ? 0 : 250;
        $tax = $grandTotal * 0.08;
        $finalTotal = $grandTotal + $shipping + $tax;
    @endphp
    <a href="{{ route('checkout.index') }}" class="floating-checkout-btn md:hidden">
        <i class="fas fa-shopping-cart"></i>
        <span>Checkout</span>
        <span class="bg-white text-primary px-2 py-1 rounded-full text-sm">
            Rs.{{ number_format($finalTotal, 2) }}
        </span>
    </a>
@endif

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 flex flex-col items-center gap-4">
        <div class="loading-spinner"></div>
        <p class="text-gray-700 font-semibold">Updating cart...</p>
    </div>
</div>

@endsection

@push("script")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeCartPage();
        initializeEventListeners();
    });

    function initializeCartPage() {
        updateCartSummary();
    }

    function initializeEventListeners() {
        // Quantity increase buttons
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this.dataset.id, 'increase');
            });
        });

        // Quantity decrease buttons
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this.dataset.id, 'decrease');
            });
        });

        // Remove item buttons
        document.querySelectorAll('.cart-remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                removeItem(this.dataset.id);
            });
        });

        // Checkout button
        const checkoutBtn = document.getElementById('checkout-btn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', proceedToCheckout);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === '+' && e.ctrlKey) {
                e.preventDefault();
                // Find first increase button
                const increaseBtn = document.querySelector('.increase-quantity');
                if (increaseBtn && !increaseBtn.disabled) {
                    updateQuantity(increaseBtn.dataset.id, 'increase');
                }
            }
            if (e.key === '-' && e.ctrlKey) {
                e.preventDefault();
                // Find first decrease button
                const decreaseBtn = document.querySelector('.decrease-quantity');
                if (decreaseBtn && !decreaseBtn.disabled) {
                    updateQuantity(decreaseBtn.dataset.id, 'decrease');
                }
            }
            if (e.key === 'Delete' && e.ctrlKey) {
                e.preventDefault();
                const removeBtn = document.querySelector('.cart-remove-btn');
                if (removeBtn) {
                    removeItem(removeBtn.dataset.id);
                }
            }
        });
    }

    async function updateQuantity(itemId, action) {
        const quantityElement = document.querySelector(`.cart-quantity[data-id="${itemId}"]`);
        const decreaseBtn = document.querySelector(`.decrease-quantity[data-id="${itemId}"]`);
        const increaseBtn = document.querySelector(`.increase-quantity[data-id="${itemId}"]`);
        const cartItem = document.getElementById(`cart-item-${itemId}`);

        if (!quantityElement) return;

        // Show loading
        showLoading(true);

        try {
            const response = await fetch(`/cart/update-quantity/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: action
                })
            });

            const data = await response.json();

            if (data.success) {
                // Update quantity display
                quantityElement.textContent = data.quantity;

                // Animate quantity change
                cartItem.classList.add('cart-item-updating');
                setTimeout(() => {
                    cartItem.classList.remove('cart-item-updating');
                }, 500);

                // Update buttons state
                if (decreaseBtn) {
                    decreaseBtn.disabled = data.quantity <= 1;
                }
                if (increaseBtn) {
                    increaseBtn.disabled = data.quantity >= 10;
                }

                // Update cart totals
                await updateCartTotals(itemId);

                // Show success notification
                showNotification('Quantity updated', 'success');

            } else {
                throw new Error(data.message || 'Failed to update quantity');
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
            showNotification(error.message || 'Failed to update quantity', 'error');
        } finally {
            showLoading(false);
        }
    }

    async function updateCartTotals(itemId) {
        try {
            const response = await fetch('{{ route("cart.index") }}');
            const html = await response.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Update individual item total if needed
            const itemTotalElement = document.querySelector(`.item-total[data-id="${itemId}"]`);
            if (itemTotalElement) {
                const newTotal = doc.querySelector(`.item-total[data-id="${itemId}"]`);
                if (newTotal) {
                    itemTotalElement.textContent = newTotal.textContent;
                    itemTotalElement.classList.add('price-change');
                    setTimeout(() => {
                        itemTotalElement.classList.remove('price-change');
                    }, 500);
                }
            }

            // Update cart summary
            updateCartSummaryFromHTML(doc);

            // Update cart count
            updateCartCount();

        } catch (error) {
            console.error('Error updating cart totals:', error);
        }
    }

    function updateCartSummaryFromHTML(doc) {
        // Extract summary data from the HTML
        const originalSubtotalElement = doc.getElementById('original-subtotal');
        const subtotalAfterDiscountElement = doc.getElementById('subtotal-after-discount');
        const discountElement = doc.getElementById('discount-total');
        const totalElement = doc.getElementById('total');
        const cartCountElement = doc.getElementById('cart-count');

        if (originalSubtotalElement) {
            document.getElementById('original-subtotal').textContent = originalSubtotalElement.textContent;
        }

        if (subtotalAfterDiscountElement) {
            document.getElementById('subtotal-after-discount').textContent = subtotalAfterDiscountElement.textContent;
        }

        if (discountElement) {
            const existingDiscount = document.getElementById('discount-total');
            if (existingDiscount) {
                existingDiscount.textContent = discountElement.textContent;
            }
        }

        if (totalElement) {
            document.getElementById('total').textContent = totalElement.textContent;

            // Animate total change
            const totalEl = document.getElementById('total');
            totalEl.classList.add('price-change');
            setTimeout(() => {
                totalEl.classList.remove('price-change');
            }, 500);
        }

        if (cartCountElement) {
            document.getElementById('cart-count').textContent = cartCountElement.textContent;
        }
    }

    async function removeItem(itemId) {
        // Confirmation dialog
        const result = await Swal.fire({
            title: 'Remove Item',
            text: 'Are you sure you want to remove this item from your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--primary-color)',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, remove it',
            cancelButtonText: 'Cancel'
        });

        if (!result.isConfirmed) return;

        const cartItem = document.getElementById(`cart-item-${itemId}`);

        // Show loading
        showLoading(true);

        try {
            const response = await fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                // Animate removal
                cartItem.classList.add('cart-item-deleting');

                setTimeout(async () => {
                    cartItem.remove();

                    // Check if cart is now empty
                    const cartItems = document.querySelectorAll('.cart-item');
                    if (cartItems.length === 0) {
                        // Reload page to show empty cart state
                        window.location.reload();
                    } else {
                        // Update cart summary
                        await updateCartTotals(itemId);
                        updateCartCount();
                    }

                    showNotification('Item removed from cart', 'success');
                }, 300);

            } else {
                throw new Error('Failed to remove item');
            }
        } catch (error) {
            console.error('Error removing item:', error);
            showNotification('Failed to remove item', 'error');
        } finally {
            showLoading(false);
        }
    }

    function proceedToCheckout() {
        const checkoutBtn = document.getElementById('checkout-btn');
        const originalText = checkoutBtn.innerHTML;

        checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        checkoutBtn.disabled = true;

        // Simulate processing delay
        setTimeout(() => {
            window.location.href = '{{ route("checkout.index") }}';
        }, 1000);
    }

    function showLoading(show) {
        const overlay = document.getElementById('loading-overlay');
        if (show) {
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        } else {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg animate-slide-in 
                            ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
                              type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
                              type === 'warning' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' :
                              'bg-blue-100 text-blue-800 border border-blue-200'}`;
        notification.innerHTML = `
        <div class="flex items-center">
            <i class="${type === 'success' ? 'fas fa-check-circle' :
                       type === 'error' ? 'fas fa-exclamation-circle' :
                       type === 'warning' ? 'fas fa-exclamation-triangle' :
                       'fas fa-info-circle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

        document.body.appendChild(notification);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    function updateCartCount() {
        fetch('{{ route("cart.count") }}')
            .then(response => response.json())
            .then(data => {
                const cartCountElements = document.querySelectorAll('#cart-count, #floating-cart-count');
                cartCountElements.forEach(element => {
                    if (element) {
                        element.textContent = data.count;
                        if (data.count > 0) {
                            element.style.display = 'flex';
                        } else {
                            element.style.display = 'none';
                        }
                    }
                });
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    function updateCartSummary() {
        // Update shipping progress
        const subtotal = parseFloat(document.getElementById('subtotal-after-discount')?.textContent.replace('Rs.', '') || 0);
        const progressBar = document.querySelector('.free-shipping-progress');
        if (progressBar) {
            const progress = Math.min((subtotal / 50) * 100, 100);
            progressBar.style.width = `${progress}%`;
        }
    }

    // Handle page visibility change
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            // Page became visible, refresh cart data
            updateCartCount();
            updateCartSummary();
        }
    });

    // Refresh cart every 30 seconds if page is visible
    setInterval(() => {
        if (!document.hidden) {
            updateCartCount();
            updateCartSummary();
        }
    }, 30000);

    // Initialize animations
    function initializeAnimations() {
        document.querySelectorAll('.cart-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Call on load
    initializeAnimations();
</script>
@endpush