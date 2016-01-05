<?php echo validation_errors(); 

echo $msg;
//`name``startdate``enddate``duration``maxattempt``passperc``viewans``corscore``testtype``incorscore`
?>

<form action="<? echo base_url().'tcc/create_test'; ?>" method="post">

<p><input type="text" name="name" placeholder="Name" required="true" ></p>
    <?php for($i=0;$i<sizeof($category);$i++){?>
   <p> <input type="checkbox" name="<? echo $category[$i]['id'];  ?>" value="1" ><? echo $category[$i]['name'];  ?></p>
<?} ?>
<p><input type="text" name="startdate" placeholder="Start Date" required="true" ></p>
<p><input type="text" name="enddate" placeholder="End Date" required="true" ></p>
<p><input type="text" name="duration" placeholder="Duration" required="true" ></p>
<p><input type="text" name="maxattempt" placeholder="Maximum Attempt" required="true" ></p>
<p><input type="text" name="passpercent" placeholder="Pass Percentage" required="true" ></p>
<p><input type="text" name="corscore" placeholder="Correct Score" required="true" ></p>
<p><input type="text" name="incorscore" placeholder="Incorrect Score" required="true" ></p>
<p><input type="submit" value="Create"  ></p>

</form>