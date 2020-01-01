<?php
	include('session.php');
	$error = "Přidání hříšníka";
	$navrat=FALSE;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
		//zjisteni jestli takovy jiz neexistuje
		$sql="select id from hrisnici where jmeno='".$_POST['jmeno']."' and prijmeni='".$_POST['prijmeni']."' and narozeni='".$_POST['narozeni']."'";
		$result = $db->query($sql);
		//echo $sql;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$stranka = 'sinner.php?id='.$row["id"];
				$navrat=TRUE;
				
			} 
		}
   else {
		
		
		$sql = "insert into hrisnici(jmeno,prijmeni,narozeni,vlozil,overeni,datum) values('".$_POST['jmeno']."','".$_POST['prijmeni']."','".$_POST['narozeni']."','".$_SESSION['login_user']."','".$_POST['overeno']."',now())";
			if ($db->query($sql) == TRUE) {
				$_SESSION['error'] = "New record created successfully";
				$sql = "SELECT id, jmeno, prijmeni, narozeni FROM hrisnici where vlozil = '".$_SESSION['login_user']."' order by id desc limit 1";
				$result = $db->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$hrisnik = $row["id"]. " : " . $row["jmeno"]. " " . $row["prijmeni"]." " . $row["narozeni"];
						$_SESSION['error'] = $_SESSION['error']." <big><a href='sinner.php?id=".$row["id"]."'> ".$hrisnik. "</a></big><br>"; 
						$stranka = 'sinner.php?id='.$row["id"];
						$navrat=TRUE;
					}	
				}
			}
			else {
				$_SESSION['error'] =  "Error: " . $sql . "<br>" . $db->error;
			}
		}
   }
   

?>
<html>
   
   <head>
	<?php if($navrat) { header('Location: '.$stranka);} ?>
      <title>Přidání hříšníka / Add new sinner / neuer Sünder </title>
	  <meta charset="UTF-8">
   </head>
   
   <body>
   <?php 
   include('menu.php');
   
   ?>
   
      <h2 align="center">Přidání hříšníka / Add new sinner / neuer Sünder </h2>
 <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Přidání hříšníka / Add new sinner / neuer Sünder</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post" id="hrisnik">
                  <label>Jméno / Name / Name    :</label><input type = "text" name = "jmeno" class = "box"/><br /><br />
                  <label>Příjmení / Surname / Nachname :</label><input type = "text" name = "prijmeni" class = "box" /><br/><br />
                  <label>Narození / Birth / Geburt :</label><input type = "date" name = "narozeni" class = "box" /><br/><br />
				  Ověřeno / Verified / Verifiziert :<br />
				<select name="overeno">
					<option value="Průkaz totožnosti/ID">Průkaz totožnosti/ID</option>
					<option value="Registrace v agentuře/Agency">Registrace v agentuře/Agency</option>
					<option value="Důverihodná osoba/Right person">Důverihodná osoba/Right person</option>
					<option value="Neověřeno/None">Neověřeno/None</option>
				</select>
				  
				  
				  
				  
				  
                  <input type = "submit" value = " Submit "/><br />
               </form>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				
            </div>
				
         </div>
			
      </div>	  
	  
	  
	  
   </body>
   
</html>