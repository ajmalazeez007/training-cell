<a href="<? echo base_url().'user/logout'; ?>">LogOut</a>

<?

for($i=0;$i<sizeof($test);$i++){?>
    
    <form action="<? echo base_url().'user/dashboard'; ?>" method="post">

        <input type="hidden" name="<? echo $test[$i]['id']; ?>" required> Start date <? echo unix_to_human($test[$i]['startdate']).' End date'.unix_to_human($test[$i]['enddate']); ?> 
        <input type="submit" value="<? echo $test[$i]['name']; ?>" >
    </form>
<?}
?>