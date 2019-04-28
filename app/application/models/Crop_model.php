<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* FruxePi (frx-dev-v0.3)
	* Crop Model
	*/
	class Crop_model extends CI_Model
	{
		// Constructor
		public function __construct()
		{
			$this->load->database();
        	$this->load->helper(array('form', 'url'));
        	$this->load->library('ion_auth');
		}


		/**
		* Generate CropID
		* Generate a unique string to identify each crop.
		* @return String
		*/
		public function generateCropID()
		{
			$length = 5;
			$cropID = "";
			$characters = array_merge(range('A','Z'), range('0','9'));
			$max = count($characters) - 1;
			
			for ($i = 0; $i < $length; $i++) {
				$rand = mt_rand(0, $max);
				$cropID .= $characters[$rand];
			}
			
			return "FRX-CR0" . $cropID;
		}


		/**
		* Get Crop Info
		* Returns an array of basic information on the crop. 
		* @return Array
		*/
		public function cropInfo($cropID)
		{
			$crop_info = $this->Crop_model->getCrop($cropID);
			$crop_progress = $this->Crop_model->getCropProgress($cropID);

			$data = array(
				"cropID" => $crop_info['cropID'],
				"nickname" => $crop_info['nickname'],
				"plant_qty" => $crop_info['plant_qty'],
				"plant_type" => $crop_info['plant_type'],
				"crop_start" => $crop_info['crop_start'],
				"crop_end" => $crop_info['crop_end'],
				"total_growdays" => $crop_progress['daysTotal'],
				"growdays_complete" => $crop_progress['daysComplete'],
				"growdays_remaining" => $crop_progress['daysLeft'],
				"crop_progress" => $crop_progress['progress'],
				"crop_thumbnail" => $crop_info['crop_thumbnail'],
			);

			return $data;
		}

		/**
		* Get All Crop Info
		* Returns an array of basic information on the crop. 
		* @return Array
		*/
		public function getAllCropsInfo()
		{
			$output = array();
			$crops = $this->Crop_model->getCrops();

			foreach($crops as $crop) {
				$crop_data = $this->Crop_model->cropInfo($crop['cropID']);
				array_push($output, $crop_data);
			}

			return $output;
		
		}

		/**
		* Get Crop By cropID
		* Get crop by cropID. 
		* @return Array
		*/
		public function getCrop($cropID)
		{
			$this->db->select("*");
			$this->db->from("crops");
			$this->db->where('cropID', $cropID);

			$query = $this->db->get();
			
			return $query->result_array()[0];
		}

		/**
		* Get All Crops
		* Returns an array of crops. 
		* @return Array
		*/
		public function getCrops()
		{
			$this->db->select("*");
			$this->db->from("crops");

			$query = $this->db->get();
			
			return $query->result_array();
		}


		/**
		* Setup Crop
		* Create a new crop.
		* @return void
		*/
		public function setupCrop()
		{
			$data = array(
				"cropID" => $this->Crop_model->generateCropID(),
				"nickname" => $this->input->post('nickname'),
				"plant_qty" => $this->input->post('plant_qty'),
				"plant_type" => $this->input->post('plant_type'),
				"crop_start" => $this->input->post('crop_start'),
				"crop_end" => $this->input->post('crop_end'),
				"crop_thumbnail" => $this->input->post('crop_thumbnail'),
				"date_created" => date("d-m-Y H:i:s"),
				"date_modified" => date("d-m-Y H:i:s")
			);

			return $this->db->insert('crops', $data);
		}


		/**
		* Edit Crop
		* Edit crop
		* @return True
		*/
		public function editCrop($cropID)
		{
			$data = array(
				"nickname" => $this->input->post('nickname'),
				"plant_qty" => $this->input->post('plant_qty'),
				"plant_type" => $this->input->post('plant_type'),
				"crop_start" => $this->input->post('crop_start'),
				"crop_end" => $this->input->post('crop_end'),
				"crop_thumbnail" => $this->input->post('crop_thumbnail'),
				"date_modified" => date("d-m-Y H:i:s")
			);

			$this->db->where('cropID', $cropID);
			return $this->db->update('crops', $data);
		}


		/**
		* Delete Crop
		* Delete crop from the database. 
	 	* @return True
		*/
		public function deleteCrop($cropID)
		{
			$this->db->where('cropID', $cropID);

			return $this->db->delete('crops');
		}

		/**
		* Get Crop Activity Entries
		* Return all crop journal entries for specific crop.
		* @return True
		*/
		public function get_cropActivity()
    	{
			$this->db->select("*");
			$this->db->from("activity");
			$this->db->order_by('id', 'desc');

			$query = $this->db->get();
			
			return $query->result_array();
    	}
	
		/**
		* Get Single Crop Activity Entry
		* Add a new crop activity entry to the database.
		* @return True
		*/
		public function getCropActivityEntry($id)
		{
			$this->db->select("*");
			$this->db->from("activity");
			$this->db->where('id', $id);

			$query = $this->db->get();
			
			return $query->result_array()[0];
		}

		/**
		* Add Crop Journal Entry
		* Add a new crop journal entry to the database.
		* @return True
		*/
		public function addActivityEntry()
		{
			// Journal Entry fields for database update
			$data = array(
				"cropID" => $this->input->post('crop'),
				"date_time" => date("Y-m-d H:i:s"),
				"activity_type" => $this->input->post('activity_type'),
				"msg" => $this->input->post('msg')
			);

			return $this->db->insert('activity', $data);
		}


		/**
		* Delete Crop Activity Entry
		* Delete a Crop Journal entry from the database. 
		* @return True
		*/
		public function deleteActivityEntry($id)
		{
			$this->db->where('id', $id);

			return $this->db->delete('activity');
		}


		/**
		* Edit Crop Activity Entry
		* Edit a Crop Journal Entry. 
		* @return True
		*/
		public function editActivityEntry($id)
		{
			// Journal Entry fields for database update
			$data = array(
				"msg" => $this->input->post('msg')
			);

			$this->db->where('id', $id);
			return $this->db->update('activity', $data);
		}

		
		// Current Crop Stage
		public function getCropProgress($cropID)
		{
			$query = $this->db->get_where('crops', array('cropID' => $cropID));
			$cropData = $query->row_array();

			$curDay = new DateTime();
			$cropStart = new DateTime($cropData['crop_start']);
			$cropEnd = new DateTime($cropData['crop_end']);

			$daysTotal = $cropStart->diff($cropEnd)->format("%a");
			$daysComplete = $curDay->diff($cropStart)->format("%a");
			$daysLeft = $curDay->diff($cropEnd)->format("%a");

			if ($daysTotal <= $daysComplete) {
				
				$extraDays = $daysComplete - $daysTotal;

				$data['daysTotal'] = $daysTotal;
				$data['daysComplete'] = $daysComplete;
				$data['daysLeft'] = "+" . $extraDays;
				$data['progress'] = 100;

				return $data;
			
			} else {

				$data['daysTotal'] = $daysTotal;
				$data['daysComplete'] = $daysComplete;
				$data['daysLeft'] = $daysLeft;
				$data['progress'] = round(($daysComplete / $daysTotal) * 100);

				return $data;
			}

		}

	}

