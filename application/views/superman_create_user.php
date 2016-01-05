
<?php echo validation_errors(); 

echo $msg;
?>

<form action="<? echo base_url().'superman/createtco'; ?>" method="post" >

<input type="text" name="name" placeholder="Name" required="true" />
<input type="text" name="email" placeholder="Email Id" required="true" />
<? echo form_dropdown('class', $class); ?>
<input type="submit" value="create" required="true" />

</form>