<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Dust Collector Model X100',
                'description' => 'High-efficiency dust collector for industrial applications, capable of filtering fine dust and debris from large-scale production environments.',
                'price' => 4999.99,
                'image' => 'https://bce-usa.com/images/solutions1.jpeg',
                'category' => 'Dust Collector',
                'category_id' => 1,
                'stock' => 5,
                'is_featured' => true,
                'specifications' => [
                    'Air Flow' => '3000 CFM',
                    'Power' => '7.5 kW',
                    'Filter Type' => 'HEPA',
                    'Dimensions' => '120x80x150 cm'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Industrial Ventilation System V200',
                'description' => 'Advanced ventilation system for factories and large warehouses, designed to maintain optimal air quality and temperature.',
                'price' => 7999.99,
                'image' => 'https://bce-usa.com/images/manufacturing_bce.png',
                'category' => 'Industrial Ventilation',
                'category_id' => 2,
                'stock' => 3,
                'is_featured' => true,
                'specifications' => [
                    'Air Flow' => '5000 CFM',
                    'Noise Level' => '65 dB',
                    'Motor Power' => '10 kW',
                    'Coverage Area' => '500 m²'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Odor Control System OCS-300',
                'description' => 'Effective odor control system for industrial facilities, using advanced filtration and neutralization technology to reduce harmful odors.',
                'price' => 5999.99,
                'image' => 'https://bce-usa.com/images/solutions4.jpg',
                'category' => 'Odor Control System',
                'category_id' => 3,
                'stock' => 2,
                'is_featured' => false,
                'specifications' => [
                    'Filtration Type' => 'Activated Carbon',
                    'Coverage Area' => '300 m²',
                    'Power Consumption' => '3.5 kW',
                    'Maintenance Interval' => '6 months'
                ]
            ]
        ];
        

        // Fake categories (replace with your actual categories from database)
        $categories = [
            ['id' => 1, 'name' => 'Electronics'],
            ['id' => 2, 'name' => 'Furniture'],
            ['id' => 3, 'name' => 'Clothing'],
            ['id' => 4, 'name' => 'Books']
        ];

        // Filter products based on request
        $filteredProducts = collect($products)->filter(function($product) use ($request) {
            // Category filter
            if ($request->category && $product['category_id'] != $request->category) {
                return false;
            }

            // Price filter
            if ($request->price) {
                $priceRange = $request->price;
                if ($priceRange === '200+' && $product['price'] < 200) {
                    return false;
                } elseif (str_contains($priceRange, '-')) {
                    [$min, $max] = explode('-', $priceRange);
                    if ($product['price'] < $min || $product['price'] > $max) {
                        return false;
                    }
                }
            }

            // Featured filter
            if ($request->featured && !$product['is_featured']) {
                return false;
            }

            // Search filter
            if ($request->search) {
                $search = strtolower($request->search);
                if (!str_contains(strtolower($product['name']), $search) && 
                    !str_contains(strtolower($product['description']), $search)) {
                    return false;
                }
            }

            return true;
        });

        return view('products.index', [
            'products' => $filteredProducts->values(),
            'categories' => collect($categories)
        ]);
    }

    public function show(){

        $product = (object)[
            'id' => 1,
            'name' => 'Dust Collector Model X100',
            'description' => 'High-efficiency dust collector for industrial applications, capable of filtering fine dust and debris from large-scale production environments.',
            'price' => 4999.99,
            'images' => [
                'https://bce-usa.com/images/solutions1.jpeg',
                'https://bce-usa.com/images/solutions2.jpeg',
                'https://bce-usa.com/images/solutions3.jpeg'
            ],
            'category' => 'Dust Collector',
            'category_id' => 1,
            'stock' => 5,
            'is_featured' => true,
            'specifications' => [
                'Air Flow' => '3000 CFM',
                'Power' => '7.5 kW',
                'Filter Type' => 'HEPA',
                'Dimensions' => '120x80x150 cm'
            ],
            'averageRating' => 5,
            'reviews' => 4,
        ];

        $reviews = [
            (object)[
                'user' => (object)['name' => 'John Doe'],
                'rating' => 5,
                'comment' => 'This Dust Collector works perfectly in our factory. Very powerful and reliable!',
                'created_at' => now()->subDays(2)
            ],
            (object)[
                'user' => (object)['name' => 'Jane Smith'],
                'rating' => 4,
                'comment' => 'Good performance, but a bit noisy.',
                'created_at' => now()->subDays(5)
            ],
            (object)[
                'user' => null,
                'rating' => 3,
                'comment' => 'Average product, meets basic needs.',
                'created_at' => now()->subDays(10)
            ],
        ];
        
        

                $categories = [
                    ['id' => 1, 'name' => 'Electronics'],
                    ['id' => 2, 'name' => 'Furniture'],
                    ['id' => 3, 'name' => 'Clothing'],
                    ['id' => 4, 'name' => 'Books']
                ];
        
               
                $relatedProducts = collect([
                    (object)[
                        'id' => 2,
                        'name' => 'Industrial Ventilation Fan V200',
                        'slug' => 'industrial-ventilation-fan-v200',
                        'description' => 'High-performance industrial ventilation fan for factories and workshops.',
                        'price' => 2999.99,
                        'images' => [
                            'https://bce-usa.com/images/ventilation1.jpeg',
                            'https://bce-usa.com/images/ventilation2.jpeg'
                        ],
                        'category' => (object)['name' => 'Industrial Ventilation'],
                        'stock' => 3,
                        'is_featured' => true
                    ],
                    (object)[
                        'id' => 3,
                        'name' => 'Odor Control System OCS-500',
                        'slug' => 'odor-control-system-ocs-500',
                        'description' => 'Efficient odor control system suitable for chemical and industrial environments.',
                        'price' => 1999.99,
                        'images' => [
                            'https://bce-usa.com/images/odor1.jpeg'
                        ],
                        'category' => (object)['name' => 'Odor Control System'],
                        'stock' => 0,
                        'is_featured' => false
                    ]
                ]);
                
        
        return view('products.show', ['product' => $product , 'categories' => collect($categories),  'reviews' => $reviews, 'relatedProducts' => $relatedProducts]);
    }
}