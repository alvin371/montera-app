<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_landing_page_sections extends CI_Migration
{
    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'section_key' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'content' => [
                'type' => 'LONGTEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('landing_page_sections', true);

        $this->db->query(
            'ALTER TABLE `landing_page_sections` ADD UNIQUE KEY `section_key_unique` (`section_key`)'
        );
    }

    public function down()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('landing_page_sections', true);
    }
}
