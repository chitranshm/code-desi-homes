<?php 
$val = $_POST['val'];
$val1 = $_POST['val1'];
if($val != ""){
?>
	<option value="">Max Bedrooms</option>
	<?php
	for($i=$val;$i<=5;$i++){
		?>
		<option value="<?php echo $i;?>" <?php if($val1 == $i){ echo "selected";}?>><?php echo $i;?></option>
		<?php
	}
}
?>