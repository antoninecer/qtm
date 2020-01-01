<?php
	include('session.php');
	
	$presmerovani = FALSE;
   if($_SERVER["REQUEST_METHOD"] == "GET") {
    if( $_GET["id"] ) {  
   
	$id = $_GET["id"];
	$_SESSION['queue'] = $id;
	
	$sql = "update users set queue = '".$id."' where username = '".$_SESSION['login_user']."'";

	if ($db->query($sql) == TRUE) {
		$_SESSION['error'] =  "User updated successfully";
		$presmerovani = TRUE;
	} else {
		$_SESSION['error'] = "Error: ". $db->error ." ".$sql;
	}
	$stranka='location: '.$_SESSION['stranka'];
	if($presmerovani) { header($stranka);}
	} 
   }
?>
<html>  
   <head>
      <title>Fronty / Queue / Warteschlange </title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Fronty / Queue / Warteschlange</h2>
	  <h3 align="center">Please select one active queue by click on ID</h3> 
	    <?php
	   $radek = 0;
	   echo "<table align='center' border=0>";
	   echo "<tr style='background-color: #e0e0eb'><td>ID</td><td>name</td><td>from date</td><td>to date</td><td>description</td></tr>";
		$sql = "SELECT id,name, note, od, do FROM queue where active = 1 order by od";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				echo "<tr><td><a href='selqueue.php?id=".$row["id"]."'>".$row["id"]."</a></td>";
				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["od"]."</td>";
				echo "<td>".$row["do"]."</td>";
				echo "<td>".$row["note"]."</td></tr>";
			} 
				echo "</tr>";
				
		}	
	?> 
	</table>
	</body>
   
</html>