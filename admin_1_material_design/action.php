<?php
	session_start();
	if(isset($_SESSION['username'])){ 
		header('Location: trackmymed_dashboard.php');
	}
	else{
        header('Location: trackmymed_login.php');
    }
	$errorLogin = null;
	if (isset($_POST['username'])) {
		if (checkPassword($_POST['username'], $_POST['password'])){
			if (isset($_POST['remember'])){
				$cookie_name = "user";
				$cookie_value = $_POST['username'];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			}
			else {
				unset($_COOKIE['user']);
				setcookie ("user", "", time() - 4200, "/");
			}		
			$_SESSION['username'] = $_POST['username'];
			header('Location: trackmymed_dashboard.php');
			exit();
		}
		else{
			$errorLogin = 'Wrong uesrname or password';
			$_SESSION['errorLogin'] = $errorLogin;
			header('Location: trackmymed_login.php');
		}
	}
	
	function checkPassword ($username, $password) {
		require 'database.inc';
		$username = str_replace("<","&lt",$username);
		$username = str_replace(">","&gt",$username);
		$password = str_replace("<","&lt",$password);
		$password = str_replace(">","&gt",$password);
		$query = $pdo->prepare("SELECT * FROM users WHERE username = :username and password = SHA2(CONCAT(:password , salt), 0);");
		$query->execute(array('username' => $username, 'password' => $password));
		if ($query->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
?>


