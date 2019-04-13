<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    ob_start();
	/**
	* FruxePi (frx-dev-v0.2)
	* Media Controller
	*/
	class Media extends CI_Controller 
	{
		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

			$this->load->model('Dashboard_model');
			$this->load->model('Crop_model');
			$this->load->model('Lights_model');
			$this->load->model('Fan_model');
			$this->load->model('Pump_model');
			$this->load->model('Climate_model');
			$this->load->model('Camera_model');
			$this->load->model('Moisture_model');
		}

        // Upload Image
        public function upload_image()
        {
            
            $config = array(
                'upload_path' => "/var/www/html/assets/tmp/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1920",
                'max_width' => "1080"
            );
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('crop_thumbnail')) {
                    $error = array('error' => $this->upload->display_errors());

                    // $this->load->view('upload_form', $error);
            } else {
                    $data = array('upload_data' => $this->upload->data());

                    // $this->load->view('upload_success', $data);
            }
        }

}

