<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Camera Model
	*/
	class Camera_model extends CI_Model
	{	
		// Fields
		private $sensorID = 7;

		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		 * Enable Camera
		 * Enables the camera module. 
		 * @return void
		 */
		public function enableCamera()
		{
			// Set enabled field to TRUE and update database
			$data = array(
				"enabled" => TRUE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);
		}


		/**
		 * Disable Camera
		 * Disables the camera module.
		 * @return void
		 */
		public function disableCamera()
		{
			// Set enabled field to FALSE and update database
			$data = array(
				"enabled" => FALSE 
			);

			$this->db->where('id', $this->sensorID);
			return $this->db->update('technical', $data);

		}


		/**
		 * Take Photo
		 * Capture photo and save to photos.
		 * @return void
		 */
		public function takePhoto()
		{
			// String to execute photo capture command
			$photo_command = "sudo /var/www/html/actions/fruxepi.py camera -capture";
			
			// Run capture photo command
			$filename = shell_exec($photo_command);

			return $filename;
			
		}

		/**
		* Get Camera Activation State
		* Get the activation state of the camera.  
		* @return boolean
		*/
		public function cameraActivationState()
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
		 * Camera Diagnostics
		 * A diagnostics function to determine the Camera module's operability.
		 * @return boolean
		 */
		public function cameraDiagnostics()
		{

			// Command string
			$command_string = "sudo /var/www/html/actions/fruxepi.py camera -d ";
			
			// Execute command
			$command_callback = shell_exec($command_string);

			return $command_callback;
		}

	}

