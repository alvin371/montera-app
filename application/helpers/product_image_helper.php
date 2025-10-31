<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Product Image Helper
 *
 * Helper functions for handling product images with fallback support
 */

/**
 * Get product_3rd image URL with fallback to default
 *
 * @param string $img_filename - Filename from database (e.g., "123456789.jpg")
 * @param bool $return_path - If true, returns filesystem path instead of URL
 * @return string - Full URL or path to image
 */
if (!function_exists('get_product_3rd_image')) {
    function get_product_3rd_image($img_filename, $return_path = false)
    {
        $CI =& get_instance();

        // Default image
        $default_img = 'assets/img/product_3rd/default.png';

        // If no filename provided, return default
        if (empty($img_filename)) {
            return $return_path ? FCPATH . $default_img : base_url($default_img);
        }

        // Build file path
        $file_path = FCPATH . 'assets/img/product_3rd/' . $img_filename;

        // Check if file exists
        if (file_exists($file_path)) {
            $img_url = 'assets/img/product_3rd/' . $img_filename;
            return $return_path ? $file_path : base_url($img_url);
        }

        // Fallback to default
        return $return_path ? FCPATH . $default_img : base_url($default_img);
    }
}

/**
 * Get internal product image URL with fallback to default
 *
 * @param string $img_filename - Filename from database
 * @param bool $return_path - If true, returns filesystem path instead of URL
 * @return string - Full URL or path to image
 */
if (!function_exists('get_product_image')) {
    function get_product_image($img_filename, $return_path = false)
    {
        $CI =& get_instance();

        // Default image
        $default_img = 'assets/img/icon/icon-no.png';

        // If no filename provided, return default
        if (empty($img_filename)) {
            return $return_path ? FCPATH . $default_img : base_url($default_img);
        }

        // Build file path
        $file_path = FCPATH . 'assets/img/product/' . $img_filename;

        // Check if file exists
        if (file_exists($file_path)) {
            $img_url = 'assets/img/product/' . $img_filename;
            return $return_path ? $file_path : base_url($img_url);
        }

        // Fallback to default
        return $return_path ? FCPATH . $default_img : base_url($default_img);
    }
}

/**
 * Get product image URL based on source (internal or marketplace)
 *
 * @param array $product - Product array with 'img' and 'is_marketplace' fields
 * @param bool $return_path - If true, returns filesystem path instead of URL
 * @return string - Full URL or path to image
 */
if (!function_exists('get_product_image_url')) {
    function get_product_image_url($product, $return_path = false)
    {
        $is_marketplace = isset($product['is_marketplace']) && $product['is_marketplace'];
        $img_filename = $product['img'] ?? '';

        if ($is_marketplace) {
            return get_product_3rd_image($img_filename, $return_path);
        } else {
            return get_product_image($img_filename, $return_path);
        }
    }
}

/**
 * Check if product has a valid image
 *
 * @param string $img_filename - Filename from database
 * @param bool $is_marketplace - Whether this is a marketplace product
 * @return bool - True if valid image exists
 */
if (!function_exists('has_product_image')) {
    function has_product_image($img_filename, $is_marketplace = false)
    {
        if (empty($img_filename)) {
            return false;
        }

        $dir = $is_marketplace ? 'product_3rd' : 'product';
        $file_path = FCPATH . 'assets/img/' . $dir . '/' . $img_filename;

        return file_exists($file_path);
    }
}

/**
 * Get image tag HTML for product with fallback
 *
 * @param array $product - Product array
 * @param string $alt - Alt text for image
 * @param array $attributes - Additional HTML attributes (e.g., ['class' => 'img-fluid'])
 * @return string - HTML img tag
 */
if (!function_exists('product_image_tag')) {
    function product_image_tag($product, $alt = '', $attributes = [])
    {
        $img_url = get_product_image_url($product);
        $alt_text = !empty($alt) ? $alt : ($product['name'] ?? 'Product Image');

        // Build attributes string
        $attr_string = '';
        foreach ($attributes as $key => $value) {
            $attr_string .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }

        return '<img src="' . $img_url . '" alt="' . htmlspecialchars($alt_text) . '"' . $attr_string . '>';
    }
}
