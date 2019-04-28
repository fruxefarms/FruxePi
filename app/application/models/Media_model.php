<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Media Model
	*/
	class Media_model extends CI_Model
	{	

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
        }
        
        /**
		 * Upload file
		 * Upload file to tmp/ directory. 
		 * @return void
		 */
        public function uploadMedia()
        {
            $config = array(
                'upload_path' => "/var/www/html/assets/tmp/",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "5048000",
                // 'max_height' => "1920",
                // 'max_width' => "1080"
            );
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('image_upload')) {
                    $error = array('error' => $this->upload->display_errors());
            } else {
                    $data = array('upload_data' => $this->upload->data());
            }
        }


		/**
		 * Delete file
		 * Delete uploaded file. 
		 * @return void
		 */
		public function deleteMedia($file_path)
		{
            // Delete file
            return unlink($file_path);
		}
		

	}

