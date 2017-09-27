<?php
class Rss_model extends CI_Model {

		public function __construct()
        {
                $this->load->database();
        }
		
		public function set_rss($data)
		{
			$this->db->truncate('rss');
			foreach ($data->channel->item as $news_item){
				$result = explode("<br>", $news_item->description);
				$media  = substr($result[0], strpos($result[0], ':') + 5);
				$author = substr($result[1], strpos($result[1], ':') + 5);
				$data   = substr($result[2], strpos($result[2], ':') + 5);
				$abstract = substr($result[4], strpos($result[4], ':') + 5);
			
			
				$query = array(
					'title' => $news_item->title,
					'link' => $news_item->link,
					'category' => $news_item->category[0],
					'description' => $news_item->description,
					'data' => $data,
					'author' => $author,
					'abstract' => $abstract,
					'media' => $media
				);
			
				$this->db->insert('rss', $query);
			}
			return;
		}
		
		public function get_rss()
		{
			$this->db->from('rss');
			$this->db->order_by("data", "asc");
			$this->db->order_by("title", "asc");
			$query = $this->db->get(); 
			return $query->result_array();
		}
		
}