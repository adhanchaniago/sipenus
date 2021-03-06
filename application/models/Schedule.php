<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Model {

    private $table = 'schedules';
	private $id = 'id';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get($status) {
		$this->db->select('a.id as schdules_id, a.category_id, ');
		$this->db->from('schedules a');
    	$this->db->join('minithesis b', 'a.minithesis_id = b.id');
		$this->db->join('users c', 'b.collage_student_id = c.id');
		$this->db->where('a.status', $status);
		$query = $this->db->get();
		return $query->result();
    }

    public function getWhere($data) {
        $query = $this->db->where($data)->get($this->table);
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function insertSchedule($data) {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
	}
	
    public function update($id, $data){
        //run Query to update data
        if(isset($data[$this->id]))unset($data[$this->id]);
        $query = $this->db->where('collage_student_id', $id)->update(
          $this->table, $data
        );
        return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function getMinithesisById($id) {
		$this->db->from('users a');
    	$this->db->join('minithesis b', 'a.id = b.collage_student_id', 'right');
		$this->db->where('b.collage_student_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getScheduleByMinithesis($id) {
		$this->db->select('b.*');
		$this->db->from('minithesis a');
    	$this->db->join('schedules b', 'b.minithesis_id = a.id', 'left');
		$this->db->where('a.id', $id); 
		$query = $this->db->get();
		return $query->result();
	}
}

?>
