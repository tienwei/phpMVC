<form action="<?php echo URL;?>user/saveUser" method="post" 
      onsubmit="return validateForm()">
    <fieldset>
        <table class="userTable">
        <tr>
            <td><label for="username">Username: </label></td>
            <td><input type="text" id="newUsername" name="newUsername" value="" maxlength="20" /></td>
        <tr/>
        <tr>
            <td><label for="password">Password: </label></th>
            <td><input type="password" id="newPassword" name="newPassword" value="" maxlength="20" /></td>
        <tr/>
        <tr>
            <td><label for="newCheckPassword">Confirm Password: </label></td>
            <td><input type="password" id="newCheckPassword" 
                       name="newCheckPassword" value="" maxlength="20" /></td>
        <tr/>
        <tr>
            <td colspan="2"><input type="submit" value="Add" /></td>
        </tr>
        </table>
    </fieldset>
</form>
<br/>
<p class="centreSen"><a class="goBack" href="<?php echo URL;?>index">Go Back</a></p>
<script type="text/javascript">
    function validateForm() {
    var u = $('#newUsername').val();
    var x = $('#newPassword').val();
    var y = $('#newCheckPassword').val();
    var msg ='';
    if(u==null || u==""){
        msg = "Username is compulsory. Please enete fill it\n";
    }  
    if (x == null || x == "") {
        msg += "Password is compulsory. Please enete fill it\n";
    }  
    if(x != y) {
        msg += "Password and confirm password do not match. Please try again";
    } 
    if(msg != '') { alert(msg); return false;} else{return true};
}
</script>