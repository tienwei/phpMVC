
<h2><img src="<?php echo URL?>public/images/database.png" height="48px" width="48px"/> 
        <?php echo ' CBD'. Session::get('dbYear'); ?></h2>
<br />
<form action="login/authenticate" method="post" >
    <table border="1" cellpadding="5">
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" id="username" name="username" value="" maxlength="20" /></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" id="password" name="password" value="" maxlength="20" /></td>
        </tr>
        <tr>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
            <td colspan="2"><input type="submit" value="&rarr; Login" /></td>
        </tr>
    </table>
</form>
<br />
<p><a href='<?php echo URL;?>'><img src="
    <?php echo URL?>public/images/database-switch.png" 
    height="32px" width="32px"/> Click to Switch The Database</a></p>