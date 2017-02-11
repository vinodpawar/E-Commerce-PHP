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
          <a href="" class="navbar-brand">E-Commerce Site</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">All Products <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="../default/">Default</a></li>
                <li class="divider"></li>
                <li><a href="../cerulean/">Cerulean</a></li>
                <li><a href="../cosmo/">Cosmo</a></li>
                <li><a href="../cyborg/">Cyborg</a></li>
                <li><a href="../darkly/">Darkly</a></li>
                <li><a href="../flatly/">Flatly</a></li>
                <li><a href="../journal/">Journal</a></li>
                <li><a href="../lumen/">Lumen</a></li>
                <li><a href="../paper/">Paper</a></li>
                <li><a href="../readable/">Readable</a></li>
                <li><a href="../sandstone/">Sandstone</a></li>
                <li><a href="../simplex/">Simplex</a></li>
                <li><a href="../slate/">Slate</a></li>
                <li><a href="../spacelab/">Spacelab</a></li>
                <li><a href="../superhero/">Superhero</a></li>
                <li><a href="../united/">United</a></li>
                <li><a href="../yeti/">Yeti</a></li>
              </ul>
            </li>
            
			<li>
              <a href="">Track Order</a>
            </li>
            
		
			
			<li>
              <a href="cart.php">Shopping Cart (1)</a>
            </li>
			
			<li>
              <a href=""></a>
            </li>
			
			
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, Vinod Pawar</a></li>
            <li><a href="#">Logout</a></li>
          </ul>

        </div>
      </div>
	  
    </div>
	
	</div>
	
	
<div class="container alert alert-success">

    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>1 Item(s) is added to Cart!</strong> <a href="cart.php" class="alert-link">View Cart</a>
	
	
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