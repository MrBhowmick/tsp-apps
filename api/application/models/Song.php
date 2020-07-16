<?php

class Song extends CI_Model {

	public function getAllMainCategory(){
		$query = $this->db->get('maincategories');
		return $query->result();
	}

	public function getAllSubCategory(){
		$query = $this->db->get('subcategories');
		return $query->result();
	}

	public function getAllTag(){
		$query = $this->db->get('tags');
		return $query->result();
	}

	public function getAllSong(){
		$this->db->select('s.id, s.name, s.song_url, s.image, s.created_at, s.updated_at, mc.name as mcname, sc.name as scname');
		$this->db->from('songs s');
		$this->db->join('maincategories mc', 's.maincategory_id = mc.id');
		$this->db->join('song_subcategory ss', 's.id = ss.song_id');
		$this->db->join('subcategories sc', 'sc.id = ss.subcategory_id');
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSongsByMainCategoryId($id){
		$this->db->select('s.id, s.name, s.song_url, s.image, s.created_at, s.updated_at, mc.name as mcname, sc.name as scname');
		$this->db->from('songs s');
		$this->db->join('maincategories mc', 's.maincategory_id = mc.id');
		$this->db->join('song_subcategory ss', 's.id = ss.song_id');
		$this->db->join('subcategories sc', 'sc.id = ss.subcategory_id');
		$this->db->where('mc.id',$id);
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSongsBySubCategoryId($id){
		$this->db->select('s.id, s.name, s.song_url, s.image, s.created_at, s.updated_at, mc.name as mcname, sc.name as scname');
		$this->db->from('songs s');
		$this->db->join('maincategories mc', 's.maincategory_id = mc.id');
		$this->db->join('song_subcategory ss', 's.id = ss.song_id');
		$this->db->join('subcategories sc', 'sc.id = ss.subcategory_id');
		$this->db->where('sc.id',$id);
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSongsById($id){
		$this->db->select('s.id, s.name, s.song_url, s.image, s.created_at, s.updated_at, mc.name as mcname, sc.name as scname');
		$this->db->from('songs s');
		$this->db->join('maincategories mc', 's.maincategory_id = mc.id');
		$this->db->join('song_subcategory ss', 's.id = ss.song_id');
		$this->db->join('subcategories sc', 'sc.id = ss.subcategory_id');
		$this->db->where('s.id',$id);
		$this->db->group_by('s.id');
		// $this->db->order_by('s.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSearchResult($term)
	{
		$this->db->select('s.id, s.name, s.song_url, s.image, s.created_at, s.updated_at, mc.name as mcname, sc.name as scname');
		$this->db->from('songs s');
		$this->db->join('song_tag st', 's.id = st.song_id');
		$this->db->join('tags t', 'st.tag_id = t.id');
		$this->db->join('maincategories mc', 's.maincategory_id = mc.id');
		$this->db->join('song_subcategory ss', 's.id = ss.song_id');
		$this->db->join('subcategories sc', 'sc.id = ss.subcategory_id');
		$this->db->where("s.name LIKE '%$term%'");
		$this->db->or_where("t.name LIKE '%$term%'");
		$this->db->or_where("mc.name LIKE '%$term%'");
		$this->db->or_where("sc.name LIKE '%$term%'");
		$this->db->group_by('s.song_url');

		$query = $this->db->get();
		return $query->result();
	}
}