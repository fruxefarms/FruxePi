<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Heater Model
	*/
	class Heater_model extends CI_Model
	{
		// Fields
		private $sensorID = 6;

		// Constructor
		public function __construct()
		{
			$this->load->database();
			$this->load->helper(array('form', 'url', 'utility'));
			$this->load->model('Climate_model');
        	$this->load->library('ion_auth');
		}


		/**
		 * Turn Heater ON
		 * Turn the heater function on.
		 * @return void
		 */
		public function heaterON()
		{
			// GPIO pin
			$gpioPIN = $this->Heater_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py heater -ON " . $gpioPIN;

			// Execute command
			exec($command_string);
		}


		/**
		 * Turn Heater OFF
		 * Turn the heater function off.
		 * @return void
		 */
		public function heaterOFF()
		{
			// GPIO pin
			$gpioPIN = $this->Heater_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py heater -OFF " . $gpioPIN;

			// Execute command
			exec($command_string);
		}


		/**
		* Set Heater GPIO Pin
		* Set the GPIO Pin associated with the heater.
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
		* Get Heater GPIO Pin
		* Return the GPIO Pin associated with the heater relay.
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
		* Get Fan Activation State
		* Get the activation state of the heater relay.  
		* @return boolean
		*/
		public function heaterActivationState()
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
		 * Enable Heater
		 * Enable the heater module. 
		 * @return void
		 */
		public function enableHeater()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Heater
		 * Diable the heater module.
		 * @return void
		 */
		public function disableHeater()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Get Heater Status
		 * Return a boolean if the heater is running (True) or not running (False).
		 * @return boolean
		 */
		public function getHeaterStatus()
		{
			// GPIO pin
			$gpioPIN = $this->Heater_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py heater -s " . $gpioPIN;
			
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
		 * Heater Diagnostics
		 * A diagnostics function to determine the heater's health and operability.
		 * @return string
		 */
		public function heaterDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Heater_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py heater -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

	}

