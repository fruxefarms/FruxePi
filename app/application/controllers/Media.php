<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    ob_start();
	/**
	* FruxePi (frx-dev-v0.3)
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
            $this->load->model('Media_model');

		}

        // Upload Image
        public function upload_image()
        {
            $this->Media_model->uploadMedia();
        }

}

