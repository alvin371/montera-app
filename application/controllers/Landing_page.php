<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/BaseController.php';

class Landing_page extends BaseController
{
    private $featuresSectionKey = 'features';
    private $navbarSectionKey = 'navbar';
    private $heroSectionKey = 'hero';
    private $newProductsSectionKey = 'new-products';
    private $customerFavoritesSectionKey = 'customer-favorites';
    private $teamSectionKey = 'team';
    private $testimonialsSectionKey = 'testimonials';
    private $footerSectionKey = 'footer';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('mymodel');
        $this->load->library('template');

        $this->set_method_permissions([
            'features_header_update' => 'edit',
            'features_save' => 'edit',
            'features_delete' => 'delete',
            'navbar_logo_update' => 'edit',
            'navbar_link_save' => 'edit',
            'navbar_link_delete' => 'delete',
            'hero_update' => 'edit',
            'new_products_header_update' => 'edit',
            'new_products_save' => 'edit',
            'new_products_delete' => 'delete',
            'customer_favorites_header_update' => 'edit',
            'customer_favorites_save' => 'edit',
            'customer_favorites_delete' => 'delete',
            'team_header_update' => 'edit',
            'team_save' => 'edit',
            'team_delete' => 'delete',
            'testimonials_header_update' => 'edit',
            'testimonials_save' => 'edit',
            'testimonials_delete' => 'delete',
            'footer_update' => 'edit',
            'footer_info_link_save' => 'edit',
            'footer_info_link_delete' => 'delete',
            'footer_social_link_save' => 'edit',
            'footer_social_link_delete' => 'delete',
        ]);
    }

    public function index()
    {
        $data['title'] = 'Landing Page Config - ' . $this->template->title();
        $data['content'] = $this->load->view('landing_page/index', $data, true);
        $this->load->view('TemplateDashboard', $data);
    }

    public function navbar_data()
    {
        return $this->respondSection($this->navbarSectionKey);
    }

    public function navbar_logo_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $logoUrl = trim((string) $this->input->post('logo_url'));
        $logoAlt = trim((string) $this->input->post('logo_alt'));

        if ($logoUrl === '') {
            return $this->respondJson(false, 'Logo URL is required.');
        }

        $section = $this->getSectionContent($this->navbarSectionKey);
        $section['logo'] = [
            'url' => $logoUrl,
            'alt' => $logoAlt,
        ];

        $this->saveSectionContent($this->navbarSectionKey, $section);
        return $this->respondJson(true, 'Navbar logo updated.');
    }

    public function navbar_link_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $side = trim((string) $this->input->post('side'));
        $label = trim((string) $this->input->post('label'));
        $href = trim((string) $this->input->post('href'));

        if (!in_array($side, ['left', 'right'], true)) {
            return $this->respondJson(false, 'Side must be left or right.');
        }

        if ($label === '' || $href === '') {
            return $this->respondJson(false, 'Label and href are required.');
        }

        $section = $this->getSectionContent($this->navbarSectionKey);
        $key = $side === 'left' ? 'links_left' : 'links_right';
        if (!isset($section[$key]) || !is_array($section[$key])) {
            $section[$key] = [];
        }

        $isUpdate = false;
        foreach ($section[$key] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['label'] = $label;
                $item['href'] = $href;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section[$key][] = [
                'id' => $id !== '' ? $id : $this->generateId('nav'),
                'label' => $label,
                'href' => $href,
            ];
        }

        $this->saveSectionContent($this->navbarSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Link updated.' : 'Link added.');
    }

    public function navbar_link_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $side = trim((string) $this->input->post('side'));
        if ($id === '' || !in_array($side, ['left', 'right'], true)) {
            return $this->respondJson(false, 'Invalid request.');
        }

        $section = $this->getSectionContent($this->navbarSectionKey);
        $key = $side === 'left' ? 'links_left' : 'links_right';
        if (!isset($section[$key]) || !is_array($section[$key])) {
            $section[$key] = [];
        }

        $section[$key] = array_values(array_filter($section[$key], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->navbarSectionKey, $section);
        return $this->respondJson(true, 'Link deleted.');
    }

    public function hero_data()
    {
        return $this->respondSection($this->heroSectionKey);
    }

    public function hero_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $section = $this->getSectionContent($this->heroSectionKey);
        $section['background_image_url'] = trim((string) $this->input->post('background_image_url'));
        $section['title'] = [
            'line_1' => trim((string) $this->input->post('title_line_1')),
            'line_2' => trim((string) $this->input->post('title_line_2')),
        ];
        $section['subtitle'] = trim((string) $this->input->post('subtitle'));
        $section['primary_cta'] = [
            'label' => trim((string) $this->input->post('primary_label')),
            'href' => trim((string) $this->input->post('primary_href')),
        ];
        $section['secondary_cta'] = [
            'label' => trim((string) $this->input->post('secondary_label')),
            'href' => trim((string) $this->input->post('secondary_href')),
        ];

        if ($section['title']['line_1'] === '' || $section['subtitle'] === '') {
            return $this->respondJson(false, 'Title and subtitle are required.');
        }

        $this->saveSectionContent($this->heroSectionKey, $section);
        return $this->respondJson(true, 'Hero updated.');
    }

    public function new_products_data()
    {
        return $this->respondSection($this->newProductsSectionKey);
    }

    public function new_products_header_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $eyebrow = trim((string) $this->input->post('eyebrow'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->newProductsSectionKey);
        $section['eyebrow'] = $eyebrow;
        $section['title'] = $title;
        $section['description'] = $description;

        $this->saveSectionContent($this->newProductsSectionKey, $section);
        return $this->respondJson(true, 'New Products header updated.');
    }

    public function new_products_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $name = trim((string) $this->input->post('name'));
        $category = trim((string) $this->input->post('category'));
        $description = trim((string) $this->input->post('description'));
        $image = trim((string) $this->input->post('image'));
        $featuresJson = (string) $this->input->post('features');
        $features = json_decode($featuresJson, true);

        if ($name === '' || $description === '') {
            return $this->respondJson(false, 'Name and description are required.');
        }

        if (!is_array($features)) {
            $features = [];
        }

        $section = $this->getSectionContent($this->newProductsSectionKey);
        if (!isset($section['products']) || !is_array($section['products'])) {
            $section['products'] = [];
        }

        $isUpdate = false;
        foreach ($section['products'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['name'] = $name;
                $item['category'] = $category;
                $item['description'] = $description;
                $item['image'] = $image;
                $item['features'] = $features;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['products'][] = [
                'id' => $id !== '' ? $id : $this->generateId('prod'),
                'name' => $name,
                'category' => $category,
                'description' => $description,
                'image' => $image,
                'features' => $features,
            ];
        }

        $this->saveSectionContent($this->newProductsSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Product updated.' : 'Product added.');
    }

    public function new_products_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Product ID is required.');
        }

        $section = $this->getSectionContent($this->newProductsSectionKey);
        if (!isset($section['products']) || !is_array($section['products'])) {
            $section['products'] = [];
        }

        $section['products'] = array_values(array_filter($section['products'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->newProductsSectionKey, $section);
        return $this->respondJson(true, 'Product deleted.');
    }

    public function customer_favorites_data()
    {
        return $this->respondSection($this->customerFavoritesSectionKey);
    }

    public function customer_favorites_header_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $eyebrow = trim((string) $this->input->post('eyebrow'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->customerFavoritesSectionKey);
        $section['eyebrow'] = $eyebrow;
        $section['title'] = $title;
        $section['description'] = $description;

        $this->saveSectionContent($this->customerFavoritesSectionKey, $section);
        return $this->respondJson(true, 'Customer Favorites header updated.');
    }

    public function customer_favorites_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $categoryHeading = trim((string) $this->input->post('category_heading'));
        $categoryDescription = $this->splitParagraphs($this->input->post('category_description'));
        $productName = trim((string) $this->input->post('product_name'));
        $productDescription = trim((string) $this->input->post('product_description'));
        $productImage = trim((string) $this->input->post('product_image'));
        $productMiniImage = trim((string) $this->input->post('product_mini_image'));

        if ($categoryHeading === '' || $productName === '') {
            return $this->respondJson(false, 'Category heading and product name are required.');
        }

        $section = $this->getSectionContent($this->customerFavoritesSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $isUpdate = false;
        foreach ($section['items'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['category_heading'] = $categoryHeading;
                $item['category_description'] = $categoryDescription;
                $item['product_showcase'] = [
                    'name' => $productName,
                    'description' => $productDescription,
                    'image' => $productImage,
                    'mini_image' => $productMiniImage,
                ];
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['items'][] = [
                'id' => $id !== '' ? $id : $this->generateId('fav'),
                'category_heading' => $categoryHeading,
                'category_description' => $categoryDescription,
                'product_showcase' => [
                    'name' => $productName,
                    'description' => $productDescription,
                    'image' => $productImage,
                    'mini_image' => $productMiniImage,
                ],
            ];
        }

        $this->saveSectionContent($this->customerFavoritesSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Item updated.' : 'Item added.');
    }

    public function customer_favorites_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Item ID is required.');
        }

        $section = $this->getSectionContent($this->customerFavoritesSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $section['items'] = array_values(array_filter($section['items'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->customerFavoritesSectionKey, $section);
        return $this->respondJson(true, 'Item deleted.');
    }

    public function team_data()
    {
        return $this->respondSection($this->teamSectionKey);
    }

    public function team_header_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $eyebrow = trim((string) $this->input->post('eyebrow'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->teamSectionKey);
        $section['eyebrow'] = $eyebrow;
        $section['title'] = $title;
        $section['description'] = $description;

        $this->saveSectionContent($this->teamSectionKey, $section);
        return $this->respondJson(true, 'Team header updated.');
    }

    public function team_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $name = trim((string) $this->input->post('name'));
        $role = trim((string) $this->input->post('role'));
        $image = trim((string) $this->input->post('image'));

        if ($name === '' || $role === '') {
            return $this->respondJson(false, 'Name and role are required.');
        }

        $section = $this->getSectionContent($this->teamSectionKey);
        if (!isset($section['members']) || !is_array($section['members'])) {
            $section['members'] = [];
        }

        $isUpdate = false;
        foreach ($section['members'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['name'] = $name;
                $item['role'] = $role;
                $item['image'] = $image;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['members'][] = [
                'id' => $id !== '' ? $id : $this->generateId('team'),
                'name' => $name,
                'role' => $role,
                'image' => $image,
            ];
        }

        $this->saveSectionContent($this->teamSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Member updated.' : 'Member added.');
    }

    public function team_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Member ID is required.');
        }

        $section = $this->getSectionContent($this->teamSectionKey);
        if (!isset($section['members']) || !is_array($section['members'])) {
            $section['members'] = [];
        }

        $section['members'] = array_values(array_filter($section['members'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->teamSectionKey, $section);
        return $this->respondJson(true, 'Member deleted.');
    }

    public function testimonials_data()
    {
        return $this->respondSection($this->testimonialsSectionKey);
    }

    public function testimonials_header_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $eyebrow = trim((string) $this->input->post('eyebrow'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->testimonialsSectionKey);
        $section['eyebrow'] = $eyebrow;
        $section['title'] = $title;
        $section['description'] = $description;

        $this->saveSectionContent($this->testimonialsSectionKey, $section);
        return $this->respondJson(true, 'Testimonials header updated.');
    }

    public function testimonials_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $name = trim((string) $this->input->post('name'));
        $role = trim((string) $this->input->post('role'));
        $beforeImage = trim((string) $this->input->post('before_image'));
        $afterImage = trim((string) $this->input->post('after_image'));
        $content = (string) $this->input->post('content');
        $rating = (int) $this->input->post('rating');

        if ($name === '' || $content === '') {
            return $this->respondJson(false, 'Name and content are required.');
        }

        if ($rating < 1) {
            $rating = 1;
        }
        if ($rating > 5) {
            $rating = 5;
        }

        $section = $this->getSectionContent($this->testimonialsSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $isUpdate = false;
        foreach ($section['items'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['name'] = $name;
                $item['role'] = $role;
                $item['before_image'] = $beforeImage;
                $item['after_image'] = $afterImage;
                $item['content'] = $content;
                $item['rating'] = $rating;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['items'][] = [
                'id' => $id !== '' ? $id : $this->generateId('testi'),
                'name' => $name,
                'role' => $role,
                'before_image' => $beforeImage,
                'after_image' => $afterImage,
                'content' => $content,
                'rating' => $rating,
            ];
        }

        $this->saveSectionContent($this->testimonialsSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Testimonial updated.' : 'Testimonial added.');
    }

    public function testimonials_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Testimonial ID is required.');
        }

        $section = $this->getSectionContent($this->testimonialsSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $section['items'] = array_values(array_filter($section['items'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->testimonialsSectionKey, $section);
        return $this->respondJson(true, 'Testimonial deleted.');
    }

    public function footer_data()
    {
        return $this->respondSection($this->footerSectionKey);
    }

    public function footer_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $logoUrl = trim((string) $this->input->post('logo_url'));
        $logoAlt = trim((string) $this->input->post('logo_alt'));
        $taglines = $this->splitParagraphs($this->input->post('taglines'));
        $newsletterPlaceholder = trim((string) $this->input->post('newsletter_placeholder'));
        $newsletterCta = trim((string) $this->input->post('newsletter_cta'));
        $phone = trim((string) $this->input->post('contact_phone'));
        $email = trim((string) $this->input->post('contact_email'));
        $addresses = $this->splitParagraphs($this->input->post('contact_addresses'));

        $section = $this->getSectionContent($this->footerSectionKey);
        $section['logo'] = [
            'url' => $logoUrl,
            'alt' => $logoAlt,
        ];
        $section['taglines'] = $taglines;
        $section['newsletter'] = [
            'placeholder' => $newsletterPlaceholder,
            'cta_label' => $newsletterCta,
        ];
        $section['contact'] = [
            'phone' => $phone,
            'email' => $email,
            'addresses' => $addresses,
        ];

        $this->saveSectionContent($this->footerSectionKey, $section);
        return $this->respondJson(true, 'Footer updated.');
    }

    public function footer_info_link_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $label = trim((string) $this->input->post('label'));
        $href = trim((string) $this->input->post('href'));

        if ($label === '' || $href === '') {
            return $this->respondJson(false, 'Label and href are required.');
        }

        $section = $this->getSectionContent($this->footerSectionKey);
        if (!isset($section['info_links']) || !is_array($section['info_links'])) {
            $section['info_links'] = [];
        }

        $isUpdate = false;
        foreach ($section['info_links'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['label'] = $label;
                $item['href'] = $href;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['info_links'][] = [
                'id' => $id !== '' ? $id : $this->generateId('info'),
                'label' => $label,
                'href' => $href,
            ];
        }

        $this->saveSectionContent($this->footerSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Info link updated.' : 'Info link added.');
    }

    public function footer_info_link_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Link ID is required.');
        }

        $section = $this->getSectionContent($this->footerSectionKey);
        if (!isset($section['info_links']) || !is_array($section['info_links'])) {
            $section['info_links'] = [];
        }

        $section['info_links'] = array_values(array_filter($section['info_links'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->footerSectionKey, $section);
        return $this->respondJson(true, 'Info link deleted.');
    }

    public function footer_social_link_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $platform = trim((string) $this->input->post('platform'));
        $href = trim((string) $this->input->post('href'));
        $icon = trim((string) $this->input->post('icon'));

        if ($platform === '' || $href === '') {
            return $this->respondJson(false, 'Platform and href are required.');
        }

        $section = $this->getSectionContent($this->footerSectionKey);
        if (!isset($section['social_links']) || !is_array($section['social_links'])) {
            $section['social_links'] = [];
        }

        $isUpdate = false;
        foreach ($section['social_links'] as &$item) {
            if (isset($item['id']) && $item['id'] === $id && $id !== '') {
                $item['platform'] = $platform;
                $item['href'] = $href;
                $item['icon'] = $icon;
                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $section['social_links'][] = [
                'id' => $id !== '' ? $id : $this->generateId('social'),
                'platform' => $platform,
                'href' => $href,
                'icon' => $icon,
            ];
        }

        $this->saveSectionContent($this->footerSectionKey, $section);
        return $this->respondJson(true, $isUpdate ? 'Social link updated.' : 'Social link added.');
    }

    public function footer_social_link_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Link ID is required.');
        }

        $section = $this->getSectionContent($this->footerSectionKey);
        if (!isset($section['social_links']) || !is_array($section['social_links'])) {
            $section['social_links'] = [];
        }

        $section['social_links'] = array_values(array_filter($section['social_links'], function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->footerSectionKey, $section);
        return $this->respondJson(true, 'Social link deleted.');
    }

    public function features_data()
    {
        return $this->respondSection($this->featuresSectionKey);
    }

    public function features_header_update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $eyebrow = trim((string) $this->input->post('eyebrow'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->featuresSectionKey);
        $section['eyebrow'] = $eyebrow;
        $section['title'] = $title;
        $section['description'] = $description;

        $this->saveSectionContent($this->featuresSectionKey, $section);

        return $this->respondJson(true, 'Feature header updated.');
    }

    public function features_save()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        $title = trim((string) $this->input->post('title'));
        $description = trim((string) $this->input->post('description'));
        $position = trim((string) $this->input->post('position'));
        $iconUrl = trim((string) $this->input->post('icon_url'));
        $iconType = trim((string) $this->input->post('icon_type'));
        $iconAlt = trim((string) $this->input->post('icon_alt'));
        $hasImage = $this->input->post('has_image') === '1';

        if ($title === '' || $description === '') {
            return $this->respondJson(false, 'Title and description are required.');
        }

        $section = $this->getSectionContent($this->featuresSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $isUpdate = false;
        foreach ($section['items'] as &$item) {
            if ($item['id'] === $id && $id !== '') {
                $item['title'] = $title;
                $item['description'] = $description;
                $item['position'] = $position;
                $item['has_image'] = $hasImage ? true : false;

                if ($iconUrl !== '') {
                    $item['icon_url'] = $iconUrl;
                    $item['icon_type'] = $iconType !== '' ? $iconType : 'raster';
                    $item['icon_alt'] = $iconAlt;
                }

                $isUpdate = true;
                break;
            }
        }
        unset($item);

        if (!$isUpdate) {
            $newId = $id !== '' ? $id : (string) time();
            $newItem = [
                'id' => $newId,
                'title' => $title,
                'description' => $description,
                'position' => $position,
                'has_image' => $hasImage ? true : false,
            ];

            if ($iconUrl !== '') {
                $newItem['icon_url'] = $iconUrl;
                $newItem['icon_type'] = $iconType !== '' ? $iconType : 'raster';
                $newItem['icon_alt'] = $iconAlt;
            }

            $section['items'][] = $newItem;
        }

        $this->saveSectionContent($this->featuresSectionKey, $section);

        return $this->respondJson(true, $isUpdate ? 'Feature updated.' : 'Feature added.');
    }

    public function features_delete()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = trim((string) $this->input->post('id'));
        if ($id === '') {
            return $this->respondJson(false, 'Feature ID is required.');
        }

        $section = $this->getSectionContent($this->featuresSectionKey);
        if (!isset($section['items']) || !is_array($section['items'])) {
            $section['items'] = [];
        }

        $section['items'] = array_values(array_filter($section['items'], function ($item) use ($id) {
            return $item['id'] !== $id;
        }));

        $this->saveSectionContent($this->featuresSectionKey, $section);

        return $this->respondJson(true, 'Feature deleted.');
    }

    private function respondSection($sectionKey)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $section = $this->getSectionContent($sectionKey);
        $section = $this->normalizeSectionIds($sectionKey, $section);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $section,
            ]));
    }

    private function getSectionContent($sectionKey)
    {
        $row = $this->db->get_where('landing_page_sections', [
            'section_key' => $sectionKey,
        ])->row_array();

        if (!$row) {
            return [];
        }

        $content = json_decode($row['content'], true);
        if (!is_array($content)) {
            return [];
        }

        return $content;
    }

    private function normalizeSectionIds($sectionKey, $section)
    {
        $changed = false;

        if (!is_array($section)) {
            return $section;
        }

        $applyIds = function ($items, $prefix) use (&$changed) {
            if (!is_array($items)) {
                return [];
            }

            foreach ($items as &$item) {
                if (!isset($item['id']) || $item['id'] === '') {
                    $item['id'] = $this->generateId($prefix);
                    $changed = true;
                }
            }
            unset($item);
            return $items;
        };

        switch ($sectionKey) {
            case $this->navbarSectionKey:
                $section['links_left'] = $applyIds($section['links_left'] ?? [], 'nav');
                $section['links_right'] = $applyIds($section['links_right'] ?? [], 'nav');
                break;
            case $this->newProductsSectionKey:
                $section['products'] = $applyIds($section['products'] ?? [], 'prod');
                break;
            case $this->customerFavoritesSectionKey:
                $section['items'] = $applyIds($section['items'] ?? [], 'fav');
                break;
            case $this->teamSectionKey:
                $section['members'] = $applyIds($section['members'] ?? [], 'team');
                break;
            case $this->testimonialsSectionKey:
                $section['items'] = $applyIds($section['items'] ?? [], 'testi');
                break;
            case $this->footerSectionKey:
                $section['info_links'] = $applyIds($section['info_links'] ?? [], 'info');
                $section['social_links'] = $applyIds($section['social_links'] ?? [], 'social');
                break;
            case $this->featuresSectionKey:
                $section['items'] = $applyIds($section['items'] ?? [], 'feat');
                break;
        }

        if ($changed) {
            $this->saveSectionContent($sectionKey, $section);
        }

        return $section;
    }

    private function generateId($prefix)
    {
        return $prefix . '_' . uniqid();
    }

    private function splitParagraphs($text)
    {
        if ($text === null) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', (string) $text);
        $lines = array_map('trim', $lines);
        $lines = array_filter($lines, function ($line) {
            return $line !== '';
        });

        return array_values($lines);
    }

    private function saveSectionContent($sectionKey, $content)
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            'section_key' => $sectionKey,
            'content' => json_encode($content, JSON_UNESCAPED_SLASHES),
            'updated_at' => $now,
        ];

        $existing = $this->db->get_where('landing_page_sections', [
            'section_key' => $sectionKey,
        ])->row_array();

        if ($existing) {
            $this->db->where('section_key', $sectionKey)->update('landing_page_sections', $data);
        } else {
            $data['created_at'] = $now;
            $this->db->insert('landing_page_sections', $data);
        }
    }

    private function respondJson($success, $message)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $success,
                'message' => $message,
            ]));
    }
}
