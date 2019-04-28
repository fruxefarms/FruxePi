<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
    ob_start();
	/**
	* FruxePi (frx-dev-v0.3)
	* Dashboard Controller
	*/
	class Dashboard extends CI_Controller 
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
			$this->load->model('Scheduler_model');
			$this->load->helper('utility');
		}

		/**
		* Dashboard - Index
		* The main page of the FruxePi app. From here, all things are possible! 
		* 
		* @url /dashboard
		*/
		public function index()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Page Meta
				$data['title'] = 'Dashboard';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['grow_data'] = $this->Dashboard_model->get_latest_grow_data();
				$data['crops'] = $this->Crop_model->getAllCropsInfo();
				$data['crop_activity'] = $this->Crop_model->get_cropActivity();

				$data['temperature_chart'] = $this->Dashboard_model->get_temperature_chart_data();
				$data['temperature_format'] = $this->Climate_model->getTemperatureFormat();
				$data['humidity_chart'] = $this->Dashboard_model->get_humidity_chart_data();
				$data['chart_legend'] = $this->Dashboard_model->get_chart_legend();
				
				$data['pump_schedule'] = $this->Pump_model->getPumpSchedule();
				$data['fan_schedule'] = $this->Fan_model->getFanSchedule();
				$data['fan_status'] = $this->Fan_model->getFanStatus();
				$data['lights_ON'] = $this->Lights_model->getLightTimerON();
				$data['lights_OFF'] = $this->Lights_model->getLightTimerOFF();
				$data['lights_status'] = $this->Lights_model->getLightsStatus();
				$data['climate_threshold'] = $this->Climate_model->getClimateThreshold();

				$data['sensor_state'] = $this->Dashboard_model->get_sensor_activation_state();
				$data['cropThresholds'] = $this->Dashboard_model->get_cropThresholds();
				$data['cropConditions'] = $this->Dashboard_model->get_cropConditions();
				$data['soil_status'] = $this->Moisture_model->readMoistureSensor();

				// Page View
				$this->load->view('dashboard/index', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		public function editGrowRoomSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
	    	{
				// Set climate threshold
				$this->Climate_model->setClimateThreshold();
				
				// Change lighting schedule in DB
				$lightsON = $this->Lights_model->setLightTimerON();
				$lightsOFF = $this->Lights_model->setLightTimerOFF();
				
				// Edit lighting CRON
                $this->Scheduler_model->editLightsCRON($lightsON, $lightsOFF);

				// Set Fan schedule
				$this->Fan_model->setFanSchedule();

				// Set Pump schedule
				$this->Pump_model->setPumpSchedule();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Capture current photo
		public function latestPhoto()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$filename = $this->Camera_model->takePhoto();

				redirect(asset_url() . "tmp/". $filename);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Reset Admin Default
		public function reset()
		{
			// Page View
			$this->load->view('auth/reset');
			
		}

	}
?>
