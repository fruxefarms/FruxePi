<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Moisture Model
	*/
	class Moisture_model extends CI_Model
	{
		// Fields
		private $sensorID = 2;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}

		
		/**
		* Get Latest Soil Moisture Reading
		* Return the latest soil moisture status update from the database. 
		* @return void
		*/
		public function getSoilMoisture()
		{
			$this->db->select("moisture_status");
			$this->db->from("grow_data");
			$this->db->order_by("id","DESC");
			$this->db->limit(1);

			$query = $this->db->get();
			return $query->result();
		}


		/**
		* Set Soil Moisture Probe GPIO Pin
		* Set the GPIO Pin associated with the soil moisture probe.
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
		* Get Soil Moisture Probe GPIO Pin
		* Return the GPIO Pin associated with the soil moisture probe.
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
		* Enable Moisture Sensor
		* Enable the moisture sensor module.
		* @return void
		*/
		public function enableMoistureSensor()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		* Disable Moisture Sensor
		* Disable the moisture sensor module. 
		* @return void
		*/
		public function disableMoistureSensor()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}

		/**
		* Get Moisture Probe Activation State
		* Get the activation state of the moisture probe.  
		* @return boolean
		*/
		public function moistureActivationState()
		{
			$this->db->select("enabled");
			$this->db->from("technical");
			$this->db->where('id', $this->sensorID);

			$query = $this->db->get();
			$result = $query->result();
			$activationState = $result[0]->enabled;

			// Return True or False based on $moisture_callback value
			return $activationState;
		}


		/**
		* Read Moisture Sensor
		* Return an immediate reading from the soil moisture probe.
		* @return int
		*/
		public function readMoistureSensor()
		{
			// GPIO pin
			$gpioPIN = $this->Moisture_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py moisture -mr " . $gpioPIN;

			// Execute command
			exec($command_string, $moisture_callback);

			return $moisture_callback[0];

		}


		/**
		* Moisture Probe Diagnostics
		* A diagnostics function to determine the moisture probe's operability.
		* @return string 
		*/
		public function moistureDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Moisture_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py moisture -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

	}

