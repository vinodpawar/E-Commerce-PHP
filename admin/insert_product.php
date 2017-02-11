<?PHP

	include("includes/db.php");

?>

<html>

	<head>

		<link rel="stylesheet" href="../styles/style.css" media="screen">

	</head>

<body>
	
	<form action="insert_product.php" method="POST" enctype="multipart/form-data">
	
	
	
	<div class="container">
	
		<table>
		
			<tr>
				
				<td><h2>Insert new product here</h2></td>
				
			</tr>
			
			
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Title: </td>
				<td class="col-sm-6"><input type="text" name="product_title" required/></td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Category: </td>
				
				
				<td class="col-sm-6">
				
					<select name="product_cat">
					
					<option>Select a Category</option>
					
					<?PHP 
					
					$get_cats = 'select * from categories';
	
					$run_cats = mysqli_query($con,$get_cats);
	
					while($row_cats = mysqli_fetch_array($run_cats)) {		
					
						$cat_id = $row_cats['cat_id'];						
						
						$cat_title = $row_cats['cat_title'];
		
						echo "<option value='$cat_id'>$cat_title</option>";				
					
					}
					
					?>
					
					</select>
				
				</td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Brand: </td>
				
				<td class="col-sm-6">
				
				<select name="product_brand">
				
				<option>Select a brand</option>
				
				<?PHP
				
				$get_brand = 'select * from brands';

				$run_brand = mysqli_query($con,$get_brand);
				
				while($row_brand = mysqli_fetch_array($run_brand)) {
					
					$brand_id = $row_brand['brand_id'];
					
					$brand_title = $row_brand['brand_title'];
					
					echo "<option value='$brand_id'>$brand_title</option>";
					
				}
	
				
				?>
				
				</select>
				
				</td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Image: </td>
				<td class="col-sm-6"><input type="file" name="product_image" /></td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Price: </td>
				<td class="col-sm-6"><input type="text" name="product_price"  required/></td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Description: </td>
				<td class="col-sm-6"><textarea name="product_description" cols="20" rows="10"></textarea></td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right">Product Keywords: </td>
				<td class="col-sm-6"><input type="text" name="product_keywords"  required/></td>
				
			</tr>
			
			<tr >
				
				<td class="col-sm-6" align="right"></td>
				<td class="col-sm-6"><input type="Submit" name="submit" /></td>
				
			</tr>
		
		</table>
	
	</div>
	
	</form>

</body>

</html>


<?PHP

	if(isset($_POST['submit'])) {
		
		//getting text data from fields
		
		$product_title = $_POST['product_title'];
		
		$product_cat = $_POST['product_cat'];
		
		$product_brand = $_POST['product_brand'];
		
		$product_price = $_POST['product_price'];
		
		$product_description = $_POST['product_description'];
		
		$product_keywords = $_POST['product_keywords'];
		
		//getting image from the field
		
		$product_image = $_FILES['product_image']['name'];
		
		$product_image_temp = $_FILES['product_image']['tmp_name'];
								
		move_uploaded_file($product_image_temp,"product_images/$product_image");		
		
		$query = $insert_product = "insert into products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values('$product_cat','$product_brand','$product_title','$product_price','$product_description','$product_image','$product_keywords')";
		
		mysqli_query($con, $query);
		
		if($query) {
			
			echo "<script>alert('Data inserted successfully!')</script>";
			
			echo "<script>window.open('insert_product.php','_self')</script>";
			
			
			
		}
		
	}

?>