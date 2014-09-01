<form action="<?php echo URL;?>user/saveUser" method="post" onsubmit="return validateForm()">
    <input type="hidden" name="userID" value="<?php echo $this->userID;?>">
    <fieldset>
        <table class="userTable">
        <tr>
            <td><label for="password">Current Password: </label></th>
            <td><input type="password" id="currentPassword" name="currentPassword" value="" maxlength="20" /></td>
        <tr/>    
        <tr>
            <td><label for="password">New Password: </label></th>
            <td><input type="password" id="newPassword" name="newPassword" value="" maxlength="20" /></td>
        <tr/>
        <tr>
            <td><label for="newCheckPassword">Confirm New Password: </label></td>
            <td><input type="password" id="newCheckPassword" 
                       name="newCheckPassword" value="" maxlength="20" /></td>
        <tr/>
        <tr>
            <td colspan=""><input type="submit" value="Update" /></td>
        </tr>
        </table>
    </fieldset>
</form>
<br/>
<p class="centreSen"><a class="goBack" href="<?php echo URL;?>index">Go Back</a></p>
<script type="text/javascript">
    function validateForm() {
    var u = $('#currentPassword').val();
    var x = $('#newPassword').val();
    var y = $('#newCheckPassword').val();
    var msg ='';
    if(u==null || u==""){
        msg = "Current Password is compulsory. Please enete fill it\n";
    }  
    if (x == null || x == "") {
        msg += "Password is compulsory. Please enete fill it\n";
    }  
    if(x != y) {
        msg += "Password and confirm password do not match. Please try again";
    } 
    if(msg != '') { 
        alert(msg); 
        console.log('here');
        return false;
    } else{
        return true;
    };
}
</script>
