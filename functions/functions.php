<?PHP

session_start();

// db connection and selection

$con = mysqli_connect("localhost","root","","ecomm");

if(mysqli_connect_errno()) {
	
	echo "Unable to connect to Database: ".mysqli_connect_error();
}


function isLoggedInNav() {
	
	if(isset($_SESSION['user'])) {
		
	$name = $_SESSION['user'];
	
	
	
	// echo $name;
			
	echo "
	
		<ul class='nav navbar-nav navbar-right'>
			<li><a href='/ecomm/customer/profile.php'>Welcome, ".$name."</a></li> 			
			<li><a href='/ecomm/customer/logout.php'>Logout</a></li> 			
        </ul>";
		
		
	}
	
	if(!isset($_SESSION['user'])) {
		
		echo "
	
		<ul class='nav navbar-nav navbar-right'>
			<li><a href='/ecomm/customer/login.php'>Login</a></li> 			
			<li><a href='/ecomm/customer/register.php'>Register</a></li>
        </ul>";
		
	}
}

// getting user IP

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
	
}

// function for profile

function profile() {
	
	if(isset($_SESSION['user'])) {
		
		global $con;
		
		$cust_id = $_SESSION['cust_id'];
		
		$profileQuery = "select * from customers where cust_id = '$cust_id'";
		
		$profileQueryResult = mysqli_query($con, $profileQuery);
		
		while($profileQueryResultRow = mysqli_fetch_array($profileQueryResult)) {
		
		$cust_name = $profileQueryResultRow['cust_name'];
		
		$cust_email = $profileQueryResultRow['cust_email'];
		
		$cust_country = $profileQueryResultRow['cust_country'];
		
		$cust_city = $profileQueryResultRow['cust_city'];
		
		$cust_image = $profileQueryResultRow['cust_image'];
		
		$cust_contact = $profileQueryResultRow['cust_contact'];
		
		echo "
			
			
			<table class = 'table table-hover text-center'>
				<tr>
					<td width='200'><h4><strong>Profile picture:</strong></h4></td>
					<td><img src='/ecomm/customer/images/".$cust_image."'  width='250' height='200' border='5' alt='Smiley face'></td>
				</tr>
				
				<tr>
					<td><h4><strong>Name:</strong></h4></td>
					<td><h4>". $cust_name . "</h4></td>
				</tr>
				
				<tr>
					<td><h4><strong>Email:</strong></h4></td>
					<td><h4>". $cust_email . "</h4></td>
				</tr>

				<tr>
					<td><h4><strong>City:</strong></h4></td>
					<td><h4>". $cust_city . "</h4></td>
				</tr>

				<tr>
					<td><h4><strong>Country:</strong></h4></td>
					<td><h4>". $cust_country . "</h4></td>
				</tr>				
				
				<tr>
					<td><h4><strong>Contact:</strong></h4></td>
					<td><h4>". $cust_contact . "</h4></td>
				</tr>				
				
				
				
				
			</table>
			
			
			
		";
		
		}
	}
	
	else {
		
		header('Location: ../index.php');
	}
		
	
}

// creating the Cart

function cart() {
	
	if(isset($_GET['addcart'])) {
			
			$pro_id = $_GET['addcart'];			
			
			global $con;
			$ip = getIp();
			$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
			
			$run_check = mysqli_query($con, $check_pro);
			
			// fetching product price
			
			$selectPriceQuery = "select product_price from products where product_id = '$pro_id' LIMIT 1";
			
			$selectPriceQueryResult = mysqli_query($con,$selectPriceQuery);
			
			while($selectPriceQueryRow = mysqli_fetch_array($selectPriceQueryResult)) {
				
				$selectPriceQueryR = $selectPriceQueryRow['product_price'];
			}
			
				
			if(mysqli_num_rows($run_check)>0) {
				
				echo "<script>window.alert('This product is already in the Cart! ')</script>";
			}
			
			else {
				
				$insert_pro = "insert into cart(p_id,ip_add,qty,total_price) values('$pro_id','$ip',1,'$selectPriceQueryR')";
				
				$run_pro = mysqli_query($con, $insert_pro);
				
				echo "<script>window.open('index.php','_self')</script>";
				
			} 
				
	}
	
	
}

// getting total added items

function totalItems() {
	
	if(isset($_GET['addcart'])) {
		
		global $con;
		
		$ip = getIp();
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
	
		echo $count_items;
		
		
		
	}
	
	else {
		
		global $con;
		
		$ip = getIp();
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
	
		echo $count_items;
	}
	
	
	
}

// getting price of all the items from cart

function totalPrice(){
	
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
			
			$values = array_sum($product_price);
			
			$total += $values;
		}
		
	}
	
	echo $total;
	
}



// Sidebar getting categories 

function getCats(){
	
	global $con;
	
	$get_cats = 'select * from categories';
	
	$run_cats = mysqli_query($con,$get_cats);
	
	while($row_cats = mysqli_fetch_array($run_cats)) {
		
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		
		echo "<li> <a href='index.php?cat=$cat_id'>$cat_title</a></li>";
		
		
	}
	
	
	
	
}


// Sidebar getting brands

function getBrands(){
	
	global $con;
	
	$get_brand = 'select * from brands';
	
	$run_brand = mysqli_query($con,$get_brand);
	
	while($row_brand = mysqli_fetch_array($run_brand)) {
		
		$brand_id = $row_brand['brand_id'];
		$brand_title = $row_brand['brand_title'];
		
		echo "<li> <a href='index.php?brand=$brand_id'>$brand_title</a></li>";
		
		
	}
	
	
}

// getting products

function getPro() {

// Showing all products. When no Category and Brand is selected.

	if(!isset($_GET['cat'])) {
		
		if(!isset($_GET['brand'])) {
		
	global $con;
	
	$get_pro = "SELECT * FROM products order by RAND() LIMIT 1,5";
	
	$run_pro = mysqli_query($con,$get_pro);
	
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
			
			<a href='index.php?addcart=$pro_id'><input type='button' value='Add to Cart' class='btn btn-primary' /></a>
			
		</div>
			
			
		";
		
		
	}
	
		}
	
	}
	
}

// Getting Products by Categories. 

function getCatPro() {

	if(isset($_GET['cat'])) {
		
		$cat_id = $_GET['cat'];
		
	global $con;
	
	$get_cat_pro = "SELECT * FROM products where product_cat='$cat_id'";
	
	$run_cat_pro = mysqli_query($con,$get_cat_pro);
	
	$run_cat_count = mysqli_num_rows($run_cat_pro);
	
	$get_cat_name = "SELECT * FROM categories where cat_id='$cat_id'";
	
	$result_cat_name = mysqli_query($con, $get_cat_name);
	
	while($row_result_cat_name = mysqli_fetch_array($result_cat_name)) {
		
		$row_result_cat_title = $row_result_cat_name['cat_title'];
	}
	
	if($run_cat_count == 0) {
		
		echo "<h1><center>There is no products in this category.</center></h1>
		
		<hr />
		
		<h4><center>You may try other products, <a href='allproducts.php'>Click Here</a> to see all the products.</center></h4>
		
		";
		
		
		
	}
	
	else {
	
	echo "<h3>Showing products under category: $row_result_cat_title</h3><hr style='border-width: 2px;'/>";
	
	while($row_cat = mysqli_fetch_array($run_cat_pro)){
		
		$pro_id = $row_cat['product_id'];
		$pro_cat = $row_cat['product_cat'];
		$pro_brand = $row_cat['product_brand'];
		$pro_title = $row_cat['product_title'];
		$pro_price = $row_cat['product_price'];
		$pro_image = $row_cat['product_image'];
		
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
	
	}
	
}

// Getting Brand.

function getBrandPro() {

	if(isset($_GET['brand'])) {
		
		$brand_id = $_GET['brand'];
		
	global $con;
	
	$get_brand_pro = "SELECT * FROM products where product_brand='$brand_id'";
	
	$run_brand_pro = mysqli_query($con,$get_brand_pro);
	
	$run_brand_count = mysqli_num_rows($run_brand_pro);
	
	
	$get_brand_name = "SELECT * FROM brands where brand_id='$brand_id'";
	
	$result_brand_name = mysqli_query($con, $get_brand_name);
	
	while($row_result_brand_name = mysqli_fetch_array($result_brand_name)) {
		
		$row_result_brand_title = $row_result_brand_name['brand_title'];
	}
	
	
	
	if($run_brand_count == 0) {
		
		echo "<h1><center>There is no products in this brand.</center></h1>
		
		<hr />
		
		<h4><center>You may try other products, <a href='allproducts.php'>Click Here</a> to see all the products.</center></h4>
		
		";
		
		
		
	}
	
	else {
	
	echo "<h3>Showing products under brand: $row_result_brand_title</h3><hr style='border-width: 2	px;'/>";
	
	
	while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){
		
		$proB_id = $row_brand_pro['product_id'];
		$proB_title = $row_brand_pro['product_title'];
		$proB_price = $row_brand_pro['product_price'];
		$proB_image = $row_brand_pro['product_image'];
		$proB_brand = $row_brand_pro['product_brand'];
		
		echo "
		
		
		
		<div class='container col-md-3' align='center' style='padding-top: 20px;padding-bottom: 30px;'>
		
		
			<a href='details.php?pro_id=$proB_id'>
			<img src='admin/product_images/$proB_image' width='180' height='180' />
			<h3>$proB_title</h3>
			<p><b>Price: Rs.$proB_price</b></p>
			</a>
			
			<a href='index.php?pro_id=$proB_id'><input type='button' value='Add to Cart' class='btn btn-primary' /></a>
			
		</div>
			
			
		";
		
		
	}
	
	}	
	
	}
	
}

function subTotal() {
	
	$ip = getIp();
	
	global $pro_id;
	
	global $con;
	
	$subTotalQuery = "SELECT SUM(total_price) AS TotalPriceSum FROM cart";
	
	$subTotalQueryResult = mysqli_query($con, $subTotalQuery);
	
	while($subTotalQueryResultRow = mysqli_fetch_array($subTotalQueryResult)) {
		
		$sub_total = $subTotalQueryResultRow['TotalPriceSum'];
		
	}
	
	echo "Rs. ".$sub_total;
	
}


function footer() {
	
	echo "
	
	<hr style='border-width: 3px;'/>
	
	<div class='container' style='padding-bottom: 10px;'>
	
		<a href=''>E-Commerce Site</a> - 2017
		
		<div style='float: right'>
			
			<ul style='list-style-type: none'>
				<li style='display: inline; padding-right: 20px;'><a href='sitemap.php'>Sitemap</a></li>
				<li style='display: inline; padding-right: 20px;'><a href='disclaimer.php'>Disclaimer</a></li>
				<li style='display: inline;'><a href='policy.php'>Return Policy</a></li>
		
		
		</div>
	
	</div>
	
	
	";
	
}

?>