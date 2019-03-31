<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.2)
	* Fan Model
	*/
	class Fan_model extends CI_Model
	{
		// Fields
		private $sensorID = 4;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		 * Turn Fan ON
		 * Turn the fan funcion on.
		 * @return void
		 */
		public function fanON()
		{
			// GPIO pin
			$gpioPIN = $this->Fan_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py fan -ON " . $gpioPIN;

			// Execute command
			exec($command_string);
		}


		/**
		 * Turn Fan OFF
		 * Turn the fan funcion off.
		 * @return void
		 */
		public function fanOFF()
		{
			// GPIO pin
			$gpioPIN = $this->Fan_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py fan -OFF " . $gpioPIN;

			// Execute command
			exec($command_string);
		}


		/**
		* Set Fan GPIO Pin
		* Set the GPIO Pin associated with the fan.
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
		* Get Fan GPIO Pin
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
		* Set Fan Schedule
		* Set the fan schedule
		* @return void
		*/
		public function setFanSchedule()
		{
			// Set fan program values and update database
			$data = array(
				"fan_temp_threshold" => $this->input->post('fan_temp_threshold'),
				"fan_humid_threshold" => $this->input->post('fan_humid_threshold'),
				"fan_duration" => $this->input->post('fan_duration') 
			);

			$this->db->where("process_id", "fan");
			return $this->db->update("fan_schedule", $data);
		}

		/**
		* Get Fan Schedule
		* Set the fan schedule
		* @return void
		*/
		public function getFanSchedule()
		{
			$this->db->select("*");
			$this->db->from("fan_schedule");
			$this->db->where('process_id', "fan");

			$query = $this->db->get();
			return $query->result();
		}

		/**
		* Get Fan Activation State
		* Get the activation state of the moisture probe.  
		* @return boolean
		*/
		public function fanActivationState()
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
		 * Enable Fan
		 * Enable the fan module. 
		 * @return void
		 */
		public function enableFans()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Fan
		 * Diable the fan module.
		 * @return void
		 */
		public function disableFans()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Get Fan Status
		 * Return a boolean if the fan is running (True) or not running (False).
		 * @return boolean
		 */
		public function getFanStatus()
		{
			// GPIO pin
			$gpioPIN = $this->Fan_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py fan -s " . $gpioPIN;
			
			// Execute command
			exec($command_string, $command_callback);
			
			// Return True or False based on $command_callback value
			if (!empty($command_callback)){
				if ($command_callback[0] == "1") {
					return 1;
				}
			}
		
			return 0;
		}

		
		/**
		 * Fan Diagnostics
		 * A diagnostics function to determine the fan's health and operability.
		 * @return string
		 */
		public function fanDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Fan_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py fan -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

	}

