<?php
include('session.php');
	
	if ($_SESSION['admin'] == 1 or $_SESSION['manager'] == 1) {
		$error = "Report";
	} else {
		$error = "Nejsi administrator nebo manager !";
	}
   if($_SERVER["REQUEST_METHOD"] == "POST") {
 }
   ?>
<html>  
   <head>
      <title>Report </title>
	  <meta charset="UTF-8">
   </head>
   <body>   
      <?php include('menuadmin.php'); ?>
	  <h2 align="center">Report</h2>
	  
	
	 <br>
	 <table align='center' border=0>
	<?php
	  $radek = 0;
	   echo "<tr style='background-color: #e0e0eb'><td>ID</td><td>Date</td><td>Name</td><td>Duration</td><td>Queue</td><td>Note</td><td>Result</td><td>Reason</td><td>Started</td><td>Finished</td></tr>";
		$sql = "SELECT * FROM task  order by queue, priority, id ";
		//print($sql);
		
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$radek = $radek + 1;
				if ($radek % 2 == 0) { echo "<tr style='background-color: #f0f0f5'>"; } else {  echo "<tr style='background-color:  #ffffff'>";}
				echo "<td>".$row["id"]."</td>";
				echo "<td>".$row["date"]."</td>";
				echo "<td>".$row["name"]."</td>";
				echo "<td>".$row["duration"]."</td>";
				echo "<td>".$row["queue"]."</td>";
				echo "<td>".$row["note"]."</td>";
				echo "<td>".$row["result"]."</td>";
				echo "<td>".$row["reason"]."</td>";
				echo "<td>".$row["started"]."</td>";
				echo "<td>".$row["finished"]."</td>";
				echo "</tr>";
				
			}	
		}
	?> 
	</table>
	
   </body>
   
</html>