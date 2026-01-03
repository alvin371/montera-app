<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPageApi extends CI_Controller
{
    private $allowedSections = [
        'navbar',
        'hero',
        'features',
        'new-products',
        'customer-favorites',
        'team',
        'testimonials',
        'footer',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function section($sectionKey)
    {
        $sectionKey = strtolower(trim((string) $sectionKey));

        if (!in_array($sectionKey, $this->allowedSections, true)) {
            return $this->respondNotFound('Section not found.');
        }

        $row = $this->db->get_where(
            'landing_page_sections',
            ['section_key' => $sectionKey]
        )->row_array();

        if (!$row) {
            return $this->respondNotFound('Section not found.');
        }

        $content = json_decode($row['content'], true);
        if ($content === null && json_last_error() !== JSON_ERROR_NONE) {
            $content = $row['content'];
        }

        $payload = [
            'section_key' => $sectionKey,
            'content' => $content,
            'updated_at' => $row['updated_at'],
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    public function upload_icon()
    {
        if (strtoupper($this->input->method()) !== 'POST') {
            return $this->output
                ->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Method not allowed.']));
        }

        if (empty($_FILES['icon']['name'])) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Icon file is required.']));
        }

        $uploadPath = FCPATH . 'assets/uploads/landing-page/icons/';
        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0755, true)) {
            return $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Failed to create upload directory.']));
        }

        $config = [
            'upload_path' => $uploadPath,
            'allowed_types' => 'svg|png|jpg|jpeg|webp',
            'max_size' => 5120,
            'encrypt_name' => true,
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('icon')) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => $this->upload->display_errors('', '')]));
        }

        $data = $this->upload->data();
        $relativePath = 'assets/uploads/landing-page/icons/' . $data['file_name'];
        $payload = [
            'url' => base_url($relativePath),
            'path' => $relativePath,
            'mime' => $data['file_type'],
            'size_kb' => $data['file_size'],
            'type' => strtolower($data['file_ext']) === '.svg' ? 'svg' : 'raster',
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    public function upload_image()
    {
        if (strtoupper($this->input->method()) !== 'POST') {
            return $this->output
                ->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Method not allowed.']));
        }

        if (empty($_FILES['image']['name'])) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Image file is required.']));
        }

        $uploadPath = FCPATH . 'assets/uploads/landing-page/images/';
        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0755, true)) {
            return $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Failed to create upload directory.']));
        }

        $config = [
            'upload_path' => $uploadPath,
            'allowed_types' => 'svg|png|jpg|jpeg|webp',
            'max_size' => 5120,
            'encrypt_name' => true,
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => $this->upload->display_errors('', '')]));
        }

        $data = $this->upload->data();
        $relativePath = 'assets/uploads/landing-page/images/' . $data['file_name'];
        $payload = [
            'url' => base_url($relativePath),
            'path' => $relativePath,
            'mime' => $data['file_type'],
            'size_kb' => $data['file_size'],
            'type' => strtolower($data['file_ext']) === '.svg' ? 'svg' : 'raster',
        ];

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }

    private function respondNotFound($message)
    {
        return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => $message]));
    }
}
