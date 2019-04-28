<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Climate Model
	*/
	class Climate_model extends CI_Model
	{
		// Fields
		private $sensorID = 1;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		 * Get Temperature
		 * Get the latest temperature reading from the database as an unformatted float.
		 * @return float
		 */
		public function getTemperature()
		{
			$this->db->select("temperature");
			$this->db->from("grow_data");
			$this->db->order_by("id","DESC");
			$this->db->limit(1);

			$query = $this->db->get();
			$temperature = $query->result()[0]->temperature;

			return $temperature;
		}


		/**
		 * Get Humidity
		 * Get the latest humidity reading from the database as an unformatted float.
		 * @return float
		 */
		public function getHumidity()
		{
			$this->db->select("humidity");
			$this->db->from("grow_data");
			$this->db->order_by("id","DESC");
			$this->db->limit(1);

			$query = $this->db->get();
			$humidity = $query->result()[0]->humidity;

			return $humidity;
		}

		/**
		* Set Climate Sensor GPIO Pin
		* Set the GPIO Pin associated with the climate sensor.
		* @return void
		*/
		public function setGPIO()
		{
			// Set GPIO pin value and update database
			$data = array(
				"gpio_pin" => $this->input->post('GPIO') 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		* Get Climate Sensor GPIO Pin
		* Return the GPIO Pin associated with the climate sensor.
		* @return int
		*/
		public function getGPIO()
		{
			$this->db->select("gpio_pin");
			$this->db->from("technical");
			$this->db->where('id', $this->sensorID);

			$query = $this->db->get();
			$result = $query->result();

			return $result[0]->gpio_pin;
		}


		/**
		 * Enable Climate Sensor
		 * Enable the climate sensor module.
		 * @return void
		 */
		public function enableClimateSensor()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Climate Sensor
		 * Disable the climate sensor module.
		 * @return void
		 */
		public function disableClimateSensor()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			
			return $this->db->update('technical', $data);
		}

		/**
		* Get Climate Sensor Activation State
		* Get the activation state of the moisture probe.  
		* @return boolean
		*/
		public function climateActivationState()
		{
			$this->db->select("enabled");
			$this->db->from("technical");
			$this->db->where('id', $this->sensorID);

			$query = $this->db->get();
			$result = $query->result();
			$activationState = $result[0]->enabled;

			// Return True or False 
			return $activationState;
		}


		/**
		 * Read Climate Sensor
		 * Return the immediate temperature and humidity from the climate sensor.
		 * @return int
		 */
		public function readClimateSensor()
		{
			// Command string
			$command_string = "";

			// Execute command
			exec($command_string, $climate_callback);

			return $climate_callback;
		}

		/**
		* Get Climate Threshold
		* Get climate threshold temperature and humidity
		* @return array
		*/
		public function getClimateThreshold()
		{
			$this->db->select("*");
			$this->db->from("climate_threshold");
			$this->db->where('id', 1);

			$query = $this->db->get();
			$result = $query->result_array();

			return $result[0];
		}

		/**
		* Set Climate Threshold
		* set climate threshold temperature and humidity
		* @return void
		*/
		public function setClimateThreshold()
		{
			$tempFormat = $this->Climate_model->getTemperatureFormat();

			if ($tempFormat == "F") {
				$data = array(
					"temp_MIN" => fahrenheitToCelsius($this->input->post('temperatureLOW')),
					"temp_MAX" => fahrenheitToCelsius($this->input->post('temperatureHIGH')),
					"humid_MIN" => $this->input->post('humidityLOW'),
					"humid_MAX" => $this->input->post('humidityHIGH')
				);
			} else {
				$data = array(
					"temp_MIN" => $this->input->post('temperatureLOW'),
					"temp_MAX" => $this->input->post('temperatureHIGH'),
					"humid_MIN" => $this->input->post('humidityLOW'),
					"humid_MAX" => $this->input->post('humidityHIGH')
				);
			}

			$this->db->where('id', 1);
			return $this->db->update('climate_threshold', $data);
		}

		
		/**
		 * Climate Sensor Diagnostics
		 * A diagnostics function to determine the climate sensor's operability.
		 * @return boolean
		 */
		public function climateDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Climate_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py climate -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

		/**
		* Get Climate Temperature Format
		* Return the desired temperature format.
		* @return string
		*/
		public function getTemperatureFormat()
		{
			$this->db->select("format");
			$this->db->from("climate_settings");
			$this->db->where('id', $this->sensorID);

			$query = $this->db->get();
			$result = $query->result();

			return $result[0]->format;
		}


		/**
		* Set Temperature Format
		* Set the desired temperature format (Celsius or Fahrenheit).
		* @return void
		*/
		public function setTemperatureFormat()
		{
			// Set format value and update database
			$data = array(
				"format" => $this->input->post('tempFormat') 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('climate_settings', $data);
		}

	}

