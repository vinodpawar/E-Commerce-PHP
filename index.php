<?PHP

include("functions/functions.php");

?>

<html>

<head>

	<title>E-Commerce Site</title>
	<link rel="stylesheet" href="./styles/style.css" media="screen">
	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
	<script src="./styles/jquery.js" ></script>
	<script src="./styles/bootstrap.min.js" ></script>
	<script src="./styles/main.js" ></script>
	

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
		  
		  <?PHP isLoggedInNav(); ?>
          

        </div>
      </div>
	  
    </div>
	
	
	
	


	
	<div class="container col-md-3">
	
		<ul style="list-style:none;text-align:center;font-size:22px;" >
		
		<li><h2>Categories</h2></li>
		
		<div id="category">
		
		
		</div>
		
		<li><h2>Brands</h2></li>
		
		<div id="brand"></div>
		
		
			
			
			
			
			
			
		
			
		</ul>
	</div>
	
	<?PHP getIp(); ?>
	
	<div class="container">
	
	<div id="products"></div>
		
		
	</div>
	
	<?PHP footer(); ?>
	
	
	
</body>

</html>