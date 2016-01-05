
<?php echo validation_errors(); 

echo $msg;
?>

<form action="<? echo base_url().'superman/createclass'; ?>" method="post" >

<input type="text" name="classname" placeholder="Class Name" required="true" />
<input type="submit" value="create" required="true" />

</form>