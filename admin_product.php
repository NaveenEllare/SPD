<?php
require('admin_top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}




$sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.qty Asc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="box-link"><a href="admin_manage_product.php">Add Product</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">S_no</th>
							   <th>ID</th>
							   <th>Categories</th>
							   <th>Name</th>
							  
							   <th>MRP</th>

							   <th>Expiry date</th>
							   <th>Qty</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=0;
							while($row=mysqli_fetch_assoc($res)){
							$stat = $row['status'];
							$i++;
							?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['price']?></td>

							   <td><?php 
							   $date1=date_create($row['e_date']);
							   $date2=date_create(date("Y-m-d"));
							   $diff=date_diff($date2,$date1);
							   $diff_d = $diff->format("%R%a");
							   if($diff_d < 0) {
								$prod_id= $row['id'];
								$stat = 0;
								$update="update product set status='$stat' where id='$prod_id'";
								mysqli_query($con,$update);
								echo "<p style='color:red;'><b>" . "Expired" . "</p></b>";
							   } else if($diff_d <= +90){
							   	echo "<p style='color:blue;'><b>" . "Expiring Soon" . "</p></b>";
							   }else {
								echo $row['e_date'];
							   }
								?></td>


							   <td><?php echo $row['qty']?></td>
							   <td>
								<?php
								if($stat==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='admin_manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('admin_footer.inc.php');
?>