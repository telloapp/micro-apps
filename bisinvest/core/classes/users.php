<?php

class Users{

private $db;

	public function __construct($database){
		$this->db = $database;
}

public function register($username, $password, $email){

		global $bcrypt; // making the $bcrypt variable global so we can use here
		
		$password   = $bcrypt->genHash($password);

		$query 	= $this->db->prepare("INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?) ");

		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->bindValue(3, $email);
		
	

		try{
			$query->execute();

		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function user_exists($username) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`= ?");
		$query->bindValue(1, $username);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

public function add_sme2($user_id, $name, $position, $experience)
{
	$query=$this->db->prepare("INSERT INTO team (`user_id`, `name`, `position`, `experience`) VALUES(?,?,?,?)");

$query->bindValue(1,$user_id);
$query->bindValue(2,$name);
$query->bindValue(3,$position);
$query->bindValue(4,$experience);

try {
	 $query->execute();
     } catch (PDOException $e) {
	   die($e->getMessage());
	}

}

public function dispBiz($id)
{
	$query=$this->db->prepare("SELECT * FROM `biz_profile` WHERE `user_id` = ?");
	$query->bindValue(1,$id);

	 try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}
}

public function dispBiz2($id)
{
	$query=$this->db->prepare("SELECT * FROM `team` WHERE `user_id` = ?");
	$query->bindValue(1,$id);

	 try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}
}

public function deleteProfile($proId)
{
	$query = $this->db->prepare("DELETE FROM biz_profile WHERE id = ?");
	$query->bindValue(1, $proId);

	try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

}

public function deleteProfile2($proId)
{
	$query = $this->db->prepare("DELETE FROM `team` WHERE id = ?");
	$query->bindValue(1, $proId);

	try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

}



/*============adding SME buseniss==================*/
public function add_sme($user_id,$biz_name,$marketing,$sales,$product,$total_emp,$problem,$solution,$uniquesp,$biz_summary,$monatization)
{
	$query = $this->db->prepare("INSERT INTO biz_profile (`user_id`,
												`biz_name`,
	                                           `marketing`,
	                                               `sales`,
	                                             `product`,
	                                            `total_emp`,
	                                             `problem`,
	                                            `solution`,
	                                            `uniquesp`,
	                                         `biz_summary`,
	                                        `monatization`) 
	                        VALUES (?,?,?,?,?,?,?,?,?,?,?)");

$query->bindValue(1,$user_id);
$query->bindValue(2,$biz_name);
$query->bindValue(3,$marketing);
$query->bindValue(4,$sales);
$query->bindValue(5,$product);
$query->bindValue(6,$total_emp);
$query->bindValue(7,$problem);
$query->bindValue(8,$solution);
$query->bindValue(9,$uniquesp);
$query->bindValue(10,$biz_summary);
$query->bindValue(11,$monatization);

try {
	 $query->execute();
     } catch (PDOException $e) {
	   die($e->getMessage());
	}

}

public function login($username, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ?");
		$query->bindValue(1, $username);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

/*============Viewing a specific SME buseniss in our database based on User_ID==================*/

	public function viewe_sme($id){

		$query=$this->db->prepare("SELECT * FROM bizinvest WHERE id = ? ");
		 $query->bindValue(1, $id);

        try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}

	}

/*============updating SME buseniss==================*/

public function update_sme($id,$user_id)

{
$query=$this->db->prepare("UPDATE bizinvest SET user_id= ?,
	                                         marketing = ?,
	                                             selas = ?,
	                                           product = ?,
	                                          toal_emp = ?,
	                                           problem = ?,
	                                          solution = ?,
	                                          uniquesp = ?,
	                                       biz_summary = ?,
	                                      monatization = ?  WHERE id = ?");

$query->bindValue(1,$user_id);
$query->bindValue(2,$marketing);
$query->bindValue(3,$selas);
$query->bindValue(4,$product);
$query->bindValue(5,$toal_emp);
$query->bindValue(6,$problem);
$query->bindValue(7,$solution);
$query->bindValue(8,$uniquesp);
$query->bindValue(9,$biz_summary);
$query->bindValue(10,$monatization);
$query->bindValue(11,$id);

try {
	 $query->execute();
     } catch (PDOException $e) {
	   die($e->getMessage());
	}

}

/*===============Viewing a specific SME buseniss in our database based on it's ID==================*/

public function viewe1_sme($id){

		$query=$this->db->prepare("SELECT * FROM bizinvest WHERE id = ? ");
		 $query->bindValue(1, $id);

        try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}

	}
/*============deleting SME buseniss==================*/

public function delete_sme($user_id) {

		$query = $this->db->prepare("DELETE FROM bizinvest WHERE id = ?");
	
		$query->bindValue(1,$user_id);
		
		try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

/*============Seleting all SME buseniss images==================*/
public function view_gallery($id){
		$query=$this->db->prepare("SELECT * FROM gallery WHERE id = ?  
			                                             ORDER BY id 
			                                             DESC LIMIT 0,4 ");

		$query->bindValue(1,$id);


          try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}
	}	

/*============listing all SME buseniss in our database==================*/

public function list_sme(){
		global $db;
    
	$query=$this->db->prepare("SELECT * FROM bizinvest ");
        try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}


	}

/*================Display a specific SME based on it's ID in home page=======*/


	public function display_sme_list($id){
		global $db;

	$query=$this->db->prepare("SELECT * FROM bizinvest  WHERE id = ? ");

	 $query->bindValue(1,$id);

        try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}


	}

	

	/*============adding multi SME buseniss images ==================*/

public function add_sme_image($user_id,$b_id,$file_name){
			

if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
          $query = $this->db->prepare("INSERT INTO `gallery` (`user_id`,`b_id`,`files`) VALUES (?,?,?)");
        $query->bindValue(1, $user_id);
		$query->bindValue(2, $b_id);		
		$query->bindValue(3, $file_name);
				
		

		try {
			$query->execute();
			  header('Location:.php'.$_SERVER['REQUEST_URL']);


		} catch (PDOException $e) {

			die($e->getMessage());
		}




        $desired_dir="sme";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		 			
        }else{
                print_r($errors);
        }
    }
	
}



	}
}


?>