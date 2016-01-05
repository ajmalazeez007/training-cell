<?
for($i=0;$i<sizeof($test);$i++){?>
    
    <form action="<? echo base_url().'tcc/select_test'; ?>" method="post">
<input type="hidden" name="test" value="<? echo $test[$i]['id']; ?>" required>
<input type="submit"  value="<? echo $test[$i]['name']; ?>" required>
</form>
<?}

?>
