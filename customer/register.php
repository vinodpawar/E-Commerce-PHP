<?PHP

include("../functions/functions.php");

if(isset($_SESSION['user'])) {

	header('Location: ../index.php');
	
}

if(isset($_POST['register'])) {
	
	global $con;
	
	$ip = getIp();
	
	$name = $_POST['name'];
	
	$email = $_POST['email'];
	
	$pwd = $_POST['password'];
	
	$country = $_POST['country'];
	
	$city = $_POST['city'];
	
	$contact = $_POST['contact'];
	
	$cust_image = $_FILES['image']['name'];
	
	$cust_image_tmp = $_FILES['image']['tmp_name'];
	
	move_uploaded_file($cust_image_tmp,"images/$cust_image");
	
	$registerQuery = "insert into customers(cust_ip,cust_name,cust_email,cust_pwd,cust_country,cust_city,cust_contact,cust_image) values('$ip','$name','$email','$pwd','$country','$city','$contact','$cust_image')";
	
	$registerQueryResult = mysqli_query($con, $registerQuery); 
	
	if($registerQueryResult) {
		
		echo "<script>window.alert('You are registered!')</script>";
	}
	
}

?>

<html>

<head>

<link rel="stylesheet" href="../styles/style.css" media="screen">
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">

	<title>E-Commerce</title>

</head>

<body>
	
	<div class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a href="/ecomm/index.php" class="navbar-brand">E-Commerce Site</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>	
			  <a href="allproducts.php">All Products</a>			
			</li>

						
	
			<li>
              <a href="../cart.php">Shopping Cart (<?PHP totalItems(); ?>)</a>
            </li>
			
			<li>
              <a href="#"></a>
            </li>
            
			<li>
              <a href="#"></a>
            </li>
			
        </ul>

		<div class="col-sm-4 col-md-4">
			<form class="navbar-form" role="search" action="../result.php">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="user_query">
				
						<div class="input-group-btn">
						
							<button class="btn btn-success" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
						
						</div>
				</div>
			</form>
		</div>
		  
		  
			<?PHP
		  	
			isLoggedInNav();
			
			?>
			
          

        </div>
      </div>
	  
    </div>

	
	
		


	
	<div class="container col-md-3">
	
		<ul style="list-style:none;text-align:center;font-size:22px;" >
		
			<li><h2>Categories</h2></li>
			<?PHP getCats(); ?>
			
			<li><h2>Brands</h2></li>
			<?PHP getBrands(); ?>
			
		</ul>
	</div>
	
	<?PHP getIp(); ?>
	
	
	
	<div class="col-md-9" style="margin-bottom: 50px;">
	
	<form action="register.php" method="POST" enctype="multipart/form-data">
	
		<div class="col-md-8">
		<h3>Create an account:</h3>
		<hr style='border-width: 2px;'/>
		
		<div class="form-group">
			<label for="usr">Name:</label>
			<input type="text" class="form-control" id="usr" name="name" placeholder="First name Last name" required/>
		</div>
		
		<div class="form-group">
			<label for="usr">Email:</label>
			<input type="text" class="form-control" id="usr" name="email" placeholder="username@domain.com" required/>
		</div>
		
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="Password" name="password" required/>
		</div>
		
		<div class="form-group">
			<label for="pwd">Country:</label>
			
			<select name="country" class="form-control" required/>
				<option value="India">India</option>
				<option value="United States of America">United States of America</option>
				<option value="Canada">Canada</option>
				<option value="Thailand">Thailand</option>
				<option value="Philippenes">Philippenes</option>
				<option value="Japan">Japan</option>
				<option value="Spain">Spain</option>
				<option value="Mexico">Mexico</option>
			</select>
		</div>
		
		<div class="form-group">
			<label for="pwd">City:</label>
			
			<select name="city" class="form-control" required/>
				<option selected value="Aurangabad">Aurangabad</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Pune">Pune</option>
				<option value="Nashik">Nashik</option>
			</select>
		</div>
		
		<div class="form-group">
			<label for="pwd">Contact:</label>
			<input type="text" class="form-control" id="contact" placeholder="+91 XXXXXXXXXX" name="contact" required/>
		</div>
		
		<div class="form-group">
			<label for="pwd">Picture:</label>
			<input type="file" class="form-control" id="dp" name="image" required/>
		</div>
			
			
			<div style="float: right;">
			
			<input type="submit" class="btn btn-success" value="Register" name="register">
		
			</div>
		
		</div>
		
	</form>
	</div>
	
	
	
	<?PHP footer(); ?>
	
	
	
</body>

</html>