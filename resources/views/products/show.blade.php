<x-store-layout>
    <section class="product-show-section">
        <div class="container mx-auto">
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
                <a href="{{ route('products.index') }}" class="breadcrumb-link">Products</a>
                <span class="breadcrumb-separator">/</span>
                <a href="/" class="breadcrumb-link">Product</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">{{ $product->name }}</span>
            </nav>
    
            <div class="product-detail-grid">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <img src="{{ $product->images[0] ?? '/images/placeholder.jpg' }}" 
                             alt="{{ $product->name }}" 
                             id="mainProductImage">
                        @if($product->is_featured)
                        <span class="featured-badge">Featured</span>
                        @endif
                    </div>
                    
                    @if($product->images > 1)
                    <div class="image-thumbnails">
                        @foreach($product->images as $image)
                        <div class="thumbnail {{ $loop->first ? 'active' : '' }}" 
                             data-image="{{ $image }}">
                            <img src="{{ $image }}" alt="{{ $product->name }} - Image {{ $loop->iteration }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
    
                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-category">{{ $product->category }}</div>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-rating">
                        <div class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="star w-5 h-5 {{ $i <= $product->averageRating ? 'active text-yellow-400' : 'text-gray-300' }}" 
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="ml-2 text-gray-600">{{ $product->averageRating }}/5</span>
                        </div>
                        
                        <span class="rating-text">{{ $product->averageRating }}/5 ({{ $product->reviews }} reviews)</span>
                    </div>
    
                    <div class="product-price-section">
                        <div class="current-price">${{ number_format($product->price, 2) }}</div>
                        {{-- @if($product->compare_price)
                        <div class="compare-price">${{ number_format($product->compare_price, 2) }}</div>
                        <div class="discount-badge">Save {{ number_format((($product->compare_price - $product->price) / $product->compare_price) * 100) }}%</div>
                        @endif --}}
                    </div>
    
                    <div class="product-description text-gray-800">
                        <p>{{ $product->description }}</p>
                    </div>
    
                    <!-- Specifications -->
                    @if($product->specifications && count($product->specifications) > 0)
                    <div class="specifications-section">
                        <h3 class="section-heading">Specifications</h3>
                        <div class="specifications-grid">
                            @foreach($product->specifications as $key => $value)
                            <div class="spec-item">
                                <span class="spec-key">{{ $key }}:</span>
                                <span class="spec-value">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
    
                    <!-- Add to Cart -->
                    <div class="add-to-cart-section">
                        <div class="stock-status {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="status-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if($product->stock > 0)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                @endif
                            </svg>
                            {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ' available)' : 'Out of Stock' }}
                        </div>
    
                        @if($product->stock > 0)
                        <div class="quantity-selector">
                            <label for="quantity" class="quantity-label">Quantity:</label>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" id="decreaseQty">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="quantity-input">
                                <button type="button" class="quantity-btn" id="increaseQty">+</button>
                            </div>
                        </div>
                        @endif
    
                        <div class="action-buttons">
                            <button class="add-to-cart-btn" {{ $product->stock == 0 ? 'disabled' : '' }} id="addToCart">
                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                            
                            <button class="wishlist-btn" id="addToWishlist">
                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Add to Wishlist
                            </button>
                        </div>
                    </div>
    
                    <!-- Product Meta -->
                    <div class="product-meta">
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Secure Checkout
                        </div>
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Free Shipping
                        </div>
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            30-Day Returns
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Additional Sections -->
            <div class="product-details-tabs">
                <nav class="tabs-nav">
                    <button class="tab-btn active" data-tab="description">Description</button>
                    <button class="tab-btn" data-tab="specifications">Specifications</button>
                    <button class="tab-btn" data-tab="reviews">Reviews ({{ $product->reviews }})</button>
                    <button class="tab-btn" data-tab="shipping">Shipping & Returns</button>
                </nav>
    
                <div class="tabs-content">
                    <!-- Description Tab -->
                    <div class="tab-pane active" id="description">
                        <div class="tab-content">
                            <h3>Product Description</h3>
                            <p>{{ $product->description }}</p>
                            
                            <div class="feature-list">
                                <div class="feature-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Premium quality materials
                                </div>
                                <div class="feature-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Designed for durability and performance
                                </div>
                                <div class="feature-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Easy to use and maintain
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Specifications Tab -->
                    <div class="tab-pane" id="specifications">
                        <div class="tab-content">
                            <h3>Technical Specifications</h3>
                            <div class="specs-table">
                                @if($product->specifications)
                                    @foreach($product->specifications as $key => $value)
                                    <div class="spec-row">
                                        <div class="spec-name">{{ $key }}</div>
                                        <div class="spec-value">{{ $value }}</div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <!-- Reviews Tab -->
                    <div class="tab-pane" id="reviews">
                        <div class="tab-content">
                            <h3>Customer Reviews</h3>
                            
                            <div class="reviews-summary">
                                <div class="overall-rating">
                                    <div class="rating-score">{{ $product->averageRating }}</div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="star {{ $i <= $product->averageRating ? 'active' : '' }}" 
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <div class="rating-count">{{ $product->reviews }} reviews</div>
                                </div>
                            </div>
    
                            <div class="reviews-list">
                                @forelse($reviews as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-name">{{ $review->user->name ?? 'Anonymous' }}</div>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="star {{ $i <= $review->rating ? 'active' : '' }}" 
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="review-content">
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                    <div class="review-date">{{ $review->created_at->format('F j, Y') }}</div>
                                </div>
                                @empty
                                <div class="no-reviews">
                                    <p>No reviews yet. Be the first to review this product!</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
    
                    <!-- Shipping Tab -->
                    <div class="tab-pane" id="shipping">
                        <div class="tab-content">
                            <h3>Shipping & Returns</h3>
                            <div class="shipping-info">
                                <div class="shipping-item">
                                    <h4>Free Shipping</h4>
                                    <p>Free standard shipping on all orders over $50. Delivery within 3-5 business days.</p>
                                </div>
                                <div class="shipping-item">
                                    <h4>Express Shipping</h4>
                                    <p>Need it faster? Express shipping available for an additional fee. Delivery within 1-2 business days.</p>
                                </div>
                                <div class="shipping-item">
                                    <h4>Returns Policy</h4>
                                    <p>30-day return policy. If you're not satisfied with your purchase, return it for a full refund.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <section class="related-products">
                <h2 class="section-title">Related Products</h2>
                <div class="products-grid">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $relatedProduct->images[0]?? '/images/placeholder.jpg' }}" alt="{{ $relatedProduct->name }}">
                            @if($relatedProduct->is_featured)
                            <span class="featured-badge">Featured</span>
                            @endif
                        </div>
                        
                        <div class="product-content">
                            <div class="product-category">{{ $relatedProduct->category->name }}</div>
                            <h3 class="product-title">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                            </h3>
                            <p class="product-description text-gray-800">{{ Str::limit($relatedProduct->description, 80) }}</p>
                            
                            <div class="product-footer">
                                <div class="product-price">${{ number_format($relatedProduct->price, 2) }}</div>
                                <div class="product-stock {{ $relatedProduct->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $relatedProduct->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </div>
                            </div>
                            
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="view-details-btn">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </section>
    
    <style>
    .product-show-section {
        padding: 2rem 0;
        background: #f8fafc;
    }
    
    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        font-size: 0.875rem;
    }
    
    .breadcrumb-link {
        color: #6b7280;
        text-decoration: none;
    }
    
    .breadcrumb-link:hover {
        color: #374151;
    }
    
    .breadcrumb-separator {
        color: #d1d5db;
    }
    
    .breadcrumb-current {
        color: #374151;
        font-weight: 600;
    }
    
    /* Product Detail Grid */
    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }
    
    /* Product Images */
    .product-images {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .main-image {
        position: relative;
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .main-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    
    .image-thumbnails {
        display: flex;
        gap: 0.5rem;
    }
    
    .thumbnail {
        width: 80px;
        height: 80px;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        overflow: hidden;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    
    .thumbnail:hover,
    .thumbnail.active {
        border-color: #3b82f6;
    }
    
    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Product Info */
    .product-info {
        background: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .product-category {
        color: #6b7280;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    /* Rating */
    .product-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .stars {
        display: flex;
        gap: 0.125rem;
    }
    
    .star {
        width: 1.25rem;
        height: 1.25rem;
        color: #d1d5db;
    }
    
    .star.active {
        color: #f59e0b;
    }
    
    .rating-text {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    /* Price Section */
    .product-price-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .current-price {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
    }
    
    .compare-price {
        font-size: 1.25rem;
        color: #6b7280;
        text-decoration: line-through;
    }
    
    .discount-badge {
        background: #ef4444;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    /* Specifications */
    .specifications-section {
        margin: 1.5rem 0;
    }
    
    .section-heading {
        font-size: 1.25rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
    }
    
    .specifications-grid {
        display: grid;
        gap: 0.5rem;
    }
    
    .spec-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .spec-key {
        font-weight: 600;
        color: #374151;
    }
    
    .spec-value {
        color: #6b7280;
    }
    
    /* Add to Cart Section */
    .add-to-cart-section {
        margin: 2rem 0;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0.5rem;
    }
    
    .stock-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .stock-status.in-stock {
        color: #10b981;
    }
    
    .stock-status.out-of-stock {
        color: #ef4444;
    }
    
    .status-icon {
        width: 1.25rem;
        height: 1.25rem;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .quantity-label {
        font-weight: 600;
        color: #374151;
    }
    
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .quantity-btn {
        width: 2.5rem;
        height: 2.5rem;
        border: 1px solid #d1d5db;
        background: white;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .quantity-btn:hover {
        background: #f3f4f6;
    }
    
    .quantity-input {
        width: 4rem;
        height: 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        text-align: center;
        font-weight: 600;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
    }
    
    .add-to-cart-btn, .wishlist-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .add-to-cart-btn {
        background: #3b82f6;
        color: white;
    }
    
    .add-to-cart-btn:hover:not(:disabled) {
        background: #2563eb;
    }
    
    .add-to-cart-btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }
    
    .wishlist-btn {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .wishlist-btn:hover {
        background: #f3f4f6;
    }
    
    .btn-icon {
        width: 1.25rem;
        height: 1.25rem;
    }
    
    /* Product Meta */
    .product-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .meta-icon {
        width: 1rem;
        height: 1rem;
    }
    
    /* Tabs */
    .product-details-tabs {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
    }
    
    .tabs-nav {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .tab-btn {
        padding: 1rem 2rem;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .tab-btn:hover {
        color: #374151;
    }
    
    .tab-btn.active {
        color: #3b82f6;
        border-bottom-color: #3b82f6;
    }
    
    .tabs-content {
        padding: 2rem;
    }
    
    .tab-pane {
        display: none;
    }
    
    .tab-pane.active {
        display: block;
    }
    
    /* Feature List */
    .feature-list {
        display: grid;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #374151;
    }
    
    .feature-icon {
        width: 1.25rem;
        height: 1.25rem;
        color: #10b981;
    }
    
    /* Specs Table */
    .specs-table {
        display: grid;
        gap: 0;
    }
    
    .spec-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .spec-row:last-child {
        border-bottom: none;
    }
    
    .spec-name {
        font-weight: 600;
        color: #374151;
    }
    
    .spec-value {
        color: #6b7280;
    }
    
    /* Reviews */
    .reviews-summary {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0.5rem;
    }
    
    .overall-rating {
        text-align: center;
    }
    
    .rating-score {
        font-size: 3rem;
        font-weight: bold;
        color: #1f2937;
    }
    
    .rating-count {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .reviews-list {
        display: grid;
        gap: 1.5rem;
    }
    
    .review-item {
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .reviewer-name {
        font-weight: 600;
        color: #374151;
    }
    
    .review-content p {
        color: #6b7280;
        line-height: 1.6;
    }
    
    .review-date {
        color: #9ca3af;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    .no-reviews {
        text-align: center;
        padding: 3rem;
        color: #6b7280;
    }
    
    /* Shipping Info */
    .shipping-info {
        display: grid;
        gap: 1.5rem;
    }
    
    .shipping-item h4 {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .shipping-item p {
        color: #6b7280;
        line-height: 1.6;
    }
    
    /* Related Products */
    .related-products {
        margin-top: 3rem;
    }
    
    .related-products .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .view-details-btn {
        display: block;
        width: 100%;
        background: #f3f4f6;
        color: #374151;
        text-align: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    
    .view-details-btn:hover {
        background: #e5e7eb;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .tabs-nav {
            flex-direction: column;
        }
        
        .tab-btn {
            border-bottom: 1px solid #e5e7eb;
            border-left: 2px solid transparent;
        }
        
        .tab-btn.active {
            border-left-color: #3b82f6;
            border-bottom-color: #e5e7eb;
        }
    }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image thumbnail switching
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('mainProductImage');
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const imageSrc = this.getAttribute('data-image');
                mainImage.src = imageSrc;
                
                // Update active state
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Quantity controls
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');
        
        if (decreaseBtn && increaseBtn && quantityInput) {
            decreaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
            
            increaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                const maxValue = parseInt(quantityInput.getAttribute('max'));
                if (currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                }
            });
        }
        
        // Tab switching
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                
                // Update active tab button
                tabBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Update active tab pane
                tabPanes.forEach(pane => {
                    pane.classList.remove('active');
                    if (pane.id === targetTab) {
                        pane.classList.add('active');
                    }
                });
            });
        });
        
        // Add to cart functionality
        const addToCartBtn = document.getElementById('addToCart');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const quantity = quantityInput ? quantityInput.value : 1;
                
                // Here you would typically make an AJAX request to add to cart
                console.log(`Adding ${quantity} of product to cart`);
                
                // Show success message
                alert(`Added ${quantity} item(s) to cart!`);
            });
        }
        
        // Add to wishlist functionality
        const addToWishlistBtn = document.getElementById('addToWishlist');
        if (addToWishlistBtn) {
            addToWishlistBtn.addEventListener('click', function() {
                // Here you would typically make an AJAX request to add to wishlist
                console.log('Adding product to wishlist');
                
                // Show success message
                alert('Added to wishlist!');
            });
        }
    });
    </script>

</x-store-layout>