<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/BaseController.php';

class Katalog extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->load->library('permission');
        $this->load->library('template');
    }

    public function index()
    {
        $user_id = $_SESSION['user']['id'];

        // Check permission
        if (!$this->permission->check_permission($user_id, 'katalog', 'view')) {
            redirect(base_url());
        }

        $data['title'] = 'Katalog - ' . $this->template->title();
        $data['content'] = $this->load->view('katalog/index', $data, true);
        $this->load->view('TemplateDashboard', $data);
    }

    public function produk()
    {
        // Redirect to product page
        redirect(base_url() . 'product');
    }

    public function harga()
    {
        $user_id = $_SESSION['user']['id'];

        // Check permission
        if (!$this->permission->check_permission($user_id, 'katalog', 'view')) {
            redirect(base_url());
        }

        // Placeholder for future development
        $data['title'] = 'Harga - ' . $this->template->title();
        $data['content'] = '<div class="container-fluid"><h2>Harga</h2><p>Coming soon...</p></div>';
        $this->load->view('TemplateDashboard', $data);
    }

    public function laporan()
    {
        $user_id = $_SESSION['user']['id'];

        // Check permission
        if (!$this->permission->check_permission($user_id, 'katalog', 'view')) {
            redirect(base_url());
        }

        // Placeholder for future development
        $data['title'] = 'Laporan - ' . $this->template->title();
        $data['content'] = '<div class="container-fluid"><h2>Laporan</h2><p>Coming soon...</p></div>';
        $this->load->view('TemplateDashboard', $data);
    }
}
