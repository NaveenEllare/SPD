<?php
require('admin_top.inc.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from users where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

if(isset($_GET['op']) && $_GET['op']!=''){
	if($_GET['op'] == 'cancel'){
		$oid = get_safe_value($con,$_GET['id']);
		$update = mysqli_query($con,"update oder set order_status='Cancelled' where o_id='$oid'");
	}
	if($_GET['op'] == 'ship'){
		$oid = get_safe_value($con,$_GET['id']);
		$update = mysqli_query($con,"update oder set order_status='Success' where o_id='$oid'");
	}
}

$sql="select * from oder";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order details </h4>
				  
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">SL NO</th>
							   <th>Client ID</th>
							   <th>Order ID</th>
							   <th>Address</th>
							   <th>Total</th>
							   <th>Order Status</th>
                               <th>Added On</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=0;
							while($row=mysqli_fetch_assoc($res)){$i++;?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['client_id']?></td>
							   <td><?php echo $row['o_id']?></td>
							   <td><?php echo $row['address']?></td>
							   <td><?php echo $row['total']?></td>
							   <td><?php
								   if($row['order_status']=='Success') {
										echo '<span style="color:green">'.$row['order_status'].'</span>';
								   } else if($row['order_status']=='Cancelled') {
										echo '<span style="color:red">'.$row['order_status'].'</span>';
							  	   } else {
									 	echo $row['order_status'];
								   } 
								   ?>
							   </td>
                               <td><?php echo $row['added_on']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-info'><a href='invoice.php?client=".$row['client_id']."&id=".$row['o_id']."'>Invoice</a></span>&nbsp;&nbsp;&nbsp;&nbsp;";
								if($row['order_status'] == 'pending') {
									echo "<span class='badge badge-delete'><a href='?op=cancel&id=".$row['o_id']."'>Cancel</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								}
								if($row['order_status'] == 'pending') {
									echo "<span class='badge badge-success'><a href='?op=ship&id=".$row['o_id']."'>Ship</a></span>";
								}else {
									echo "<span class='badge badge-info'>Ship</span>";
								}
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