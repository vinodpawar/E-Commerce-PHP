<?PHP

	$con = mysqli_connect("localhost","root","","ecomm");

	if(mysqli_connect_errno()) {
		
		echo "Failed to connect to Database: ".mysqli_connect_error();
		
	}
	

?>