<?php echo validation_errors(); 

echo $msg;
?>

<form action="<? echo base_url().'tcc/create_category'; ?>" method="post">

<p><input type="text" name="name" placeholder="Name" required="true" ></p>

    <p><input type="radio" name="type" value="1" required="true" >Full</p>
    <p><input type="radio" name="type" value="2"  >Selected</p>
    
    <? for($i=0;$i<sizeof($users);$i++){ ?>
    
    <p>  <input type="checkbox" name="<? echo $users[$i]['id']  ?>" value="1"><? echo $users[$i]['name']  ?> </p>
<?}   ?>
    <p> <input type="submit" value="Create" > </p>
</form>