<?php  

class Quote extends CI_MODEL {

	public function add_quote($data){
		$query = "INSERT INTO quotes (quotedby, message, users_user_id, created_at, updated_at)
				  VALUES (?,?,?,?,?)";
		$values = array($data['quotedby'], $data['message'],$data['user_id'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function favorite($data){
		$query = "SELECT * FROM users_has_quotes 
				  WHERE quotes_quote_id = {$data['quote_id']}
				  AND users_user_id = {$data['user_id']}";
		$results = $this->db->query($query)->row_array();
		
		if(empty($results))
		{
			$query = "INSERT INTO users_has_quotes (users_user_id, quotes_quote_id)
				 	  VALUES (?,?)";
			$values = array($data['user_id'], $data['quote_id']);
			$this->db->query($query, $values);
		}
	}
	public function remove_quote($data){
		$query = "DELETE FROM users_has_quotes
				  WHERE quotes_quote_id = {$data['quote_id']}
				  AND users_user_id = {$data['user_id']}";
		$this->db->query($query);
	}

	public function get_favorite_quotes($user_id){
		$query = "SELECT quotes.quote_id, quotes.message, quotes.quotedby, users.name 
					FROM users_has_quotes 
					JOIN quotes on users_has_quotes.quotes_quote_id = quotes.quote_id
					JOIN users on quotes.users_user_id = users.user_id
					WHERE users_has_quotes.users_user_id = {$user_id}
					ORDER BY quotes.quote_id DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_all(){
		$query = "SELECT quotes.quote_id, quotes.message, quotes.quotedby, users.name 
				  FROM quotes 
				  JOIN users on quotes.users_user_id = users.user_id ORDER BY quotes.quote_id DESC";
		return $this->db->query($query)->result_array();
	
	}
}

?>