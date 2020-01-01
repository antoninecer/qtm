<?php
   include("config.php");
   session_start();
    $error = "Please login";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST["username"]);
      $mypassword = mysqli_real_escape_string($db,$_POST["password"]); 
      $sql = "SELECT * FROM users WHERE username = '".$myusername."' and passcode = '".$mypassword."'";
      
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $id = $row["id"];
	  $admin = $row["admin"];
	  $active = $row["active"];
	  $manager = $row["manager"];
	  $submiter = $row["submiter"];
	  $tester = $row["tester"];
	  $queue = $row["queue"];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1 and $active == 1 ) {
         $_SESSION["login_user"] = $myusername;
         $_SESSION["user_id"] = $id;
		 $_SESSION["admin"] = $admin;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["submiter"] = $submiter;
		 $_SESSION["tester"] = $tester;
		 $_SESSION["queue"] = $queue;
		 
		 $stranka="welcome.php";
		 if ($tester == 1) {$stranka="tester.php";}
		 if ($submiter == 1) {$stranka="submiter.php";}
		 if ($manager == 1) {$stranka="showqueue.php";}
		 if ($admin == 1) {$stranka="adduser.php";}
		 $_SESSION["stranka"] = $stranka;
		 
		 $stranka="location: ".$_SESSION["stranka"];
		 
	  	 header($stranka);
      }else {
         $error = "Your Login Name or Password is invalid or account is not active";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <meta charset="UTF-8">
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :<br></label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :<br></label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>

   </body>
</html>