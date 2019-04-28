<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    ob_start();
	/**
	* FruxePi (frx-dev-v0.3)
	* Crops Controller
	*/
	class Crop extends CI_Controller 
	{
		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->helper('form');
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

		/**
		* Crop - Index
		* Main page for adding, editing and viewing crops. 
		* 
		* @url /crop
		*/
		public function index()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Page Meta
				$data['title'] = 'Crop';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['crops'] = $this->Crop_model->getAllCropsInfo();
				$data['sensor_state'] = $this->Dashboard_model->get_sensor_activation_state();

				// Page View
				$this->load->view('crop/index', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}


		/**
		* Crop - Create Crop
		* Create a new crop. 
		* 
		* @url /crop/new
		*/
		public function createCrop()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Form validation rules
				$this->form_validation->set_rules('nickname', 'Nickname', 'required');
				$this->form_validation->set_rules('plant_qty', 'Plant Quantity', 'required');
				$this->form_validation->set_rules('plant_type', 'Plant Type', 'required');
				$this->form_validation->set_rules('crop_start', 'Crop Start', 'required');
				$this->form_validation->set_rules('crop_end', 'Crop End', 'required');

                if ($this->form_validation->run() == FALSE)
                {
					// Page Meta
					$data['title'] = 'Create Crop';

					// Data Fetch
					$data['user_info'] = $this->Dashboard_model->get_user_info();

					// Page View
					$this->load->view('crop/new_crop', $data);
                }
                else
                {
					$this->Crop_model->setupCrop();
					redirect('/crop');
				}
				
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Crop - Edit Crop
		* Edit an existing crop and modify its parameters. 
		* 
		* @url /crop/edit/<cropID>
		*
		* @param string $cropID - A string which is the unique crop identifier. 
		*/
		public function editCrop($cropID)
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Form validation rules
				$this->form_validation->set_rules('nickname', 'Nickname', 'required');
				$this->form_validation->set_rules('plant_qty', 'Plant Quantity', 'required');
				$this->form_validation->set_rules('plant_type', 'Plant Type', 'required');
				$this->form_validation->set_rules('crop_start', 'Crop Start', 'required');
				$this->form_validation->set_rules('crop_end', 'Crop End', 'required');

                if ($this->form_validation->run() == FALSE)
                {
					// Page Meta
					$data['title'] = 'Edit Crop';

					// Data Fetch
					$data['user_info'] = $this->Dashboard_model->get_user_info();
					$data['crop_info'] = $this->Crop_model->cropInfo($cropID);

					// Page View
					$this->load->view('crop/edit_crop', $data);
                }
                else
                {
					$this->Crop_model->editCrop($cropID);
					redirect('/crop');
				}
				
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Crop - Delete Crop
		* Delete an existing crop. 
		* 
		* @url /crop/delete/<cropID>
		*
		* @param string $cropID - A string which is the unique crop identifier. 
		*/
		public function deleteCrop($cropID)
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Delete crop based on cropID
				$this->Crop_model->deleteCrop($cropID);

				// Redirect to original page
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Crop - Add Crop Journal Entry
		* Add a new crop journal entry to the database.
		* 
		* @url /crop/activity/new
		*/
		public function addCropActivityEntry()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Add record to database
				$this->Crop_model->addActivityEntry();

				// Redirect to dashboard
				redirect('/dashboard');
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Crop - Edit Crop Journal Entry
		* Edit a crop journal entry.
		* 
		* @url /crop/activity/edit/<id>
		*
		* @param integer $id - An integer which is the unique crop journal entry identifier.
		*/
		public function editCropActivityEntry($id)
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{

				if ($this->input->server('REQUEST_METHOD') != 'POST')
                {
					// Page Meta
					$data['title'] = 'Edit Activity';

					// Data Fetch
					$data['user_info'] = $this->Dashboard_model->get_user_info();
					$data['activity'] = $this->Crop_model->getCropActivityEntry($id);

					// Page View
					$this->load->view('crop/edit_crop_activity', $data);
                }
                else
                {
					// Update record in database
					$this->Crop_model->editActivityEntry($id);
					redirect('/dashboard');
				}
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Crop - Delete Crop Journal Entry
		* Delete a crop journal entry.
		* 
		* @url /crop/activity/delete/<id>
		*
		* @param integer $id - An integer which is the unique crop journal entry identifier.
		*/
		public function deleteCropActivityEntry($id)
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Add record to database
				$this->Crop_model->deleteActivityEntry($id);

				// Redirect to original page
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

}

