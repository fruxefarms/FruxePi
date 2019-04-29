<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Pump Model
	*/
	class Pump_model extends CI_Model
	{
		// Fields
		private $sensorID = 5;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		 * Turn Pump ON
		 * Turn the water pump ON.
		 * @return void
		 */
		public function pumpON()
		{
			// GPIO pin
			$gpioPIN = $this->Pump_model->getGPIO();

			// Relay Type
			$relayType = $this->Pump_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py pump -ON " . $gpioPIN . " " . $relayType;

			// Execute command
			exec($command_string);
		}


		/**
		 * Turn Pump OFF
		 * Turn the water pump OFF.
		 * @return void
		 */
		public function pumpOFF()
		{
			// GPIO pin
			$gpioPIN = $this->Pump_model->getGPIO();

			// Relay Type
			$relayType = $this->Pump_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py pump -OFF " . $gpioPIN . " " . $relayType;

			// Execute command
			exec($command_string);
		}


		/**
		* Set Pump GPIO Pin
		* Set the GPIO Pin associated with the water pump relay.
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
		* Get Pump GPIO Pin
		* Return the GPIO Pin associated with the water pump relay.
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
		 * Enable Pump
		 * Enable the water pump module. 
		 * @return void
		 */
		public function enablePump()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Pump
		 * Disable the water pump module. 
		 * @return void
		 */
		public function disablePump()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}

		/**
		* Get Pump Activation State
		* Get the activation state of the pump.  
		* @return boolean
		*/
		public function pumpActivationState()
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
		 * Set Pump Schedule
		 * Set the schedule for the pump to run.
		 * @return void
		 */
		public function setPumpSchedule()
		{
			// Data
			$pumpON = $this->input->post('pump_ON'); 
			$pumpDuration = $this->input->post('pump_duration');
			$relayType = $this->Pump_model->getRelayType();

			$data = array(
				"pump_ON" => $pumpON,
				"pump_duration" => $pumpDuration
			);

			$this->db->where("process_id", "pump");
			$this->db->update("pump_schedule", $data);

			$this->Scheduler_model->editPumpCRON($pumpON, $pumpDuration, $relayType);
		}

		/**
		 * Get Pump Schedule
		 * Get the schedule for the pump to run.
		 * @return array
		 */
		public function getPumpSchedule()
		{
			$this->db->select("*");
			$this->db->from("pump_schedule");
			$this->db->where("process_id", "pump");

			$query = $this->db->get();
			return $query->result();
		}

		/**
		* Set Relay type
		* Set the relay type - active high ("high") or active low ("").
		* @return void
		*/
		public function setRelayType()
		{
			// Set relay type value and update database
			$data = array(
				"type" => $this->input->post('relayType') 
			);

			$this->db->where('technical_id', $this->sensorID);
			return $this->db->update('relay_settings', $data);
		}

		/**
		* Get Pump Relay Type
		* @return String
		*/
		public function getRelayType()
		{
			$this->db->select("type");
			$this->db->from("relay_settings");
			$this->db->where('technical_id', $this->sensorID);

			$query = $this->db->get();
			$result = $query->result();

			return $result[0]->type;
		}


		/**
		 * Get Pump Status
		 * Return a boolean if the water pump is running (True) or not running (False).
		 * @return boolean
		 */
		public function getPumpStatus()
		{
			// GPIO pin
			$gpioPIN = $this->Pump_model->getGPIO();

			// Relay Type
			$relayType = $this->Pump_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py pump -s " . $gpioPIN . " " . $relayType;
			
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
		 * Pump Diagnostics
		 * A diagnostics function to determine the water pump's health and operability.
		 * @return string
		 */
		public function pumpDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Pump_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py pump -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

	}

