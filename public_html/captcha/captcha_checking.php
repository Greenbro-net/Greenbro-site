<?php
	session_start();
	if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{ 
        
        $_SESSION['one'] = 1;    
        header("Location: /admin/admin.php");
        exit();	
        
			
	}	else {  

        echo "вы весьма надоедливый бот!";
        die;
		
	}
?>