<table cellpadding="10" class="userTable">
    <tr>
        <td><a class='add_user' href="<?php echo URL;?>user/addUser">
        Add a system user</a></td>
    </tr>
    <tr>
        <td><a class="password" href="<?php echo URL;?>user/updatePassword/<?php echo Session::get('userID'); ?>">Change password</a></td>
    </tr>
</table>
<br/>
<p class="centreSen"><a class="goBack" href="<?php echo URL;?>index">Go Back</a></p>

