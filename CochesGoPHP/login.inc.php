<?php

     include 'config.inc.php';
	 
	 // Check whether username or email or password is set from android	
     if(isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['passwd']))
     {
		  // Innitialize Variable
	   	  $usuario = $_POST['usuario'];
          $email = $_POST['email'];
            $passwd = $_POST['passwd'];
      $myUser=new \stdClass();
		  
		  // Query database for row exist or not
          $sql = 'SELECT username, email, passwd FROM usuarios WHERE (username = :usuario OR email = :email) AND passwd = :passwd';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR);
          $stmt->execute();
          $result=$stmt->fetch(PDO::FETCH_ASSOC);

          if($result['username']==$usuario)
          {
            
            $sql='UPDATE usuarios SET ultimaVez=CURRENT_TIMESTAMP WHERE username=:usuario';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            $userJSON = json_encode($result);
            echo $userJSON;        
          }  
          elseif($usernameJSON!=$usuario)
          {
			  	  echo "false";
          }

  	} else {
      echo "No hay Params.";
    }
	
?>