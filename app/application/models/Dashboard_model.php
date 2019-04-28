<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Dashboard Model
	*/
	class Dashboard_model extends CI_Model
	{
		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url', 'utility'));
			$this->load->library('ion_auth');
			$this->load->model('Climate_model');
			$this->load->model('Lights_model');
		}

		// Get User Info
		public function get_user_info()
		{
			// Get user ID for current user logged in
			$user = $this->ion_auth->user()->row();
			$id = $user->id;
	
			// Fetch user record from the database
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where(array('users.id' => $id));
	
			// Return the result as array
			$query = $this->db->get();
			return $query->result();
		}
		
		// Get latest grow data
		public function get_latest_grow_data()
		{
			$this->db->select("*");
			$this->db->from("grow_data");
			$this->db->order_by("id","DESC");
			$this->db->limit(1);

			$query = $this->db->get();
			$grow_data = $query->result_array()[0];
			$lights_data = $this->Lights_model->getLightStatusMessage();

			$data = array(
				"id" => $grow_data["id"],
				"date_time" => $grow_data["date_time"],
				"temperature" => $grow_data["temperature"],
				"humidity" => $grow_data["humidity"],
				"light_status" => $grow_data["light_status"],
				"light_status_message" => $lights_data["status"],
				"light_hours" => $lights_data["lightHours"],
				"moisture_status" => $grow_data["moisture_status"],
				"fan_status" => $grow_data["fan_status"],
				"pump_status" => $grow_data["pump_status"],
			);

			return $data;
		}

		// Get latest grow data
		public function get_sensor_activation_state()
		{
			// Fetch sensor state
			$data = array(
				"climate_state" => $this->Climate_model->climateActivationState(),
				"camera_state" => $this->Camera_model->cameraActivationState(),
				"fan_state" => $this->Fan_model->fanActivationState(),
				"lights_state" => $this->Lights_model->lightsActivationState(),
				"moisture_state" => $this->Moisture_model->moistureActivationState(),
				"pump_state" => $this->Pump_model->pumpActivationState()
			);

			return $data;
		}

		// Get 24-hr temperature chart data
		public function get_temperature_chart_data()
		{
			$tempFormat = $this->Climate_model->getTemperatureFormat();

			$this->db->select("*");
			$this->db->from("climate_history");
			$this->db->order_by("id","DESC");
			$this->db->limit(24);

			$query = $this->db->get();
			$results = $query->result_array();

			$output = "";
			$count = 1;
			foreach($results as $result) {
				if ($count == count($results)) {
					if ($tempFormat == "F") {
						$output .= celsiusToFahrenheit($result["temperature"]);
					} else {
						$output .= $result["temperature"];
					}
				} else {
					if ($tempFormat == "F") {
						$output .= celsiusToFahrenheit($result["temperature"]) . ", ";
					} else {
						$output .= $result["temperature"] . ", ";
					}
				}
				$count++;
			}

			return $output;
		}

		// Get 24-hr humidity chart data
		public function get_humidity_chart_data()
		{
			$this->db->select("*");
			$this->db->from("climate_history");
			$this->db->order_by("id","DESC");
			$this->db->limit(24);

			$query = $this->db->get();
			$results = $query->result_array();

			$output = "";
			$count = 1;
			foreach($results as $result) {
				if ($count == count($results)) {
					$output .= $result["humidity"];
				} else {
					$output .= $result["humidity"] . ", ";
				}
				$count++;
			}

			return $output;
		}

		// Get chart legend
		public function get_chart_legend()
		{
			$this->db->select("*");
			$this->db->from("climate_history");
			$this->db->order_by("id","DESC");
			$this->db->limit(24);

			$query = $this->db->get();
			$results = $query->result_array();

			$output = "";
			$count = 1;
			foreach($results as $result) {
				if ($count == count($results)) {
					$output .= "\"" . date_format(date_create($result["date_time"]), "M d H:i") . "\"";
				} else {
					$output .= "\"" . date_format(date_create($result["date_time"]), "M d H:i")  . "\"" . ", ";
				}
				$count++;
			}

			return $output;
		}

		// Get daily High temperature
		public function get_temperature_dailyHIGH()
		{
			$this->db->select_max('temperature');
			$this->db->from("grow_data");
			$this->db->where('date_format(date_time,"d-m-Y H:i")', 'CURDATE()', FALSE);
			$query = $this->db->get();

			return $query->result();
		}

		// Get daily Low temperature
		public function get_temperature_dailyLOW()
		{
			$this->db->select_min('temperature');
			$this->db->from("grow_data");
			$this->db->where('date_format(date_time,"d-m-Y H:i")', 'CURDATE()', FALSE);
			$query = $this->db->get();

			return $query->result();
		}

		// Get daily High humidity
		public function get_humidity_dailyHIGH()
		{
			$this->db->select_max('humidity');
			$this->db->from("grow_data");
			$this->db->where('date_format(date_time,"d-m-Y H:i)', 'CURDATE()', FALSE);
			$query = $this->db->get();

			return $query->result();
		}

		// Get daily Low humidity
		public function get_humidity_dailyLOW()
		{
			$this->db->select_min('humidity');
			$this->db->from("grow_data");
			$this->db->where('date_format(date_time,"d-m-Y H:i:s")', 'CURDATE()', FALSE);
			$query = $this->db->get();

			return $query->result();
		}

		// Current Crop Threshold
		public function get_cropThresholds()
		{
			// Prepare Data
			$climate_threshold = $this->Climate_model->getClimateThreshold();

			$data = array();
			$curTemp = $this->Climate_model->getTemperature();
			$tempHigh = $climate_threshold['temp_MAX'];
			$tempLow = $climate_threshold['temp_MIN'];

			$curHumid = $this->Climate_model->getHumidity();
			$humidHigh = $climate_threshold['humid_MAX'];
			$humidLow = $climate_threshold['humid_MIN'];

			// Check Temperature Range
			if (($curTemp >= $tempLow) && ($curTemp <= $tempHigh))
			{
				$data['temperature'] = 'Y';
			} else {

				if ($curTemp <= $tempLow) {
					$data['temperature'] = 'N';
					$data['tempStatus'] = 'L';
				} elseif($curTemp >= $tempHigh) {
					$data['temperature'] = 'N';
					$data['tempStatus'] = 'H';
				}
			}

			// Check Humidity Range
			if (($curHumid >= $humidLow) && ($curHumid <= $humidHigh))
			{
				$data['humidity'] = 'Y';
			} else {
				if ($curHumid <= $humidLow) {
					$data['humidity'] = 'N';
					$data['humidStatus'] = 'L';
				} elseif($curHumid >= $humidHigh) {
					$data['humidity'] = 'N';
					$data['humidStatus'] = 'H';
				}
			}

			return $data;

		}

		// Current Crop Conditions
		public function get_cropConditions()
		{
			
			$sql = "SELECT * FROM grow_data WHERE DATE(date_time) = CURDATE() ORDER BY date_time DESC";
			$query = $this->db->query($sql);
			$tempData = $query->result_array();

			// Grow Room Thresholds
			$climate_threshold = $this->Climate_model->getClimateThreshold();
			$tempHigh = $climate_threshold['temp_MAX'];
			$tempLow = $climate_threshold['temp_MIN'];
			$humidHigh = $climate_threshold['humid_MAX'];
			$humidLow = $climate_threshold['humid_MIN'];

			// Loop through tempData
			$total_records = sizeof($tempData);
			$positive_records = 0;
			
			foreach ($tempData as $item) {
				$temp = $item['temperature'];
				$humid = $item['humidity'];
				if (($temp >= $tempLow) && ($temp <= $tempHigh) && ($humid >= $humidLow) && ($humid <= $humidHigh)) {
					$positive_records++;
				}
			}

			// Calculate Ratio check for zero division
			if ($positive_records != 0 && $total_records != 0) {
				$cropConditions = round(($positive_records / $total_records) * 100);
				return $cropConditions;
			} else {
				return $cropConditions = 0;
			}

		}
	
	}

?>