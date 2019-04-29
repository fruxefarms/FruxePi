<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Scheduler Model
	*/
	class Scheduler_model extends CI_Model
	{	
		
		// Constructor
		public function __construct()
		{
			$this->load->database();
			$this->load->helper(array('form', 'url', 'file'));
			$this->load->model('Pump_model');
			$this->load->model('Lights_model');
			$this->load->model('Fan_model');
        	$this->load->library('ion_auth');
		}


		/**
		 * Edit Lights Cronjob
		 * Edit the lighting schedule 
		 * @return void
		 */
		public function editLightsCRON($lightsON, $lightsOFF, $relayType)
		{
			// GPIO pin
			$gpioPIN = $this->Lights_model->getGPIO();

			// Light ON / OFF
			$lightsONArray = explode(":", $lightsON);
			$lightsOFFArray = explode(":", $lightsOFF);

			$hourON = $lightsONArray[0];
			$minuteON = $lightsONArray[1];

			$hourOFF = $lightsOFFArray[0];
			$minuteOFF = $lightsOFFArray[1];

			// Get Existing CRON
			exec('crontab -l', $output);

			// Loop through CRON file and find lights rows
			for($i = 0; $i < count($output); $i++) {
				$cronStringArray = explode(" ", $output[$i]);
				
				if (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == "lights" && $cronStringArray[8] == "-ON") {
					$cronStringArray[0] = $minuteON;
					$cronStringArray[1] = $hourON;
					$cronStringArray[9] = $gpioPIN;
					$relayType == "high" && !array_key_exists(10, $cronStringArray) ? array_push($cronStringArray, "True") : false ;
					$relayType == "" && array_key_exists(10, $cronStringArray) ? $cronStringArray[10] = "" : false ;

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				} elseif (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == "lights" && $cronStringArray[8] == "-OFF") {
					$cronStringArray[0] = $minuteOFF;
					$cronStringArray[1] = $hourOFF;
					$cronStringArray[9] = $gpioPIN;
					$relayType == "high" && !array_key_exists(10, $cronStringArray) ? array_push($cronStringArray, "True") : false ;
					$relayType == "" && array_key_exists(10, $cronStringArray) ? $cronStringArray[10] = "" : false ;

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				}
				
			}

			// Update CRON File
			
			// Clear File
			file_put_contents('/var/www/html/assets/tmp/crontab.txt', "");
			
			// Update temporary text file contents
			foreach($output as $row) {
				file_put_contents('/var/www/html/assets/tmp/crontab.txt', $row . PHP_EOL, FILE_APPEND);
			}

			// Save crontab to file
			echo exec('crontab /var/www/html/assets/tmp/crontab.txt');
			
		}

		/**
		 * Disable Sensor Cronjob
		 * Disable a cron job for the designated sensor or relay function. 
		 * @return void
		 */
		public function disableCRON($function)
		{
			// Get Existing CRON
			exec('crontab -l', $output);

			// Loop through CRON file rows
			for($i = 0; $i < count($output); $i++) {
				$cronStringArray = explode(" ", $output[$i]);
				
				if (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == $function) {
					$minuteValue = str_ireplace("#", "", $cronStringArray[0]);
					$cronStringArray[0] = "#" . $minuteValue;

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				} 
				
			}

			// Update CRON File
			
			// Clear File
			file_put_contents('/var/www/html/assets/tmp/crontab.txt', "");
			
			// Update temporary text file contents
			foreach($output as $row) {
				file_put_contents('/var/www/html/assets/tmp/crontab.txt', $row . PHP_EOL, FILE_APPEND);
			}

			// Save crontab to file
			echo exec('crontab /var/www/html/assets/tmp/crontab.txt');
			
		}

		/**
		 * Enable Sensor Cronjob
		 * Disable a cron job for the designated sensor or relay function. 
		 * @return void
		 */
		public function enableCRON($function)
		{
			// Get Existing CRON
			exec('crontab -l', $output);

			// Loop through CRON file rows
			for($i = 0; $i < count($output); $i++) {
				$cronStringArray = explode(" ", $output[$i]);
				
				if (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == $function) {
					$minuteValue = $cronStringArray[0];
					$cronStringArray[0] = str_ireplace("#", "", $minuteValue);

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				} 
				
			}

			// Update CRON File
			
			// Clear File
			file_put_contents('/var/www/html/assets/tmp/crontab.txt', "");
			
			// Update temporary text file contents
			foreach($output as $row) {
				file_put_contents('/var/www/html/assets/tmp/crontab.txt', $row . PHP_EOL, FILE_APPEND);
			}

			// Save crontab to file
			echo exec('crontab /var/www/html/assets/tmp/crontab.txt');
			
		}


		/**
		 * Edit Pump Cronjob
		 * Edit the pump schedule 
		 * @return void
		 */
		public function editPumpCRON($pumpON, $pumpDuration, $relayType)
		{
			$pumpGPIO = $this->Pump_model->getGPIO();
			$pumpONArray = explode(":", $pumpON);

			$hourON = $pumpONArray[0];
			$minuteON = $pumpONArray[1];

			exec('crontab -l', $output);

			for($i = 0; $i < count($output); $i++) {
				$cronStringArray = explode(" ", $output[$i]);
				
				if (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == "pump" && $cronStringArray[8] == "-RUN") {
					$cronStringArray[0] = $minuteON;
					$cronStringArray[1] = $hourON;
					$cronStringArray[9] = $pumpGPIO;
					$cronStringArray[10] = (int)$pumpDuration * 60;
					$relayType == "high" && !array_key_exists(11, $cronStringArray) ? array_push($cronStringArray, "True") : false ;
					$relayType == "" && array_key_exists(11, $cronStringArray) ? $cronStringArray[10] = "" : false ;

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				}
			}

			// Update CRON File
			
			// Clear File
			file_put_contents('/var/www/html/assets/tmp/crontab.txt', "");
			
			// Update temporary text file contents
			foreach($output as $row) {
				file_put_contents('/var/www/html/assets/tmp/crontab.txt', $row . PHP_EOL, FILE_APPEND);
			}

			// Save crontab to file
			echo exec('crontab /var/www/html/assets/tmp/crontab.txt');
			
		}

		/**
		 * Edit Fan Cronjob
		 * Edit the fan program and schedule 
		 * @return void
		 */
		public function editFanCRON($fanDuration, $relayType)
		{
			$fanGPIO = $this->Fan_model->getGPIO();

			$minuteON = $fanDuration;

			exec('crontab -l', $output);

			for($i = 0; $i < count($output); $i++) {
				$cronStringArray = explode(" ", $output[$i]);
				
				if (array_key_exists(7, $cronStringArray) == True && $cronStringArray[7] == "fan" && $cronStringArray[8] == "-RUN") {
					$cronStringArray[0] = "*/" . $minuteON;
					$cronStringArray[1] = "*";
					$cronStringArray[9] = $fanGPIO;
					$cronStringArray[10] = (int)$fanDuration * 60;
					$relayType == "high" && !array_key_exists(11, $cronStringArray) ? array_push($cronStringArray, "True") : false ;
					$relayType == "" && array_key_exists(11, $cronStringArray) ? $cronStringArray[11] = "" : false ;				

					$cronString = implode(" ", $cronStringArray);
					$output[$i] = $cronString;
				}
			}

			// Update CRON File
			
			// Clear File
			file_put_contents('/var/www/html/assets/tmp/crontab.txt', "");
			
			// Update temporary text file contents
			foreach($output as $row) {
				file_put_contents('/var/www/html/assets/tmp/crontab.txt', $row . PHP_EOL, FILE_APPEND);
			}

			// Save crontab to file
			echo exec('crontab /var/www/html/assets/tmp/crontab.txt');
			
		}


	}

