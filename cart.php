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
            <li><a href="customer/account.php">Welcome, Vinod Pawar</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>

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
	
	<form action="cart.php" method="POST">
	
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
	
	$sr = 0;
	
	$sub_total = 0;
	
	$total = 0;
	
	global $con;
	
	$ip = getIp();
	
	$select_price = "select * from cart where ip_add='$ip'";
	
	$run_price = mysqli_query($con, $select_price);
	
	while($p_price = mysqli_fetch_array($run_price)){
		
		$pro_id = $p_price['p_id'];
		
		$pro_price = "select * from products where product_id='$pro_id'";
		
		$run_pro_price = mysqli_query($con, $pro_price);
			
		while($pp_price = mysqli_fetch_array($run_pro_price)) {
			
			$product_price = array($pp_price['product_price']);
			
			$product_name = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image'];
			
			$single_price = $pp_price['product_price'];	

			$total_price = array_sum($product_price);
			
			$sub_total += $total_price;
		
		
	
	
	?>
	
	  
				<tr  align="center">
				
					<td><?PHP echo $sr += 1 . "." ; ?></td>
				
					<td>
					
					<img src="admin/product_images/<?PHP echo $product_image ?>" width="60" height="60"/><br><br>
					<?PHP echo $product_name ?>
					
					</td>
					<td>
					
					<select style="width: 40px;" name="qty" onchange="this.form.submit()">	
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					
					</td>
				    <td><?PHP echo "Rs.".$single_price; ?></td>
					<td><input type="checkbox" name="remove[]" value="<?PHP echo $pro_id; ?>" /></td>
					
					
					
				</tr>
				
				
				
	<?PHP } } ?>
	
	
	
    
  </table>
		<hr  style="border-width: 2px;"/>
	
		<div class="" style="text-align: right;">
			<h4>Sub total: <?PHP echo "Rs.".$sub_total; ?></h4>
		</div>	
	
		<hr style="border-width: 2px;"/>
		
		<div style="text-align: right;">
			<input type="submit" class="btn btn-danger" value="Update Cart" name="update_cart"/>
			<input type="submit" class="btn btn-primary" value="Continue Shopping" />
			<input type="submit" class="btn btn-success" value="Check Out" href="checkout.php" />
		</div>
			
		
	
		
		
	</div>
</div>
</form>

	<?PHP
	
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
			
		
		}
		
		if(isset($_POST['qty'])) {
			
			$qty = $_POST['qty'];
			
			$update_cart_query = "update cart set qty='$qty' where ip_add='$ip'";
			
			$update_cart_query_result = mysqli_query($con, $update_cart_query);
			
			
			
		}
		

	?>

	
	<?PHP footer(); ?>
	
</body>

</html>