
<?php echo validation_errors(); 

echo $msg;
?>

<form action="<? echo base_url().'superman/login'; ?>" method="post">
	<input type="text" name="username"  placeholder="Username" required="true"> <br>
	<input type="password" name="password"  placeholder="Password" required="true"> <br>
	<input type="submit" value="Login">
</form>