<?PHP

include("functions/functions.php");

?>

<html>

<head>

<link rel="stylesheet" href="./styles/style.css" media="screen">
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
	<title>E-Commerce Site</title>

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
	
	<div class="container">
	
		<?PHP 
		
		if(isset($_GET['pro_id'])) {
			
		$product_id = $_GET['pro_id'];
		
		$get_pro = "SELECT * FROM products where product_id='$product_id'";
	
		$run_pro = mysqli_query($con,$get_pro);
	
		while($row = mysqli_fetch_array($run_pro)){
		
		$pro_id = $row['product_id'];	
		$pro_title = $row['product_title'];
		$pro_price = $row['product_price'];
		$pro_image = $row['product_image'];
		$pro_desc = $row['product_desc'];
		
		
		echo "
		
		<div class='container col-md-8' align='center' style='padding-top: 20px;padding-bottom: 30px;'>
		
			
			<img src='admin/product_images/$pro_image' width='400' height='300' />
			<hr />
			<h3>$pro_title</h3>
			<p><b>Price: Rs.$pro_price</b></p>
			
			
			<a href='index.php'><input type='button' value='Home' class='btn btn-primary' /></a>
			
		</div>
			
			
		";
		
		
		}
	
		}
	
	?>
		
	</div>
	
	<hr />
	
	<div class="container" style="padding-bottom: 30px;">
	
		E-Commerce Site - 2017
	
	</div>
	
</body>

</html>