<x-store-layout>
    <section class="products-section">
        <div class="container mx-auto text-gray-800">
            <!-- Header Section -->
            <div class="section-header">
                <div class="section-tag">Premium Quality Products</div>
                <h1 class="section-title">Discover Our <span>Amazing Collection</span></h1>
                <p class="section-subtitle">Carefully curated products that combine innovation, quality, and exceptional value for your everyday needs.</p>
            </div>
    
            <!-- Filters and Categories -->
            <div class="filters-section">
                <div class="filters-grid">
                    <!-- Category Filter -->
                    <div class="filter-group">
                        <label for="category" class="filter-label">Category</label>
                        <select id="category" name="category" class="filter-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" {{ request('category') == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Price Filter -->
                    <div class="filter-group">
                        <label for="price" class="filter-label">Price Range</label>
                        <select id="price" name="price" class="filter-select">
                            <option value="">Any Price</option>
                            <option value="0-50" {{ request('price') == '0-50' ? 'selected' : '' }}>$0 - $50</option>
                            <option value="50-100" {{ request('price') == '50-100' ? 'selected' : '' }}>$50 - $100</option>
                            <option value="100-200" {{ request('price') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                            <option value="200+" {{ request('price') == '200+' ? 'selected' : '' }}>$200+</option>
                        </select>
                    </div>
    
                    <!-- Featured Filter -->
                    <div class="filter-group">
                        <label for="featured" class="filter-label">Featured</label>
                        <select id="featured" name="featured" class="filter-select">
                            <option value="">All Products</option>
                            <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                        </select>
                    </div>
    
                    <!-- Search -->
                    <div class="filter-group">
                        <label for="search" class="filter-label">Search</label>
                        <input type="text" id="search" name="search" placeholder="Search products..." 
                               value="{{ request('search') }}" class="filter-input">
                    </div>
                </div>
    
                <!-- Active Filters -->
                @if(request()->anyFilled(['category', 'price', 'featured', 'search']))
                <div class="active-filters">
                    <span class="active-filters-label">Active Filters:</span>
                    @if(request('category'))
                        @php
                            $categoryName = $categories->where('id', request('category'))->first()->name ?? 'Category';
                        @endphp
                        <span class="filter-tag">
                            Category: {{ $categoryName }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="filter-remove">×</a>
                        </span>
                    @endif
                    @if(request('search'))
                        <span class="filter-tag">
                            Search: "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="filter-remove">×</a>
                        </span>
                    @endif
                    <a href="{{ route('products.index') }}" class="clear-all">Clear All</a>
                </div>
                @endif
            </div>
    
            <!-- Products Grid -->
            <div class="products-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product['image'] ?? '/images/placeholder.jpg' }}" alt="{{ $product['name'] }}">
                        @if($product['is_featured'])
                        <span class="featured-badge">Featured</span>
                        @endif
                    </div>
                    
                    <div class="product-content">
                        <div class="product-category">{{ $product['category'] }}</div>
                        <h3 class="product-title">{{ $product['name'] }}</h3>
                        <p class="product-description">{{ Str::limit($product['description'], 100) }}</p>
                        
                        <div class="product-specs">
                            @if(isset($product['specifications']))
                                @foreach(array_slice($product['specifications'], 0, 2) as $key => $value)
                                    <span class="spec-tag">{{ $key }}: {{ $value }}</span>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="product-footer gap-2">
                            <div class="product-price">${{ number_format($product['price'], 2) }}</div>
                            <div class="product-stock {{ $product['stock'] > 0 ? 'in-stock' : 'out-of-stock' }}">
                                {{ $product['stock'] > 0 ? 'In Stock' : 'Out of Stock' }}
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2 ">
                            <x-primary-link url="#" text=" {{ $product['stock'] > 0 ? 'Purchase' : 'Out of Stock' }}" />
                            <button class="bg-white border border-white text-gray-900 font-bold py-3 px-6 rounded-md text-center hover:bg-white hover:text-bce-blue transition duration-300" {{ $product['stock'] == 0 ? 'disabled' : '' }}>
                                {{ $product['stock'] > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
            <!-- Empty State -->
            @if(count($products) === 0)
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3>No products found</h3>
                <p>Try adjusting your filters or search terms</p>
                <a href="{{ route('products.index') }}" class="clear-filters-btn">Clear All Filters</a>
            </div>
            @endif
        </div>
    </section>
    
    <style>
    .products-section {
        padding: 4rem 0;
        background: #f8fafc;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-tag {
        color: #3b82f6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .section-title span {
        color: #3b82f6;
    }
    
    .section-subtitle {
        font-size: 1.125rem;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Filters */
    .filters-section {
        background: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }
    
    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
    }
    
    .filter-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    
    .filter-select, .filter-input {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        ring: 2px solid #3b82f6;
        border-color: #3b82f6;
    }
    
    /* Active Filters */
    .active-filters {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .active-filters-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
    }
    
    .filter-tag {
        background: #eff6ff;
        color: #1e40af;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .filter-remove {
        color: #6b7280;
        text-decoration: none;
        font-weight: bold;
    }
    
    .filter-remove:hover {
        color: #374151;
    }
    
    .clear-all {
        margin-left: auto;
        color: #ef4444;
        text-decoration: none;
        font-size: 0.875rem;
    }
    
    .clear-all:hover {
        color: #dc2626;
    }
    
    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .product-card {
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .product-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .featured-badge {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: #f59e0b;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .product-content {
        padding: 1.5rem;
    }
    
    .product-category {
        color: #6b7280;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }
    
    .product-description {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }
    
    .product-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .spec-tag {
        background: #f3f4f6;
        color: #374151;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
    }
    
    .product-footer {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1f2937;
    }
    
    .product-stock {
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .in-stock {
        color: #10b981;
    }
    
    .out-of-stock {
        color: #ef4444;
    }
    
    .add-to-cart-btn {
        width: 100%;
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .add-to-cart-btn:hover:not(:disabled) {
        background: #2563eb;
    }
    
    .add-to-cart-btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .empty-icon {
        width: 4rem;
        height: 4rem;
        margin: 0 auto 1rem;
        color: #9ca3af;
    }
    
    .empty-icon svg {
        width: 100%;
        height: 100%;
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #6b7280;
        margin-bottom: 1.5rem;
    }
    
    .clear-filters-btn {
        background: #3b82f6;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }
    
    .clear-filters-btn:hover {
        background: #2563eb;
    }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit form when filters change
        const filters = document.querySelectorAll('#category, #price, #featured, #search');
        
        filters.forEach(filter => {
            filter.addEventListener('change', function() {
                this.form.submit();
            });
        });
    
        // Debounce search input
        let searchTimeout;
        const searchInput = document.getElementById('search');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        }
    });
    </script>
</x-store-layout>
