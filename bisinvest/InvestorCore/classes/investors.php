<?php 
class investors{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	

	public function change_password($user_id, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);

		$query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function change_email($user_id, $email) {


		$query = $this->db->prepare("UPDATE `users` SET `email` = ? WHERE `id` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}	
	
	
	public function investor_exists($email) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `investor` WHERE `email`= ?");
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
	 
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `investor` WHERE `email`= ?");
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

	public function register($password, $email){

		global $bcrypt; // making the $bcrypt variable global so we can use here
		
		$password   = $bcrypt->genHash($password);

		$query 	= $this->db->prepare("INSERT INTO `investor` (`password`, `email`) VALUES (?, ?) ");

		
		$query->bindValue(1, $password);
		$query->bindValue(2, $email);
		
		try{
			$query->execute();


		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	

	public function login($email, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `investor` WHERE `email` = ?");
		$query->bindValue(1, $email);

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

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `investor` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	public function viewBiz()
	{
		$query = $this->db->prepare("SELECT * FROM biz_profile");

		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}

	}


	public function viewBiz2($id)
	{
		$query = $this->db->prepare("SELECT * FROM biz_profile");
		$query->bindValue(1,$id);

		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}

	}

	public function Addinvest($profile_id, $investor_id)
	{
		$query = $this->db->prepare("INSERT INTO `viewedprofiles`(`profile_id`, `investor_id`) VALUES(?,?)");

		$query->bindValue(1,$profile_id);
		$query->bindValue(2,$investor_id);

		try{
			$query->execute();


		}catch(PDOException $e){
			die($e->getMessage());
		}	

	}

	public function profile_exist($profile_id, $investor_id) {
	
		$query = $this->db->prepare("SELECT COUNT(`investor_id`) FROM `viewedprofiles` WHERE `profile_id`= ? AND `investor_id` = ?");
		$query->bindValue(1, $profile_id);
		$query->bindValue(2, $investor_id);
	
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

	public function investorProfiles($id)
	{
		$query = $this->db->prepare("SELECT t1.profile_id, t1.investor_id, t2.id, t3.id, t3.biz_name, t3.marketing,t3.sales,t3.product,t3.total_emp,t3.problem,t3.solution,t3.biz_summary,t3.monatization, t3.uniquesp FROM viewedprofiles t1 INNER JOIN investor t2 ON t1.investor_id = t2.id INNER JOIN biz_profile t3 ON t3.id =t1.profile_id WHERE t1.investor_id = ?");
		$query->bindValue(1,$id);

		try{
			$query->execute();
			return $query->fetchAll();
		}
		catch(PDOException $e){
			die($e->getMessage()); 
		}
	}
	  	  	 
	
}

?>