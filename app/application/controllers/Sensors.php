<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    ob_start();
	/**
	* FruxePi (frx-dev-v0.3)
	* Sensors Controller
	*/
	class Sensors extends CI_Controller 
	{
		// Constructor
		public function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('Dashboard_model');
			$this->load->model('Moisture_model');
			$this->load->model('Pump_model');
			$this->load->model('Lights_model');
			$this->load->model('Fan_model');
			$this->load->model('Climate_model');
			$this->load->model('Camera_model');
			$this->load->model('Scheduler_model');
		}

		/**
		* Sensors - Index
		* Main page for all sensor settings 
		* 
		* @url /technical
		*/
		public function index()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Technical';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();

				// Page View
				$this->load->view('technical/index', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Climate Settings
		* Set and modify the DHT22 temperature probe settings. 
		* 
		* Functions: 
		* - Enable\Disable DHT22 temperatur /humidity sensor
		* - Set/Modify the moisture GPIO pin
		* - Sensor dignostics 
		* 
		* @url /technical/climate
		*/
		public function climateSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Climate Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Climate_model->getGPIO();
				$data['activation_state'] = $this->Climate_model->climateActivationState();
				$data['temperature_format'] = $this->Climate_model->getTemperatureFormat();

				// Page View
				$this->load->view('technical/climate', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Climate GPIO
		public function editClimateGPIO()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Climate_model->setGPIO();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Set Temperature Format
		public function editTemperatureFormat()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Climate_model->setTemperatureFormat();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Climate Sensor
		public function enableClimateSensor()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Climate_model->enableClimateSensor();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Climate Sensor
		public function disableClimateSensor()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Climate_model->disableClimateSensor();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Climate Diagnostics
		public function climateDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Climate_model->climateDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Light Settings
		* Set and modify the light settings.
		* 
		* Functions: 
		* - Enable\Disable lights relay
		* - Set/Modify the relay GPIO pin
		* - Relay dignostics 
		* 
		* @url /technical/lights
		*/
		public function lightSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Light Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Lights_model->getGPIO();
				$data['relay_type'] = $this->Lights_model->getRelayType();
				$data['activation_state'] = $this->Lights_model->lightsActivationState();
				$data['lights_status'] = $this->Lights_model->getLightsStatus();
				$data['lights_ON'] = $this->Lights_model->getLightTimerON();
				$data['lights_OFF'] = $this->Lights_model->getLightTimerOFF();

				// Page View
				$this->load->view('technical/lights', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Lights Settings
		public function editLightsSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Lights_model->setGPIO();
				$this->Lights_model->setRelayType();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Lights
		public function enableLights()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Enable Lights
				$this->Lights_model->enableLights();

				// Edit CRON
                $this->Scheduler_model->enableCRON("lights");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Lights
		public function disableLights()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Disable Lights
				$this->Lights_model->disableLights();

				// Edit CRON
                $this->Scheduler_model->disableCRON("lights");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Lighting Schedule
		public function editLightSchedule()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Change lighting schedule in DB
				$lightsON = $this->Lights_model->setLightTimerON();
				$lightsOFF = $this->Lights_model->setLightTimerOFF();

				// Relay Type
				$relayType = $this->Lights_model->getRelayType();
				
				// Edit CRON
                $this->Scheduler_model->editLightsCRON($lightsON, $lightsOFF, $relayType);
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Light Diagnostics
		public function lightsDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Lights_model->lightsDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Lights ON
		public function lightsON()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Lights_model->lightsON();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Lights OFF
		public function lightsOFF()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Lights_model->lightsOFF();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Fan Settings
		* Set and modify the fan settings.
		* 
		* Functions: 
		* - Enable\Disable fan relay
		* - Set/Modify the relay GPIO pin
		* - Relay dignostics 
		* 
		* @url /technical/fans
		*/
		public function fanSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Fan Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Fan_model->getGPIO();
				$data['relay_type'] = $this->Fan_model->getRelayType();
				$data['activation_state'] = $this->Fan_model->fanActivationState();
				$data['fan_schedule'] = $this->Fan_model->getFanSchedule();
				$data['fan_status'] = $this->Fan_model->getFanStatus();
				$data['temperature_format'] = $this->Climate_model->getTemperatureFormat();

				// Page View
				$this->load->view('technical/fans', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Fan Settings
		public function editFanSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->setGPIO();
				$this->Fan_model->setRelayType();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Fan Schedule
		public function editFanSchedule()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$fan_duration = $this->Fan_model->setFanSchedule();

				// Relay Type
				$relayType = $this->Fan_model->getRelayType();

				// Edit CRON
                $this->Scheduler_model->editFanCRON($fan_duration, $relayType);
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Fans
		public function enableFan()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Enable Fans
				$this->Fan_model->enableFans();

				// Enable CRON
                $this->Scheduler_model->enableCRON("fan");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Fans
		public function disableFan()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Disable fans
				$this->Fan_model->disableFans();

				// Disable CRON
                $this->Scheduler_model->disableCRON("fan");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Fan Diagnostics
		public function fanDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Fan_model->fanDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Fan ON
		public function fanON()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->fanON();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Fan OFF
		public function fanOFF()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->fanOFF();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Camera Settings
		* Set and modify the camera settings.
		* 
		* Functions: 
		* - Enable\Disable camera module
		* - Set photo capture interval
		* - Take photo
		* - Camera dignostics 
		* 
		* @url /technical/camera
		*/
		public function cameraSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Camera Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['activation_state'] = $this->Camera_model->cameraActivationState();

				// Page View
				$this->load->view('technical/camera', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Camera
		public function enableCamera()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Enablle Camera
				$this->Camera_model->enableCamera();

				// Enable CRON
                $this->Scheduler_model->enableCRON("camera");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Camera
		public function disableCamera()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Disable Camera
				$this->Camera_model->disableCamera();

				// Disable CRON
				$this->Scheduler_model->disableCRON("camera");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Capture photo
		public function capturePhoto()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$filename = $this->Camera_model->takePhoto();

				echo $filename;
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Camera Diagnostics
		public function cameraDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Camera_model->cameraDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Pump Settings
		* Set and modify the water pump settings.
		* 
		* Functions: 
		* - Enable\Disable water pump relay
		* - Set/Modify the water pump relay GPIO pin
		* - Relay dignostics 
		* 
		* @url /technical/pump
		*/
		public function pumpSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Pump Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Pump_model->getGPIO();
				$data['relay_type'] = $this->Pump_model->getRelayType();
				$data['activation_state'] = $this->Pump_model->pumpActivationState();
				$data['pump_schedule'] = $this->Pump_model->getPumpSchedule();
				$data['pump_status'] = $this->Pump_model->getPumpStatus();

				// Page View
				$this->load->view('technical/pump', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Moisture Settings
		public function editPumpSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Pump_model->setGPIO();
				$this->Pump_model->setRelayType();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Pump Schedule
		public function editPumpSchedule()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Pump_model->setPumpSchedule();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Pump
		public function enablePump()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Enable Pump
				$this->Pump_model->enablePump();

				// Edit CRON
                $this->Scheduler_model->enableCRON("pump");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Pump
		public function disablePump()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Disable Pump
				$this->Pump_model->disablePump();

				// Edit CRON
                $this->Scheduler_model->disableCRON("pump");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Pump Diagnostics
		public function pumpDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Pump_model->pumpDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Pump ON
		public function pumpON()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Pump_model->pumpON();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Pump OFF
		public function pumpOFF()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Pump_model->pumpOFF();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Moisture Probe Settings
		* Set and modify the moisture probe settings.
		* 
		* Functions: 
		* - Enable\Disable moisture probe
		* - Set/Modify the moisture probe GPIO pin
		* - Moisture probe dignostics 
		* 
		* @url /technical/moisture
		*/
		public function moistureSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Moisture Probe Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Moisture_model->getGPIO();
				$data['activation_state'] = $this->Moisture_model->moistureActivationState();

				// Page View
				$this->load->view('technical/moisture', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Moisture GPIO
		public function editMoistureGPIO()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Moisture_model->setGPIO();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Moisture Sensor
		public function enableMoistureSensor()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Moisture_model->enableMoistureSensor();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Moisture Sensor
		public function disableMoistureSensor()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Moisture_model->disableMoistureSensor();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Moisture Probe Diagnostics
		public function moistureDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Moisture_model->moistureDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		/**
		* Heater Settings
		* Set and modify the heater settings.
		* 
		* Functions: 
		* - Enable\Disable heater relay
		* - Set/Modify the heater GPIO pin
		* - Relay dignostics 
		* 
		* @url /technical/heater
		*/
		public function heaterSettings()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Page Meta
				$data['title'] = 'Heater Settings';

				// Data Fetch
				$data['user_info'] = $this->Dashboard_model->get_user_info();
				$data['GPIO'] = $this->Fan_model->getGPIO();
				$data['activation_state'] = $this->Fan_model->fanActivationState();
				$data['fan_schedule'] = $this->Fan_model->getFanSchedule();
				$data['fan_status'] = $this->Fan_model->getFanStatus();
				$data['temperature_format'] = $this->Climate_model->getTemperatureFormat();

				// Page View
				$this->load->view('technical/heater', $data);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Heater GPIO
		public function editHeaterGPIO()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->setGPIO();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Edit Heater Schedule
		public function editHeaterSchedule()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->setFanSchedule();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Enable Heater
		public function enableHeater()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Enable Fans
				$this->Fan_model->enableFans();

				// Enable CRON
                $this->Scheduler_model->enableCRON("fan");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Disable Heater
		public function disableHeater()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				// Disable fans
				$this->Fan_model->disableFans();

				// Disable CRON
                $this->Scheduler_model->disableCRON("fan");
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Heater Diagnostics
		public function heaterDiagnostics()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$diagnostic_callback = $this->Fan_model->fanDiagnostics();
				print_r($diagnostic_callback); 
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Heater ON
		public function heaterON()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->fanON();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

		// Heater OFF
		public function heaterOFF()
		{
			// Redirect if user not logged in, otherwise display the page.
			if ($this->ion_auth->logged_in())
			{
				$this->Fan_model->fanOFF();
		
				redirect($_SERVER['HTTP_REFERER']);
			
			} else {
				// Redirect to login.
				redirect('/login');
			}
		}

}

