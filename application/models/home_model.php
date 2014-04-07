<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	
	/*
	public function insert_hobby()
	{
		$list=$this->input->post('groups');
		$userid=$this->session->userdata('user_id');
		foreach ($list as  $hobby) {
			
    		$this->db->query("INSERT IGNORE INTO  User_Hob (User_id ,Hob_id )VALUES ( $userid, $hobby)");

		}

	}
	*/
	
	public function insert_hobby()
	{
		$hobby = $this->input->post('element');
		$userid = $this->session->userdata('user_id');
		$this->db->query("INSERT IGNORE INTO  User_Hob (User_id ,Hob_id )VALUES ( $userid, $hobby)");
		return;
	}
	
	public function user_det($user_id)
	{
		$sql = "select User_path 
			from User 
			where User_id = '$user_id'";
		$query=$this->db->query($sql);
		return $query->result();
	}

	public function get_search_details($keyword)
	{
		$srch=$keyword."%"; 
		$sql = "select * 
			from Hob 
			where Hob_hobbylist LIKE'$srch'";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	public function get_existing_hobbys()
	{
		$userid = $this->session->userdata('user_id');
		$sql = "SELECT a.Hob_id AS hodid, b.Hob_hobbylist AS hobname
					FROM User_Hob AS a, Hob AS b
					WHERE a.Hob_id = b.Hob_id
					AND a.User_id  = '$userid'";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
		public function get_user_details($User_id)
	{
	//start
		$user_details = array();
		$qry ="SELECT a.User_email, a.User_firstname, a.User_lastname, a.User_dateofbirth, a.User_gender, a.User_img, b.User_Profile_location, b.User_Profile_livesin, b.User_Profile_from
			FROM User AS a
			JOIN User_Profile AS b
			WHERE a.User_id = b.User_id
			AND a.User_id =$User_id";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0)
		{
			$user_details = $query->result();
		}
		return $user_details;
	//end
	}
}

/* End of file home_model.php */
/* Location: ./application/models/home_model.php */