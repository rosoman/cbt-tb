<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coba_akses extends Member_Controller {
	private $kode_menu = 'tes-hasil';
	function __construct(){
		parent:: __construct();
		

		parent::cek_akses($this->kode_menu);
		
	}

	public function index(){
		$this->load->view('Coba_view');
	} 

}