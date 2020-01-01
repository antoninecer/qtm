<?php
	include('session.php');
?>
<html>  
   <head>
		<title>Hledání / Search / Suchen</title>
   </head>
   <body>   
		<?php
		include('menu.php');
		?>
		
		<h1 align="center">Hledání / Search / Suchen</h1>
		<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Hledání / Search / Suchen</b></div>
				
            <div style = "margin:30px">
               <form action = "" method = "post">
					<input type = "text" name = "search" class = "box" value="" /><br >
					<input type = "submit" value = " Search "/><br>
               </form>
            </div>
         </div>
      
	  <?php
	  if($_SERVER["REQUEST_METHOD"] == "POST") {
			$sql = "SELECT id, jmeno, prijmeni, narozeni FROM hrisnici where jmeno like '".$_POST["search"]."' or prijmeni like '".$_POST["search"]."' order by narozeni";
			$result = $db->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$hrisnik = $row["id"]. " : " . $row["jmeno"]. " " . $row["prijmeni"]." " . date("d-m-Y", strtotime($row["narozeni"]));
					echo "<big><a href='sinner.php?id=".$row["id"]."'> ".$hrisnik. "</a></big><br>"; 
				}	
			}
		}
	  ?>
	  </div>
   </body>   
</html>