<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/dataTables.bootstrap.min.css">
<?php 
//echo "Akdam bakdam";
date_default_timezone_set("Europe/London");
global $wpdb;
$table_name =  'wp_add_property';
$results = $wpdb->get_results( "SELECT id,title,postcode,price,added_date,status,user_availability_status,lastupdatedtime FROM $table_name ORDER BY id DESC");
//echo "<pre>";print_r($results);
?>
<table width="100%" id="myTable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>S.no</th>
			<th>Title</th>
			<th>Postcode</th>
			<th>Rent</th>
			<th>Added Date</th>
			<th>Status</th>
			<th>User Availability Status</th>
			<th>Last Updated On</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php 
if(!empty($results)){
	$i = 1;
	foreach($results as $results){
?>
	<tr>
		<td style="text-align:center"><?php echo $i;?></td>
		<td style="text-align:center"><?php echo stripslashes($results->title);?></td>
		<td style="text-align:center"><?php echo stripslashes($results->postcode);?></td>
		<td style="text-align:center"><?php echo stripslashes($results->price);?></td>
		<td style="text-align:center"><?php echo $results->added_date;?></td>
		<?php 
		if($results->status == "t"){
		 $status = "<font color='green'>Active</font>";
		}else{
		 $status = "<font color='red'>Inactive</font>";	
		}
		?>
		<td style="text-align:center"><?php echo $status;?></td>
		<?php 
		if($results->user_availability_status == "t"){
		 $user_availability_status = "<font color='green'>Available</font>";
		}else{
		 $user_availability_status = "<font color='red'>Rented</font>";	
		}
		?>
		<td style="text-align:center"><?php echo $user_availability_status;?></td>
		<?php 
			if($results->lastupdatedtime > 0){
				$lastupdatedtime = date("d-m-Y h:i:s A",$results->lastupdatedtime);
			}else{
				$lastupdatedtime = "N/A";
			}
		?>
		<td style="text-align:center"><?php echo $lastupdatedtime;?></td>
		<?php 
		if($results->status == "t"){
		 $status1 = "<font color='red'>Disapprove</font>";
		}else{
		 $status1 = "<font color='green'>Approve</font>";
		}
		?>
		<td style="text-align:center"> <a href="<?php echo SITEURL;?>change_property_status.php?id=<?php echo $results->id;?>&status=<?php echo $results->status;?>"><?php echo $status1;?></a> | <a href="<?php echo SITEURL;?>property-whole-details.php?id=<?php echo $results->id;?>" rel="ibox&height=900&width=1024">View Property Details</a> | <a href='#' onClick="return deleteProperty('<?php echo $results->id;?>')">Delete</a> </td>
	</tr>
<?php
	++$i;
	}
}else{
?>
<tr><td colspan="7">No records found.</td></tr>
<?php
}
?>
</tbody>
</table>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/datatables.min.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/datatables-init.js"></script>
<script src="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/js/ibox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   //alert('hey');	
   //$('#bootstrap-data-table').DataTable();
   $('#myTable').DataTable();
});

function deleteProperty(id){
	if(id != ""){
		if(confirm("Are you sure to delete this property ?")){
			window.location.href = '<?php echo SITEURL?>delete_property.php?id='+id;
		}
	}
	return false;
}
</script>