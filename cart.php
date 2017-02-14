<?PHP

include("functions/functions.php");

if(isset($_POST['continueShopping'])) {
	
	echo "<script>window.open('index.php','_self');</script>";
	
}

if(isset($_POST['checkOut'])) {
	
	if(isset($_SESSION['user'])) {
	
	echo "<script>window.open('./customer/checkout.php','_self');</script>";
	
	}
	
	else {
		
		echo "<script>window.open('./customer/login.php','_self');</script>";
	}
	
}

	
	
	if(isset($_POST['remove'])) {
		
		global $con;
	
		global $pro_id;
	
		$ip = getIp();
		
		$pro_id_delete = $_POST['hidden'];
		
		$delete_product = "delete from cart where p_id='$pro_id_delete' AND ip_add='$ip'";
				
		$run_delete = mysqli_query($con, $delete_product);
							
		if($run_delete) {
		
			echo "<script>window.alert('Are you sure?')</script>";
			
		
		}
		
		
		
	}
	

if(isset($_POST['noQuantity'])) {
	
	global $con;
	
	global $single_price;
	
	$pro_id_update = $_POST['hidden'];
	
	$noQuantity = $_POST['noQuantity'];
	
	
	$selectPriceQueryC = "select product_price from products where product_id = '$pro_id_update' LIMIT 1";
			
	$selectPriceQueryResultC = mysqli_query($con,$selectPriceQueryC);
			
	while($selectPriceQueryRowC = mysqli_fetch_array($selectPriceQueryResultC)) {
				
		$selectPriceQueryRC = $selectPriceQueryRowC['product_price'];
	
	}
	
	$single_price = $selectPriceQueryRC;
	
	$single_price = $single_price * $noQuantity;
	
	$updateChangedQtyQuery = "UPDATE cart SET qty = '$noQuantity', total_price = '$single_price' WHERE p_id = '$pro_id_update'";
	
	$updateChangedQtyQueryResult = mysqli_query($con, $updateChangedQtyQuery);
	
	
	
	
	
	if($updateChangedQtyQueryResult) {
		
		echo "<script>window.open('cart.php','_self')</script>";
	}
	
	
	
	}




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
		  
		  
        <?PHP
		  	
			isLoggedInNav();
			
		?>

        </div>
      </div>
	  
    </div>
	
	
	
	

<div class="container row">
	
	<div class="col-md-4">
	
		<ul style="list-style:none;text-align:center;font-size:22px;" >
		
			<li><h2>Categories</h2></li>
			<?PHP getCats(); ?>
			
			<li><h2>Brands</h2></li>
			<?PHP getBrands(); ?>
			
		</ul>
	</div>
	
	<?PHP getIp(); ?>
	
	
	
	<div class="col-md-8">
	
		<h3>Cart details</h3>
		<hr  style="border-width: 2px;"/>
	
		 <table class="table table-hover text-center">
    <thead>
      <tr>
		<th>Sr no.</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total</th>
		<th>Remove</th>
      </tr>
    </thead>
	
	<tbody>
	
	<?PHP
	
	// displaying all products added from cart on cart.php
	
	$sr = 0;
	
	
	
	$total = 0;
	
	global $con;
	
	$ip = getIp();
	
	$select_name = 0;
	
	$select_price = "select * from cart where ip_add='$ip'";
	
	$run_price = mysqli_query($con, $select_price);
	
	while($p_price = mysqli_fetch_array($run_price)){
		
		?>	
	
		<form action="cart.php" method="POST">
		
		<?PHP
		
		$pro_id = $p_price['p_id'];
		
		$pro_price = "select * from products where product_id='$pro_id'";
		
		$run_pro_price = mysqli_query($con, $pro_price);
			
		while($pp_price = mysqli_fetch_array($run_pro_price)) {	
			
			$product_name = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image'];
			
			$single_price = $pp_price['product_price'];	

	?>
	
				<tr  align="center">
				
					<td>
					
						<?PHP echo $sr += 1 . "." ; ?>
					
					</td>
				
					<td>
					
						<img src="admin/product_images/<?PHP echo $product_image ?>" width="60" height="60"/><br><br>
						<?PHP echo $product_name ?>
					
					</td>
		
					<td>
					
					<?PHP
					
					global $con;
					
					global $pro_id;
	
					$ip = getIp();
					
					$selectQuantityQuery = "SELECT qty FROM cart WHERE p_id = '$pro_id' AND ip_add = '$ip'";					
					$selectQuantity = mysqli_query($con, $selectQuantityQuery);
					
					$quantityI = mysqli_fetch_array($selectQuantity);
					
					$quantity = $quantityI['qty'];
					
					?>
					
					
						<select onChange="this.form.submit()" name="noQuantity">
							
							<option <?PHP if($quantity == '1') echo "selected"; ?> value="1">1</option>						
							<option <?PHP if($quantity == '2') echo "selected"; ?> value="2">2</option>
							<option <?PHP if($quantity == '3') echo "selected"; ?> value="3">3</option>
							<option <?PHP if($quantity == '4') echo "selected"; ?> value="4">4</option>
							
						</select>
					
					</td>
					
					<input type="hidden" name="hidden" value="<?PHP echo $pro_id; ?>">
					
					<?PHP
			
					}
			
					?>
					
				    <td>
					
					<?PHP 
					
					
					
					global $con;
					
					global $pro_id;
						
					$selectPriceQuery = "select total_price from cart where p_id = '$pro_id'";
			
					$selectPriceQueryResult = mysqli_query($con,$selectPriceQuery);
			
					while($selectPriceQueryRow = mysqli_fetch_array($selectPriceQueryResult)) {
				
						$selectPriceQueryR = $selectPriceQueryRow['total_price'];
						
						$subTotal_product_priceU = array($selectPriceQueryRow['total_price']);
			
						$total_price_product = array_sum($subTotal_product_priceU);
			
						
			
					}
						
					echo "Rs. ".$selectPriceQueryR;
					
					
					
									
					
					?>
					
					</td>
					
					<td>
						<input type="submit" class="btn btn-danger" value="X" name="remove" />
					</td>
					
				</tr>
				
				</form>
				
				<?PHP }  ?>
	
		</table>
	

		
		<hr  style="border-width: 2px;"/>
	
		<div class="" style="text-align: right;">
			
			<h4>Sub total: <?PHP subTotal(); ?>
			
			<?PHP

			
					
						
			
			?>
			
			</h4>
		</div>	
	
		<hr style="border-width: 2px;"/>
		
		<form action="cart.php" method="POST">
		
			<div style="text-align: right;">
				<!--	<input type="submit" class="btn btn-danger" value="Update Cart" name="update_cart" /> -->
				<input type="submit" class="btn btn-primary" value="Continue Shopping" name="continueShopping" />
				<input type="submit" class="btn btn-success" value="Check Out" name="checkOut" />
			</div>
		
		</form>
		
	</div>
	
</div>


	

	<?PHP
	
	
	
	/*
		global $con;
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])) {
			
			foreach($_POST['remove'] as $remove_id) {
				
				$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
				
				$run_delete = mysqli_query($con, $delete_product);
				
				if($run_delete) {
					
					echo "<script>window.open('cart.php','_self')</script>";
				}
			}
			
	*/	
	
		
	
		
		
		
		
		

	?>

	
	<?PHP footer(); ?>
	
</body>

</html>