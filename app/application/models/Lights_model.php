<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Lights Model
	*/
	class Lights_model extends CI_Model
	{
		// Fields
		private $sensorID = 3;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		 * Turn Lights ON
		 * Turn the lights function on.
		 * @return void
		 */
		public function lightsON()
		{
			// GPIO pin
			$gpioPIN = $this->Lights_model->getGPIO();

			// Relay Type
			$relayType = $this->Lights_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py lights -ON " . $gpioPIN . " " . $relayType;

			// Execute command
			exec($command_string);
		}


		/**
		 * Turn Lights OFF
		 * Turn the lights function off.
		 * @return void
		 */
		public function lightsOFF()
		{
			// GPIO pin
			$gpioPIN = $this->Lights_model->getGPIO();

			// Relay Type
			$relayType = $this->Lights_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py lights -OFF " . $gpioPIN . " " . $relayType;

			// Execute command
			exec($command_string);
		}


		/**
		* Set Lights GPIO Pin
		* Set the GPIO Pin associated with the lights relay.
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
		* Get Lights GPIO Pin
		* Return the GPIO Pin associated with the lights relay.
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
		* Get Lights Activation State
		* Get the activation state of the lights.  
		* @return boolean
		*/
		public function lightsActivationState()
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
		 * Enable Lights
		 * Enable the light module. 
		 * @return void
		 */
		public function enableLights()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Lights
		 * Disable the light module.
		 * @return void
		 */
		public function disableLights()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
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
		* Get Lights Relay Type
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
		 * Get Light Status
		 * Return a boolean if the lights are ON (True) or OFF (False).
		 * @return boolean
		 */
		public function getLightsStatus()
		{
			// GPIO pin
			$gpioPIN = $this->Lights_model->getGPIO();
			
			// Relay Type
			$relayType = $this->Lights_model->getRelayType();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py lights -s " . $gpioPIN . " " . $relayType;
			
			// Execute command
			exec($command_string, $command_callback);
			
			// Return True or False based on $command_callback value
			if (!empty($command_callback)){
				if ($command_callback[0] == 1) {
					return 1;
				}
			}
		
			return 0;
		}


		/**
		 * Set Light Timer ON
		 * Set the ON light timer as HH:MM in 24-hour format.
		 * @return void
		 */
		public function setLightTimerON()
		{
			// Set time for Timer ON
			$data = array(
				"lights_ON" => $this->input->post('lightsON')  
			);

			$this->db->where("process_id", "lights");
			$this->db->update("light_schedule", $data);

			return $this->input->post('lightsON');
		}


		/**
		 * Set Light Timer OFF
		 * Set the OFF light timer as HH:MM in 24-hour format.
		 * @return void
		 */
		public function setLightTimerOFF()
		{
			// Set time for Timer ON
			$data = array(
				"lights_OFF" => $this->input->post('lightsOFF') 
			);

			$this->db->where("process_id", "lights");
			$this->db->update("light_schedule", $data);

			return $this->input->post('lightsOFF');
		}


		/**
		 * Get Light Timer ON
		 * Return the time when the lights will turn ON as HH:MM in 24-hour format.
		 * @return Date
		 */
		public function getLightTimerON()
		{
			$this->db->select("lights_ON");
			$this->db->from("light_schedule");
			$this->db->where('process_id', "lights");

			$query = $this->db->get();
			$result = $query->result();
			return $result[0]->lights_ON;
		}


		/**
		 * Get Light Timer OFF
		 * Return the time when the lights will turn OFF as HH:MM in 24-hour format.
		 * @return Date
		 */
		public function getLightTimerOFF()
		{
			$this->db->select("lights_OFF");
			$this->db->from("light_schedule");
			$this->db->where('process_id', "lights");

			$query = $this->db->get();
			$result = $query->result();
			return $result[0]->lights_OFF;
		}

		
		/**
		 * Light Diagnostics
		 * A diagnostics function to determine the light's health and operability.
		 * @return boolean
		 */
		public function lightsDiagnostics()
		{
			// GPIO pin
			$gpioPIN = $this->Lights_model->getGPIO();

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py lights -d " . $gpioPIN;
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

		// Get Light Status
		public function getLightStatusMessage()
		{
		  
		  $data = array();
		  $timeNow = new DateTime();
		  $lightsON = new DateTime($this->Lights_model->getLightTimerON());
		  $lightsOFF = new DateTime($this->Lights_model->getLightTimerOFF());
		  $lightHours = $lightsON->diff($lightsOFF)->format("%h");

		  $light_status = $this->Lights_model->getLightsStatus();
	
		  if ($light_status == 1)
			{
			$interval = $lightsOFF->diff($timeNow);
			$data['lights'] = 'ON';
			$data['lightHours'] = $lightHours;
	
			if ($interval->format("%h") == "0"){
			  $data['status'] = $interval->format("%i minutes until lights off.");
			} else {
			  $data['status'] = $interval->format("%h hours, %i minutes until lights off.");
			}
	
		  } else {
			$interval = $lightsON->diff($timeNow);
			$data['lights'] = 'OFF';
			$data['lightHours'] = 24 - $lightHours;
			if ($interval->format("%h") == "0"){
			  $data['status'] = $interval->format("%i minutes until lights on.");
			} else {
			  $data['status'] = $interval->format("%h hours, %i minutes until lights on.");
			}
		  }
	
		  return $data;
	
		}



	}

