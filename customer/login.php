<?PHP

include("../functions/functions.php");

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

			<?PHP cart(); ?>			
	
			<li>
              <a href="cart.php">Shopping Cart (<?PHP totalItems(); ?>)</a>
            </li>
			
			<li>
              <a href="#"></a>
            </li>
            
			<li>
              <a href="#"></a>
            </li>
			
        </ul>

		<div class="col-sm-4 col-md-4">
			<form class="navbar-form" role="search" action="result.php">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="user_query">
				
						<div class="input-group-btn">
						
							<button class="btn btn-success" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i></button>
						
						</div>
				</div>
			</form>
		</div>
		  
		  
          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php">Login</a></li>
            
          </ul>

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
	
	
	
	<div class="col-md-9" style="padding-bottom: 300px;">
	
	<form action="login.php" method="POST">
	
		<div class="col-md-8">
		<h3>Login:</h3>
		<hr style='border-width: 2px;'/>
		<div class="form-group">
		<label for="usr">Email:</label>
		<input type="text" class="form-control" id="usr" name="email" placeholder="username@domain.com">
		</div>
		
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="password" name="password">
		</div>
		
		
		
			<a href="#">Forget password?</a>
			
			<div style="float: right;">
			
			<input type="submit" class="btn btn-success" value="Login">
		
			</div>
		
		</div>
		
	</form>
	</div>
	
	
	
	<?PHP footer(); ?>
	
	
	
</body>

</html>