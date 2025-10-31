<?php
/**
 * Table Description Utility Script
 *
 * This script describes the structure and relationships between:
 * - product (internal inventory)
 * - product_3rd (marketplace parent products)
 * - product_variant_3rd (marketplace variants with configuration)
 *
 * Usage: Run this file in browser or CLI to see table structures
 */

// Load CodeIgniter framework
require_once('index.php');

// Get CI instance
$CI =& get_instance();
$CI->load->database();
$CI->load->model('mymodel');

// Set header for proper display
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Tables Description</title>
    <style>
        body { font-family: 'Courier New', monospace; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }
        h2 { color: #555; margin-top: 30px; border-bottom: 2px solid #2196F3; padding-bottom: 5px; }
        h3 { color: #666; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th { background: #4CAF50; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border: 1px solid #ddd; }
        tr:nth-child(even) { background: #f9f9f9; }
        .info { background: #E3F2FD; padding: 15px; border-left: 4px solid #2196F3; margin: 15px 0; }
        .warning { background: #FFF3E0; padding: 15px; border-left: 4px solid #FF9800; margin: 15px 0; }
        .success { background: #E8F5E9; padding: 15px; border-left: 4px solid #4CAF50; margin: 15px 0; }
        pre { background: #263238; color: #ADBAC7; padding: 15px; border-radius: 5px; overflow-x: auto; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 3px; font-size: 12px; font-weight: bold; }
        .badge-primary { background: #2196F3; color: white; }
        .badge-success { background: #4CAF50; color: white; }
        .badge-warning { background: #FF9800; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Product Tables Structure & Relationships</h1>

        <div class="info">
            <strong>ℹ️ System Architecture:</strong> This application uses a <strong>dual-system architecture</strong>:
            <ul>
                <li><code>product</code> - Internal inventory (manually created, real stock tracking)</li>
                <li><code>product_3rd + product_variant_3rd</code> - Marketplace products (auto-synced from Shopee/Lazada/TikTok)</li>
                <li><strong>JSON Configuration</strong> - Maps marketplace SKUs to internal products (supports bundles)</li>
            </ul>
        </div>

        <?php
        // Function to describe table
        function describeTable($CI, $tableName, $description) {
            echo "<h2>📋 Table: <code>{$tableName}</code></h2>";
            echo "<p><strong>Purpose:</strong> {$description}</p>";

            // Get table structure
            $query = $CI->db->query("DESCRIBE {$tableName}");

            if ($query->num_rows() > 0) {
                echo "<h3>Table Structure:</h3>";
                echo "<table>";
                echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";

                foreach ($query->result_array() as $row) {
                    echo "<tr>";
                    echo "<td><strong>{$row['Field']}</strong></td>";
                    echo "<td>{$row['Type']}</td>";
                    echo "<td>{$row['Null']}</td>";
                    echo "<td>" . ($row['Key'] ? "<span class='badge badge-warning'>{$row['Key']}</span>" : "-") . "</td>";
                    echo "<td>" . ($row['Default'] !== null ? $row['Default'] : "NULL") . "</td>";
                    echo "<td>" . ($row['Extra'] ? "<span class='badge badge-primary'>{$row['Extra']}</span>" : "-") . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }

            // Get row count
            $count = $CI->db->count_all($tableName);
            echo "<div class='success'><strong>Total Records:</strong> " . number_format($count) . "</div>";

            // Show sample data (5 rows)
            $sample = $CI->db->limit(5)->get($tableName);
            if ($sample->num_rows() > 0) {
                echo "<h3>Sample Data (First 5 rows):</h3>";
                echo "<table>";

                $first = true;
                foreach ($sample->result_array() as $row) {
                    if ($first) {
                        echo "<tr>";
                        foreach (array_keys($row) as $key) {
                            echo "<th>{$key}</th>";
                        }
                        echo "</tr>";
                        $first = false;
                    }

                    echo "<tr>";
                    foreach ($row as $value) {
                        $display = $value;
                        if (strlen($display) > 50) {
                            $display = substr($display, 0, 50) . "...";
                        }
                        echo "<td>" . htmlspecialchars($display) . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<div class='warning'>⚠️ No sample data available (table is empty)</div>";
            }
        }

        // Describe each table
        describeTable($CI, 'product', 'Internal inventory products - manually created, used for real stock tracking. Supports variants via parent_id relationship.');
        describeTable($CI, 'product_3rd', 'Marketplace parent products - auto-synced from Shopee/Lazada/TikTok APIs. Contains product catalog information.');
        describeTable($CI, 'product_variant_3rd', 'Marketplace product variants - each SKU from marketplace with JSON configuration mapping to internal products.');

        // Show relationships
        ?>

        <h2>🔗 Table Relationships</h2>

        <div class="info">
            <h3>1. Internal Product Variants (product table)</h3>
            <pre>product (parent)
    ↓ parent_id
product (variants)
    - parent_id = parent product id
    - is_varian = 1</pre>

            <strong>Example Query:</strong>
            <pre>SELECT * FROM product WHERE parent_id = [parent_id]</pre>
        </div>

        <div class="info">
            <h3>2. Marketplace Product Structure (product_3rd → product_variant_3rd)</h3>
            <pre>product_3rd (parent)
    ↓ id (internal primary key)
product_variant_3rd (variants)
    - id_parent = product_3rd.id
    - id_product_parent = marketplace parent ID
    - marketplace = 'Shopee'|'Lazada'|'TikTok'</pre>

            <strong>Example Query:</strong>
            <pre>SELECT v.*
FROM product_variant_3rd v
JOIN product_3rd p ON v.id_parent = p.id
WHERE p.id = [parent_id]</pre>
        </div>

        <div class="warning">
            <h3>3. Configuration Mapping (product_variant_3rd → product)</h3>
            <pre>product_variant_3rd.json (JSON field)
    ↓ Maps to multiple internal products
product table items
    - Used for stock deduction
    - Supports bundle mapping</pre>

            <strong>JSON Structure Example:</strong>
            <pre>{
  "0": {
    "product": "123",        // ID from 'product' table
    "product_text": "Product Name",
    "brand": "BRAND01",
    "qty": "2",
    "unit": "Pcs"
  },
  "1": {
    "product": "456",
    "product_text": "Another Product",
    "brand": "BRAND01",
    "qty": "1",
    "unit": "Box"
  }
}</pre>
            <p><strong>⚠️ Critical:</strong> This JSON configuration determines which internal products are deducted when a marketplace order is received.</p>
        </div>

        <h2>📊 Statistics</h2>

        <?php
        // Get statistics
        $stats = array();

        // Product stats
        $stats['product_total'] = $CI->db->count_all('product');
        $stats['product_active'] = $CI->db->where('status', 'Aktif')->count_all_results('product');
        $stats['product_parents'] = $CI->db->where('(parent_id = 0 OR parent_id IS NULL)')->where('is_operational', 0)->count_all_results('product');
        $stats['product_variants'] = $CI->db->where('parent_id !=', 0)->where('parent_id IS NOT NULL', null, false)->count_all_results('product');

        // Product_3rd stats
        $stats['product_3rd_total'] = $CI->db->count_all('product_3rd');
        $stats['product_3rd_active'] = $CI->db->where('status', 'Aktif')->count_all_results('product_3rd');
        $stats['product_3rd_shopee'] = $CI->db->where('marketplace', 'Shopee')->count_all_results('product_3rd');
        $stats['product_3rd_lazada'] = $CI->db->where('marketplace', 'Lazada')->count_all_results('product_3rd');
        $stats['product_3rd_tiktok'] = $CI->db->where('marketplace', 'TikTok')->count_all_results('product_3rd');

        // Product_variant_3rd stats
        $stats['variant_3rd_total'] = $CI->db->count_all('product_variant_3rd');
        $stats['variant_3rd_configured'] = $CI->db->where('json !=', '')->where('json IS NOT NULL', null, false)->count_all_results('product_variant_3rd');
        $stats['variant_3rd_unconfigured'] = $CI->db->where('(json = "" OR json IS NULL)')->count_all_results('product_variant_3rd');
        ?>

        <table>
            <tr><th colspan="2" style="background: #4CAF50;">Internal Products (product)</th></tr>
            <tr><td>Total Products</td><td><strong><?php echo number_format($stats['product_total']); ?></strong></td></tr>
            <tr><td>Active Products</td><td><?php echo number_format($stats['product_active']); ?></td></tr>
            <tr><td>Parent Products (no variants)</td><td><?php echo number_format($stats['product_parents']); ?></td></tr>
            <tr><td>Variant Products</td><td><?php echo number_format($stats['product_variants']); ?></td></tr>
        </table>

        <table>
            <tr><th colspan="2" style="background: #2196F3;">Marketplace Products (product_3rd)</th></tr>
            <tr><td>Total Marketplace Products</td><td><strong><?php echo number_format($stats['product_3rd_total']); ?></strong></td></tr>
            <tr><td>Active</td><td><?php echo number_format($stats['product_3rd_active']); ?></td></tr>
            <tr><td>Shopee Products</td><td><?php echo number_format($stats['product_3rd_shopee']); ?></td></tr>
            <tr><td>Lazada Products</td><td><?php echo number_format($stats['product_3rd_lazada']); ?></td></tr>
            <tr><td>TikTok Products</td><td><?php echo number_format($stats['product_3rd_tiktok']); ?></td></tr>
        </table>

        <table>
            <tr><th colspan="2" style="background: #FF9800;">Marketplace Variants (product_variant_3rd)</th></tr>
            <tr><td>Total Variants</td><td><strong><?php echo number_format($stats['variant_3rd_total']); ?></strong></td></tr>
            <tr><td>Configured (has JSON mapping)</td><td><span class='badge badge-success'><?php echo number_format($stats['variant_3rd_configured']); ?></span></td></tr>
            <tr><td>Unconfigured (missing mapping)</td><td><span class='badge badge-warning'><?php echo number_format($stats['variant_3rd_unconfigured']); ?></span></td></tr>
        </table>

        <h2>🔍 Configuration Analysis</h2>

        <?php
        // Find sample configurations
        $configured = $CI->db
            ->select('id, name, sku, marketplace, shop_name, json')
            ->where('json !=', '')
            ->where('json IS NOT NULL', null, false)
            ->limit(3)
            ->get('product_variant_3rd');

        if ($configured->num_rows() > 0) {
            echo "<h3>Sample Product Configurations:</h3>";
            foreach ($configured->result_array() as $idx => $conf) {
                echo "<div class='success'>";
                echo "<strong>Variant #" . ($idx + 1) . ":</strong> {$conf['name']} (SKU: {$conf['sku']})<br>";
                echo "<strong>Marketplace:</strong> {$conf['marketplace']} - {$conf['shop_name']}<br>";
                echo "<strong>Configuration JSON:</strong>";

                $json = json_decode($conf['json'], true);
                if ($json && is_array($json)) {
                    echo "<pre>" . json_encode($json, JSON_PRETTY_PRINT) . "</pre>";

                    // Decode and show what products this maps to
                    echo "<strong>Maps to:</strong><ul>";
                    foreach ($json as $item) {
                        if (isset($item['product'])) {
                            $prod = $CI->mymodel->selectDataOne('product', array('id' => $item['product']));
                            if ($prod) {
                                echo "<li>{$item['qty']} {$item['unit']} of <strong>{$prod['name']}</strong> (ID: {$item['product']})</li>";
                            }
                        }
                    }
                    echo "</ul>";
                } else {
                    echo "<pre>" . htmlspecialchars($conf['json']) . "</pre>";
                }
                echo "</div>";
            }
        } else {
            echo "<div class='warning'>⚠️ No configured variants found. Please configure marketplace products in Product_3rd controller.</div>";
        }
        ?>

        <h2>📝 Key Takeaways</h2>

        <div class="info">
            <ul>
                <li><strong>NOT a migration:</strong> Both systems run in parallel permanently</li>
                <li><strong>product table:</strong> Real inventory that you manually manage</li>
                <li><strong>product_3rd tables:</strong> Marketplace catalog synced from APIs</li>
                <li><strong>JSON configuration:</strong> Critical bridge that maps marketplace SKUs to real inventory</li>
                <li><strong>Bundle support:</strong> 1 marketplace SKU can map to multiple internal products</li>
                <li><strong>Stock deduction:</strong> Always happens on internal <code>product</code> table based on JSON config</li>
            </ul>
        </div>

        <div class="warning">
            <strong>⚠️ Important Files:</strong>
            <ul>
                <li><code>application/controllers/Product.php</code> - Internal product management</li>
                <li><code>application/controllers/Product_3rd.php</code> - Marketplace product configuration</li>
                <li><code>application/controllers/Api_v2.php</code> - Sync & order processing (lines 1717-1726, 2609-2627, 3351-3860)</li>
                <li><code>application/views/product_3rd/edit.php</code> - Configuration editor (lines 68-150)</li>
            </ul>
        </div>

        <div style="margin-top: 30px; padding: 20px; background: #263238; color: #ADBAC7; border-radius: 5px;">
            <strong>Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?><br>
            <strong>Database:</strong> <?php echo $CI->db->database; ?><br>
            <strong>Server:</strong> <?php echo $CI->db->hostname; ?>
        </div>

    </div>
</body>
</html>
