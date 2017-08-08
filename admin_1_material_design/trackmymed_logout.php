<?php
	session_start();
	if(!isset($_SESSION['username'])){ 
		header('Location: trackmymed_login.php');
	}

	unset($_SESSION['username']);
    header('refresh: 5; url=trackmymed_login.php');
?>


<!doctype html>
<html>
    <head>
        <link href="../assets/pages/css/trackmymed.login.min.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body class=" login">
 		<div id="logoutMessage">
			<h3>You are now logged out</h3>
			<p>You will be redirected to log in page in <label id="counter">5</label> second(s).</p>
		</div> 
 
        
    </body>
   
    <script type="text/javascript">
		function countdown() {
			var i = document.getElementById('counter');
			if (i.innerHTML > 0) {
				i.innerHTML = parseInt(i.innerHTML)-1;
			}
		}
		setInterval(function(){ countdown(); },1000);
	</script>
</html>