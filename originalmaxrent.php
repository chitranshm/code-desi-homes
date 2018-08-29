<?php 
$val1 = $_POST['val1'];
?>
<option value="">Max Rent</option>
<?php
for($r=100;$r<=40000;$r++){
	?>
	<option value="<?php echo $r;?>" <?php if($val1 == $r){ echo "selected";}?>><?php echo $r;?></option>
	<?php
		if($r >= 100 && $r < 500){
			$r = $r+49;
		}
		if($r >= 500 && $r < 2000){
			$r = $r+99;
		}
		if($r >= 2000 && $r < 5000){
			$r = $r+499;
		}
		if($r >= 5000 && $r < 20000){
			$r = $r+999;
		}
		if($r >= 20000 && $r < 40000){
			$r = $r+4999;
		}
	}
?>