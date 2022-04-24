<?php


require('admin_top.inc.php');
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc	='';
$batch_id	='';
$m_date='';
$e_date	='';
$status='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_desc=$row['short_desc'];
		$batch_id=$row['batch_id'];
		$m_date=$row['m_date'];
		$e_date=$row['e_date'];
		$status=$row['status'];
	}else{
		header('location:admin_product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=get_safe_value($con,$_POST['categories_id']);
	$name=get_safe_value($con,$_POST['name']);
	$mrp=get_safe_value($con,$_POST['mrp']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$short_desc=get_safe_value($con,$_POST['short_desc']);
	$batch_id=get_safe_value($con,$_POST['batch_id']);
	$m_date=get_safe_value($con,$_POST['m_date']);
	$e_date=get_safe_value($con,$_POST['e_date']);
	
	$res=mysqli_query($con,"select * from product where name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="<p style='color:red;'>Product already exist </p>";
			}
		}else{
			$msg="<p style='color:red;'>Product already exist </p>";
		}
	}

	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$image);
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',batch_id='$batch_id',m_date='$m_date',e_date='$e_date',image='$image' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',batch_id='$batch_id',m_date='$m_date',e_date='$e_date' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$image);
			mysqli_query($con,"insert into product(categories_id,name,mrp,price,qty,short_desc,batch_id,m_date,e_date,status,image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$batch_id','$m_date','$e_date',1,'$image')");
		}
		header('location:admin_product.php');
		die(); 
	}
}
?>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($con,"select id,categories from categories order by categories asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="name" placeholder="Enter product name" class="form-control" required pattern="[a-zA-Z]{1}[a-zA-Z0-9\s\-]{1,25}" title="Enter correct product name." value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="number" name="mrp" placeholder="Enter product mrp" class="form-control" required pattern="[0-9]{1,5}" title="Enter Valid MRP between 1-99999" value="<?php echo $mrp?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="number" name="price" placeholder="Enter product price" class="form-control" required pattern="[0-9]{1,5}" title="Enter Valid Price between 1-99999" value="<?php echo $price?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="number" name="qty" placeholder="Enter qty" class="form-control" required pattern="[0-9]{1,4}" title="Enter qty between 1-9999" value="<?php echo $qty?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Batch Id</label>
									<input type="text" name="batch_id" placeholder="Enter BATCH NO" class="form-control" required pattern="[A-E]{1}[#]{1}[0-9]{6}" title="Enter valid batch id. eg:A#123456" value="<?php echo $batch_id?>">
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Manufactured date</label>
									<input type="date" name="m_date" id="mdate" placeholder="Enter product MFG date" class="form-control" required value="<?php echo $m_date?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Expiry date</label>
									<input type="date" name="e_date" id="edate" placeholder="Enter product EXP date" class="form-control" required value="<?php echo $e_date?>" onchange="checkDate('<?php echo $e_date?>')">
								</div>

								  <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('admin_footer.inc.php');
?>


<script>
	function checkDate(date){
		// oedate is original expiry date that is in the database
		var oedate = date;
		var mdate = document.getElementById("mdate").value;
		var edate = document.getElementById("edate").value;

		if(edate< mdate){
			alert("INVALID EXPIRY DATE");
			document.getElementById("edate").value = oedate;
		}
}
</script>

