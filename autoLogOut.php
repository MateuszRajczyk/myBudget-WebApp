
<?php
 
   if((time() - $_SESSION['last_login_timestamp']) > 900) // automatic log out after 15 minutes (900s = 15 min)
   {  
		header("Location: signOut.php");  
   }  
   else  
   {  
		$_SESSION['last_login_timestamp'] = time();   
   }  


?>