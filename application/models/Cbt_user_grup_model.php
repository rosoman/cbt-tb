<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ZYA CBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Cbt_user_grup_model extends CI_Model{
	public $table = 'cbt_user_grup';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
    }
    
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_group(){
        $this->db->from($this->table)
                 ->order_by('grup_nama', 'ASC');
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $kolom, $isi){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table)
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table);
        return $this->db->get();
	}

    function get_group_by_id($id_group){
       // echo "<H1>$id_group</H1>";
        $id_ex = explode(',',$id_group);
        $q = "";
        //echo "<H1>$id_ex[0]</H1>";
        
            $q = "grup_id IN('".$id_ex[0]."'";
            if(count($id_ex)>1){
                for($i=1 ; $i<count($id_ex) ; $i++) {
                    # code...
                    $q .= ",'".$id_ex[$i]."'";
                }
            }
            $q .= ")";
        
        //echo "<H1>$q</H1>";
        $this->db->where('('.$q.')')
                 ->from($this->table)
                 ->order_by('grup_nama', 'ASC');
        return $this->db->get();
    }
}