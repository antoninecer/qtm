<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'qtman');
   define('DB_PASSWORD', 'QtMaN');
   define('DB_DATABASE', 'qtman');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// definice funkci
   function sql_1($sql,$co) {
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$vysledek=$row[$co];
				}
		}
		return $vysledek;
   }
   
   function fronta() {
		$sql = 'select name from queue where id='.$_SESSION['queue'];
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$queuename=$row["name"];}
			echo $queuename;
		}
		else {
		echo "NOT Assigned";
		}
	}
?>