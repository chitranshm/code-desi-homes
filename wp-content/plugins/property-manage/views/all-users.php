<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/dashboardcss/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITEURL;?>wp-content/themes/responsive-childtheme-master/core/css/dataTables.bootstrap.min.css">
<?php 
//echo "Akdam bakdam";
global $wpdb;
$table_name =  'wp_register_users';
$results = $wpdb->get_results( "SELECT id,name,email,mobile,dob,status,added_date FROM $table_name ORDER BY id DESC");
//echo "<pre>";print_r($results);
?>
<table width="100%" id="myTable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style="text-align:center">S.no</th>
			<th style="text-align:center">Name</th>
			<th style="text-align:center">Email</th>
			<th style="text-align:center">Mobile</th>
			<!--<th>Date of Birth</th>-->
			<!--<th>Added Date</th>-->
			<th style="text-align:center">Status</th>
			<th style="text-align:center">Action</th>
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
		<td style="text-align:center"><?php echo stripslashes($results->name);?></td>
		<td style="text-align:center"><?php echo stripslashes($results->email);?></td>
		<td style="text-align:center"><?php echo stripslashes($results->mobile);?></td>
		<!--<td style="text-align:center"><?php echo stripslashes($results->dob);?></td>-->
		<!--<td style="text-align:center"><?php echo $results->added_date;?></td>-->
		<?php 
		if($results->status == "t"){
		 $status = "<font color='green'>Active</font>";
		}else{
		 $status = "<font color='red'>Inactive</font>";	
		}
		?>
		<td style="text-align:center"><a href="<?php echo SITEURL;?>change_user_status.php?id=<?php echo $results->id;?>&status=<?php echo $results->status;?>"><?php echo $status;?></a></td>
		<td style="text-align:center"><a href="<?php echo SITEURL;?>user-whole-details.php?id=<?php echo $results->id;?>" rel="ibox&height=900&width=1024">View User Details</a> | <a href='#' onClick="return deleteUser('<?php echo $results->id;?>')">Delete</a></td>
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

function deleteUser(id){
	if(id != ""){
		if(confirm("Are you sure to delete this user ?")){
			window.location.href = '<?php echo SITEURL?>delete_user.php?id='+id;
		}
	}
	return false;
}
</script>