<?php
	// $objConnect = mysql_connect("52.27.171.207","root","1234");
	// mysql_select_db("testdb",$objConnect);
  mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
  mysql_query("SET character_set_connection=utf8");
  header('Access-Control-Allow-Origin: *');
?>
<?php
	$servername = "52.27.171.207";
	$username = "root";
	$password = "1234";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
?>