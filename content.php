<?PHP

	include("functions/functions.php");

	
		
	
	
	
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
	
		
	
	
	
?>