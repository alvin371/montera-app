<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function authorize()
    {
        return is_cli();
    }

    private function seedLandingPageSections()
    {
        $now = date('Y-m-d H:i:s');
        $sections = [
            'navbar' => [
                'logo' => [
                    'url' => '/assets/montera-logo.png',
                    'alt' => 'Montera Logo',
                ],
                'links_left' => [
                    ['label' => 'Home', 'href' => '#home'],
                    ['label' => 'Advantage', 'href' => '#advantage'],
                    ['label' => 'Best Product', 'href' => '#best-product'],
                ],
                'links_right' => [
                    ['label' => 'New Product', 'href' => '#new-product'],
                    ['label' => 'Team', 'href' => '#team'],
                    ['label' => 'Testimoni', 'href' => '#testimoni'],
                ],
            ],
            'hero' => [
                'background_image_url' => '/assets/background-heroes.png',
                'title' => [
                    'line_1' => 'Elevate Your Beauty,',
                    'line_2' => 'Embrace Your Glow',
                ],
                'subtitle' => 'Discover premium skincare solutions crafted with natural ingredients to enhance your natural radiance and confidence.',
                'primary_cta' => [
                    'label' => 'Shop Now',
                    'href' => '',
                ],
                'secondary_cta' => [
                    'label' => 'Learn More',
                    'href' => '',
                ],
            ],
            'features' => [
                'eyebrow' => 'OUR ADVANTAGES',
                'title' => 'Experience Better Care',
                'description' => 'Experience a new level of personal care designed to bring out your natural confidence. Every product is thoughtfully crafted blending quality, innovation, and safety to give you the best daily experience.',
                'items' => [
                    [
                        'id' => '1',
                        'title' => 'Trusted Quality',
                        'description' => 'Each product is crafted with high standards and strict quality control to ensure the best experience.',
                        'position' => 'top-left',
                        'icon_svg' => '<svg fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" /></svg>',
                    ],
                    [
                        'id' => '2',
                        'title' => 'Natural Ingredients',
                        'description' => 'Formulated with carefully selected natural ingredients that are gentle yet effective for daily use.',
                        'position' => 'top-right',
                        'icon_svg' => '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" /></svg>',
                    ],
                    [
                        'id' => '3',
                        'title' => 'Meaningful Innovation',
                        'description' => 'Developed with modern technology seamlessly blending effectiveness with comfort.',
                        'position' => 'bottom-left',
                        'has_image' => true,
                        'icon_svg' => '<svg fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clipRule="evenodd" /></svg>',
                    ],
                    [
                        'id' => '4',
                        'title' => 'Safe & Reliable',
                        'description' => 'Dermatologically tested and proven safe, suitable for various skin types and personal care routines.',
                        'position' => 'bottom-right',
                        'icon_svg' => '<svg fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" /></svg>',
                    ],
                ],
            ],
            'new-products' => [
                'eyebrow' => 'NEW PRODUCT',
                'title' => 'New Product Arrival',
                'description' => 'Discover our latest creation designed with care and innovation. Experience a new way to refresh your daily routine with quality you can trust.',
                'products' => [
                    [
                        'id' => '1',
                        'name' => 'Foot Exfoliating Lotion',
                        'category' => 'Foot Care',
                        'description' => 'Gentle yet effective foot exfoliating lotion that removes dead skin cells and softens rough areas. Formulated to rejuvenate tired feet and restore smoothness for healthy-looking skin.',
                        'image' => '/assets/new-product-arrival/1.png',
                        'features' => [
                            ['icon' => '??', 'label' => 'Exfoliating Formula'],
                            ['icon' => '?', 'label' => 'Smoothing Effect'],
                            ['icon' => '??', 'label' => 'Gentle Care'],
                        ],
                    ],
                    [
                        'id' => '2',
                        'name' => 'Foot Deo Spray',
                        'category' => 'Foot Care',
                        'description' => 'Antibacterial foot deodorant spray that keeps your feet fresh and odor-free throughout the day. Alcohol-free formula provides long-lasting protection and comfort.',
                        'image' => '/assets/new-product-arrival/2.png',
                        'features' => [
                            ['icon' => '???', 'label' => 'Antibacterial'],
                            ['icon' => '???', 'label' => 'Alcohol-Free'],
                            ['icon' => '??', 'label' => 'All-Day Fresh'],
                        ],
                    ],
                    [
                        'id' => '3',
                        'name' => 'Hair Removal Cream',
                        'category' => 'Body Care',
                        'description' => 'Painless hair removal cream that gently eliminates unwanted hair while nourishing your skin. Smooth application and easy removal for silky, hair-free results.',
                        'image' => '/assets/new-product-arrival/3.png',
                        'features' => [
                            ['icon' => '?', 'label' => 'Painless'],
                            ['icon' => '??', 'label' => 'Easy Application'],
                            ['icon' => '??', 'label' => 'Skin Nourishing'],
                        ],
                    ],
                    [
                        'id' => '4',
                        'name' => 'Skin Rescue Ceramide Balm',
                        'category' => 'Skincare',
                        'description' => 'Intensive skin barrier repair balm enriched with ceramides and coconut. Provides deep nourishment and helps restore your skin\'s natural protective barrier for healthy, resilient skin.',
                        'image' => '/assets/new-product-arrival/4.png',
                        'features' => [
                            ['icon' => '??', 'label' => 'Ceramide + Coconut'],
                            ['icon' => '???', 'label' => 'Barrier Support'],
                            ['icon' => '??', 'label' => 'Deep Repair'],
                        ],
                    ],
                    [
                        'id' => '5',
                        'name' => 'Foot Care Combo',
                        'category' => 'Foot Care',
                        'description' => 'Complete foot care solution combining our exfoliating lotion and antibacterial deo spray. Perfect duo for maintaining soft, fresh, and healthy feet every day.',
                        'image' => '/assets/new-product-arrival/5.png',
                        'features' => [
                            ['icon' => '??', 'label' => 'Complete Care'],
                            ['icon' => '?', 'label' => '2-in-1 Solution'],
                            ['icon' => '??', 'label' => 'Fresh & Smooth'],
                        ],
                    ],
                    [
                        'id' => '6',
                        'name' => 'Moringa Gentle Wash',
                        'category' => 'Body Care',
                        'description' => 'pH-balanced gentle hand and body wash enriched with moringa extract. Cleanses effectively while maintaining your skin\'s natural moisture for soft, clean, and nourished skin.',
                        'image' => '/assets/new-product-arrival/6.png',
                        'features' => [
                            ['icon' => '??', 'label' => 'Moringa Extract'],
                            ['icon' => '??', 'label' => 'pH Balanced'],
                            ['icon' => '??', 'label' => 'Moisturizing'],
                        ],
                    ],
                    [
                        'id' => '7',
                        'name' => 'Simply Whitening Mouthwash',
                        'category' => 'Oral Care',
                        'description' => 'Natural daily mouthwash with 2x mouth freshness and whitening benefits. Alcohol-free formula provides long-lasting breath freshness while gently whitening your teeth.',
                        'image' => '/assets/new-product-arrival/7.png',
                        'features' => [
                            ['icon' => '??', 'label' => '2x Freshness'],
                            ['icon' => '?', 'label' => 'Whitening'],
                            ['icon' => '??', 'label' => 'Natural & Alcohol-Free'],
                        ],
                    ],
                    [
                        'id' => '8',
                        'name' => 'Centella Hair Nutrition',
                        'category' => 'Hair Care',
                        'description' => 'Nourishing hair treatment spray infused with centella asiatica extract. Strengthens hair from root to tip, reduces breakage, and promotes healthy, shiny hair growth.',
                        'image' => '/assets/new-product-arrival/8.png',
                        'features' => [
                            ['icon' => '??', 'label' => 'Centella Extract'],
                            ['icon' => '??', 'label' => 'Hair Strengthening'],
                            ['icon' => '?', 'label' => 'Shine & Growth'],
                        ],
                    ],
                ],
            ],
            'customer-favorites' => [
                'eyebrow' => 'BEST PRODUCT',
                'title' => 'Most Loved by Our Customers',
                'description' => 'Crafted with natural ingredients and thoughtful formulation, this product has become a favorite for those who value gentle yet effective care.',
                'items' => [
                    [
                        'id' => '1',
                        'category_heading' => 'Exclusive Product Bundles',
                        'category_description' => [
                            'Experience complete care with our premium product bundles each thoughtfully curated to bring balance, comfort, and visible results to your daily routine.',
                            'Every set combines our most loved products, designed to work in harmony and delivers the best experience for your skin, body or self care. Enjoy a touch of luxury, smarter value, and effortless self-care all in one bundle.',
                        ],
                        'product_showcase' => [
                            'name' => 'Complete Radiance Set',
                            'description' => 'A premium curated bundle designed to bring out your natural glow. This exclusive set combines our best formulas.',
                            'image' => '/assets/product/bg-product-1.png',
                            'mini_image' => '/assets/product/mini-product.png',
                        ],
                    ],
                    [
                        'id' => '2',
                        'category_heading' => 'Gentle Body Wash Collection',
                        'category_description' => [
                            'Indulge in a luxurious bathing experience with our premium body wash collection. Infused with refined ingredients and subtle fragrances, each formula pampers your skin while maintaining a clean and elegant feel.',
                            'From everyday routines to ultra-care needs, our body wash collection fits every moment of your day. Experience rich lather, lasting freshness, and skin that feels clean and cared for with every wash.',
                        ],
                        'product_showcase' => [
                            'name' => 'Soothing Bloom Body Wash',
                            'description' => 'Its gentle formula leaves your skin soft, smooth, and beautifully hydrated after every shower.',
                            'image' => '/assets/product/bg-product-2.png',
                            'mini_image' => '/assets/product/mini-product-2.png',
                        ],
                    ],
                    [
                        'id' => '3',
                        'category_heading' => 'Gentle Exfoliation Series',
                        'category_description' => [
                            'Reveal your skin\'s natural glow with our premium exfoliating range. Each formula is crafted to gently remove dead skin cells, refine texture, and restore a smooth, radiant finish without stripping away moisture.',
                            'Designed for all skin types, our exfoliating products use natural scrubs and mild acids to refresh and renew your skin. Enjoy a cleaner, softer, and healthier look - powered by nature\'s finest ingredients.',
                        ],
                        'product_showcase' => [
                            'name' => 'Botanical Renew Exfoliating Gel',
                            'description' => 'A mild gel exfoliator enriched with botanical ingredients that gently removes impurities. Perfect for sensitive skin.',
                            'image' => '/assets/product/bg-product-3.png',
                            'mini_image' => '/assets/product/mini-product-3.png',
                        ],
                    ],
                ],
            ],
            'team' => [
                'eyebrow' => 'TEAM',
                'title' => 'Meet Our Expert Team',
                'description' => 'Behind every great product is a dedicated team of specialists. Our experts combine science, innovation, and passion to create safe and effective skincare you can trust.',
                'members' => [
                    [
                        'id' => '1',
                        'name' => 'Ayu Kartika Sari',
                        'role' => 'Formulation Scientist',
                        'image' => '/assets/team/ayu-kartika-sari.png',
                    ],
                    [
                        'id' => '2',
                        'name' => 'Vikramjeet Singh',
                        'role' => 'CEO',
                        'image' => '/assets/team/vikramjeet-singh.png',
                    ],
                    [
                        'id' => '3',
                        'name' => 'Nadia Putri Suwandono',
                        'role' => 'Ingredient Specialist',
                        'image' => '/assets/team/nadia-putri-suwandono.png',
                    ],
                    [
                        'id' => '4',
                        'name' => 'Dimas Arya Saputra',
                        'role' => 'Cosmetic Chemist',
                        'image' => '/assets/team/dimas-arya-saputra.png',
                    ],
                ],
            ],
            'testimonials' => [
                'eyebrow' => 'Testimoni',
                'title' => 'What Our Customers Say',
                'description' => 'Real stories, real results. Discover how our products have made a difference in people&apos;s daily care routines.',
                'items' => [
                    [
                        'id' => '1',
                        'name' => 'Alya Prameswari',
                        'role' => 'Verified Customer',
                        'before_image' => '/assets/testimony/alya-prameswari.png',
                        'after_image' => '/assets/testimony/alya-prameswari.png',
                        'content' => "I've tried many brands, but this one truly stands out. My skin feels healthier and looks visibly brighter after just a few weeks!\n\nI love how gentle yet effective the products are. Perfect for my active lifestyle clean, fresh, and reliable every single day.\n\nThe texture, the scent, the results everything feels premium. It's a brand I can genuinely trust and recommend to my followers. Best product ever!",
                        'rating' => 5,
                    ],
                    [
                        'id' => '2',
                        'name' => 'Dinda Maharani',
                        'role' => 'Verified Customer',
                        'before_image' => '/assets/testimony/dinda-maharani.png',
                        'after_image' => '/assets/testimony/dinda-maharani.png',
                        'content' => "This serum has completely transformed my skin! I've never felt more confident. The results are visible within just two weeks of use.\n\nThe quality is outstanding and the customer service team is incredibly helpful. I'm so glad I discovered Montera.\n\nI've already recommended it to all my friends and family. This is now a permanent part of my skincare routine!",
                        'rating' => 5,
                    ],
                    [
                        'id' => '3',
                        'name' => 'Nayla Putri Anjani',
                        'role' => 'Beauty Enthusiast',
                        'before_image' => '/assets/testimony/nayla-putri-anjani.png',
                        'after_image' => '/assets/testimony/nayla-putri-anjani.png',
                        'content' => "Outstanding quality and customer service. The products are gentle yet effective. I've recommended Montera to all my friends!\n\nAs someone who tests products regularly, I can confidently say this brand stands out from the competition.\n\nThe attention to detail in every product shows the brand's commitment to excellence. Truly impressed!",
                        'rating' => 5,
                    ],
                ],
            ],
            'footer' => [
                'logo' => [
                    'url' => '/assets/montera-logo.png',
                    'alt' => 'Montera Group Logo',
                ],
                'taglines' => [
                    'Redefining timeless beauty through elegance, care, and confidence.',
                    'Discover your glow in every touch where luxury meets sincerity.',
                ],
                'newsletter' => [
                    'placeholder' => 'Input email',
                    'cta_label' => 'Get voucher',
                ],
                'contact' => [
                    'phone' => '+62-21-23093070',
                    'email' => 'Info@monteragoup.com',
                    'addresses' => [
                        'Rukan Fresh Market No. C16 Green Lake City, Cipondoh Kota Tangerang, Banten Indonesia',
                    ],
                ],
                'info_links' => [
                    ['label' => 'Home', 'href' => '#home'],
                    ['label' => 'About Us', 'href' => '#about'],
                    ['label' => 'Services', 'href' => '#services'],
                    ['label' => 'Gallery', 'href' => '#gallery'],
                    ['label' => 'Event', 'href' => '#event'],
                    ['label' => 'Appointment', 'href' => '#appointment'],
                ],
                'social_links' => [
                    ['platform' => 'instagram', 'href' => '#', 'icon' => 'instagram'],
                    ['platform' => 'facebook', 'href' => '#', 'icon' => 'facebook'],
                    ['platform' => 'youtube', 'href' => '#', 'icon' => 'youtube'],
                ],
                'copyright' => [
                    'text_template' => '(c) {{year}} copyright by Montera Group',
                ],
            ],
        ];

        $seeded = 0;
        foreach ($sections as $sectionKey => $content) {
            $payload = [
                'section_key' => $sectionKey,
                'content' => json_encode($content, JSON_UNESCAPED_SLASHES),
                'updated_at' => $now,
            ];

            $existing = $this->db->get_where(
                'landing_page_sections',
                ['section_key' => $sectionKey]
            )->row_array();

            if ($existing) {
                $this->db->where('section_key', $sectionKey)->update('landing_page_sections', $payload);
            } else {
                $payload['created_at'] = $now;
                $this->db->insert('landing_page_sections', $payload);
            }

            $seeded++;
        }

        return $seeded;
    }

    private function seedLandingPageModule()
    {
        $modules_table = $this->db->query("SHOW TABLES LIKE 'modules'")->result_array();
        $roles_table = $this->db->query("SHOW TABLES LIKE 'roles'")->result_array();
        $role_permissions_table = $this->db->query("SHOW TABLES LIKE 'role_permissions'")->result_array();

        if (empty($modules_table) || empty($roles_table) || empty($role_permissions_table)) {
            return 0;
        }

        $module = $this->db->get_where('modules', ['name' => 'landing_page'])->row_array();
        if (empty($module)) {
            $payload = [
                'name' => 'landing_page',
                'display_name' => 'Landing Page Config',
                'controller' => 'landing_page',
                'icon' => 'bi bi-window',
                'parent_id' => null,
                'sort_order' => 0,
                'is_active' => 1
            ];

            $this->db->insert('modules', $payload);
            $module = $this->db->get_where('modules', ['name' => 'landing_page'])->row_array();
        }

        if (empty($module)) {
            return 0;
        }

        $seeded_permissions = 0;
        $roles = $this->db
            ->where_in('name', ['super_admin', 'admin'])
            ->get('roles')
            ->result_array();

        foreach ($roles as $role) {
            $permission = $this->db->get_where('role_permissions', [
                'role_id' => $role['id'],
                'module_id' => $module['id']
            ])->row_array();

            if (!empty($permission)) {
                continue;
            }

            $this->db->insert('role_permissions', [
                'role_id' => $role['id'],
                'module_id' => $module['id'],
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_approve' => 0
            ]);
            $seeded_permissions++;
        }

        return $seeded_permissions;
    }

    public function landing_page_sections()
    {
        if (!$this->authorize()) {
            show_404();
        }

        $seeded = $this->seedLandingPageSections();
        echo "Seeded {$seeded} landing page sections." . PHP_EOL;
    }

    public function landing_page_setup()
    {
        if (!$this->authorize()) {
            show_404();
        }

        $this->load->library('migration', [
            'migration_enabled' => true,
            'migration_type' => 'timestamp',
            'migration_path' => APPPATH . 'migrations/',
            'migration_table' => 'migrations',
            'migration_auto_latest' => false,
        ]);

        if ($this->migration->latest() === false) {
            show_error($this->migration->error_string());
        }

        $seeded_sections = $this->seedLandingPageSections();
        $seeded_permissions = $this->seedLandingPageModule();
        echo "Migration complete. Seeded {$seeded_sections} landing page sections and {$seeded_permissions} landing page permissions." . PHP_EOL;
    }

    public function landing_page_module()
    {
        if (!$this->authorize()) {
            show_404();
        }

        $seeded = $this->seedLandingPageModule();
        echo "Seeded {$seeded} landing page permissions." . PHP_EOL;
    }
}
