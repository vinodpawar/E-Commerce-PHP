<?PHP

include("functions/functions.php");

if(isset($_POST["category"])) {

	global $con;
	
	$get_cats = 'select * from categories';
	
	$run_cats = mysqli_query($con,$get_cats);
	
	while($row_cats = mysqli_fetch_array($run_cats)) {
		
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		
		echo "<li><a href='#' class='category' cid='$cat_id'>$cat_title</a></li>";
		
		
	}

}

	if(isset($_POST['brand'])) {

	global $con;
	
	$get_brand = 'select * from brands';
	
	$run_brand = mysqli_query($con,$get_brand);
	
	while($row_brand = mysqli_fetch_array($run_brand)) {
		
		$brand_id = $row_brand['brand_id'];
		$brand_title = $row_brand['brand_title'];
		
		echo "<li id='$brand_id'>$brand_title</a></li>";
		
		
	}
	
	}
	
	if(isset($_POST['products'])) { 
	
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
			
			<a href='index.php?addcart=$pro_id'><input type='submit' value='Add to Cart' class='btn btn-primary' name='addcart' /></a>
			
			</div>
			
			
			";
		
		
			}
	
		}

?>