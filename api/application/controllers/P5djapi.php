<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P5djapi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

	}
	function __construct()
	{
		parent::__construct();
		
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Credentials: true");
		header("Accept: application/json; text/plain");
        // header("cache-control: no-cache");
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		header("Content-Type: application/json; charset=utf-8");
		
		$this->load->model('song');
	}
	public function maincategories()
	{
		$maincategories = $this->song->getAllMainCategory();
		echo json_encode(['success'=>true, 'data'=>$maincategories]);
	}
	public function subcategories()
	{
		$subcategories = $this->song->getAllSubCategory();
		echo json_encode(['success'=>true, 'data'=>$subcategories]);
	}
	public function tags()
	{
		$tags = $this->song->getAllTag();
		echo json_encode(['success'=>true, 'data'=>$tags]);
	}
	public function songs()
	{
		$song = $this->song->getAllSong();
		echo json_encode(['success'=>true, 'data'=>$song]);
	}
	public function songsByMainCategoryId($id)
	{
		$song = $this->song->getSongsByMainCategoryId($id);
		echo json_encode(['success'=>true, 'data'=>$song]);
	}
	public function songsBySubCategoryId($id)
	{
		$song = $this->song->getSongsBySubCategoryId($id);
		echo json_encode(['success'=>true, 'data'=>$song]);
	}
	public function songsById($id)
	{
		$song = $this->song->getSongsById($id);
		echo json_encode(['success'=>true, 'data'=>$song]);
	}
	public function search($term)
	{
		$song = $this->song->getSearchResult($term);
		echo json_encode(['success'=>true, 'data'=>$song]);	
	}
}
