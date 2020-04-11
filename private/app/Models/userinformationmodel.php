<?php
classUserInformationModel extends Model {
    function_construct(){
        parent::_construct();
    }
    function validateUser($username,$password){
        $cln_username=$username;
        $cln_password=$password;
        $sql = "SELECT `hash_password`, `first_name`, `last_name` from authors where email = ?";
        $statement = $this->db->prepare($sql);
        $count = $statement->execute(Array($cln_username));
        $row = $satement->fetch();
        $hash_password = $row[0];
        $is_validate = false;
        if(isset($hash_password)){
            $is_validate = password_verify($cln_password,$hash_password);
            if($is_validate){
                $_SESSION["first_name" = $row[1]];
                $_SESSION["last_name" = $row[2]];
                $_SESSION["username"] = $cln_username;
                $update_sql = "UPDATE `authors` set `last_login_date` = CURRENT_TIMESTAMP() where email = ?";
                $update_statement = $this->db->prepare($update_sql);
                $update_statement->execute(Array($cln_username)); 
            }
        }
    }
}
?>