
<?php echo validation_errors(); 

echo $msg;
?>
<form action="<? echo base_url().'user/signup'; ?>" method="post">
    
  <p>  <input type="text" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>"  required="true" > </p>
  <p>  <input type="email" name="emailid" placeholder="Email Id" value="<?php echo set_value('emailid'); ?>"  required="true" > </p>
  <p>  <input type="password" name="password" placeholder="Password"   required="true" > </p>
  <p>  <input type="password" name="cpassword" placeholder="Confirm password"   required="true" > </p>
  <p>  <? echo form_dropdown('class', $class); ?> </p>
  <p>  <input type="submit" value="SignUp"   > </p>

</form>