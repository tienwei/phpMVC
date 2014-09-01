<h1>Add Area</h1>
<form action="<?php echo URL; ?>help/saveArea" method="post">
    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <th>Postcode</th>
            <td><input type="text" maxlength="4" name="postcode"></td>
        </tr>
        <tr>
            <th>State</th>
            <td><input type="text" maxlength="3" name="state"></td>
        </tr>
        <tr>
            <th>Suburb</th>
            <td><input type="text" maxlength="20" name="suburb"></td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" value="Add"/></th>
        </tr>
    </table>
</form>    
<p class='centreSen'><a class="goBack" href="<?php echo URL;?>/index"> Go back</a></p>
