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
	
	<div class="">
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

          <ul class="nav navbar-nav navbar-right">
            <li><a href="customer/account.php">Welcome, Vinod Pawar</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>

        </div>
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
		
		if(isset($_GET['search'])) {
			
		$search_query = $_GET['user_query'];
		
		global $con;
		
		$get_pro = "SELECT * FROM products where product_keywords like '%$search_query%'";
	
		$run_pro = mysqli_query($con ,$get_pro);
		
		$run_pro_count = mysqli_num_rows($run_pro);
		
		if($run_pro_count == 0) {
			
			echo "<h3><center>No results found!</center></h3>";
			exit();
		}
		
	
		while($row = mysqli_fetch_array($run_pro)){
		
			$pro_id = $row['product_id'];
			$pro_cat = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			
			echo "
		
			<div class='container col-md-3' align='center' style='padding-top: 20px;padding-bottom: 30px;'>
		
				<a href='details.php?pro_id=$pro_id'>
				<img src='admin/product_images/$pro_image' width='180' height='180' />
				<h3>$pro_title</h3>
				<p><b>Price: Rs.$pro_price</b></p>
				</a>
			
				<a href='index.php?pro_id=$pro_id'><input type='button' value='Add to Cart' class='btn btn-primary' /></a>
			
			</div>
			
			
			";
		
		
		}
		
		}
		
		?>
		
	</div>
	
	<?PHP footer(); ?>
	
</body>

</html>