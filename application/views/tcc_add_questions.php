<?php echo validation_errors(); 

//echo $msg;
//SELECT * FROM `quizquestions` WHERE 1  `qqid``tid``question``description``option1``option2``option3``option4``ans`
?>


<form action="<? echo base_url().'tcc/add_questions'; ?>" method="post">

<p><input type="hidden" name="test" value="<? echo $this->session->testid;  ?>" required="true" ></p>
<p>Question<input type="text" name="question" placeholder="Question" required="true" ></p>
<p>Description<input type="text" name="description" placeholder="Description"  ></p>
<p>Option 1<input type="text" name="option1" placeholder="Option 1" required="true" ></p>
<p>Option 2<input type="text" name="option2" placeholder="Option 2" required="true" ></p>
<p>Option 3<input type="text" name="option3" placeholder="Option 3" required="true" ></p>
<p>Option 4<input type="text" name="option4" placeholder="Option 4" required="true" ></p>
<p><input type="radio" name="ans" value="1" required="true" >Option 1</p>
<p><input type="radio" name="ans" value="2"  >Option 2</p>
<p><input type="radio" name="ans" value="3"  >Option 3</p>
<p><input type="radio" name="ans" value="4"  >Option 4</p>
<p><input type="submit"  value="Add"  > </p>
    
</form>