<?php echo validation_errors();  ?>
<form action="#" method="post">

    <? for($i=0;$i<sizeof($questions);$i++){
   echo '<br>'.$questions[$i]['question'].'<br>'.$questions[$i]['description']; ?>
    <input type="radio" name="<? echo $questions[$i]['id']; ?>" value="1" ><? echo $questions[$i]['option1']; ?>
    <input type="radio" name="<? echo $questions[$i]['id']; ?>" value="2" ><? echo $questions[$i]['option2']; ?>
    <input type="radio" name="<? echo $questions[$i]['id']; ?>" value="3" ><? echo $questions[$i]['option3']; ?>
    <input type="radio" name="<? echo $questions[$i]['id']; ?>" value="4" ><? echo $questions[$i]['option4']; ?>
    <input type="hidden" name="qno" value="<? echo $questions[$i]['id']; ?>" required >
    
<?}  
    ?>
<br> <input type="submit" value="Submit" >
</form>