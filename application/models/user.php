<?php  

class User extends CI_Model {

     function get_user_by_email($email)
     {
         return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
     }

     function add_user($user_details)
     {
         $query = "INSERT INTO Users (name, email, password, created_at, updated_at) 
                   VALUES (?,?,?,?,?)";
         $values = array($user_details['name'],$user_details['email'], 
                    $user_details['password'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
        $this->db->query($query, $values);
        return $this->db->insert_id();
     }
}

?>