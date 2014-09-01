<h1>Add Customer</h1><br />
<form action="<?php echo URL ?>customer/register" onsubmit="return validateForm()" method="post" name="regForm" id="regForm">
    <table cellspacing="2" cellpadding="0" border="1">
        <tr>
            <th colspan="2">Customer Name:</th>
            <td colspan="4"><input type="text" name="customerName" maxlength="50"/></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td colspan="2"><input type="text" class="address" name="address" maxlength="40"/></td>
            <th>Suburb/State/Postcode:</th>
            <td  colspan="2">
                <select name="customerAreaInfo">
                    <option value='0'></option>
                    <?php foreach ($this->areaInfo as $area) {
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2].'>'.$area[0].'-'.$area[1].
                             '-'.$area[2].'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Contact Person:</th>
            <td colspan="2"><input type="text" name="contactPerson" maxlength="35"/></td>
            <th>Position:</th>
            <td colspan="2"><input type="text" name="contactPosition" maxlength="15"/></td>
        </tr>
        <tr>
            <th>Contact Telephone:</th>
            <td><input type="text" name="contactTelephone" maxlength="10"/></td>
            <th>Contact Mobile:</th>
            <td><input type="text" name="contactMobile" maxlength="10"/></td>
            <th>Contact Fax:</th>
            <td><input type="text" name="contactFax" maxlength="10"/></td>
        </tr>
        <tr>
            <th>Billing Address:</th>
            <td colspan="2"><input type="text" class="address" name="billingAddress" maxlength="40"/></td>
            <th>Billing Suburb/State/Postcode:</th>
            <td colspan="2">
                <select name="billingAreaInfo">
                    <option value='0'></option>
                    <?php foreach ($this->areaInfo as $area) {
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2].'>'.$area[0].'-'.$area[1].
                             '-'.$area[2].'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Agent:</th>
            <td colspan="2"><input type="text" name="agent" maxlength="35"/></td>
            <th>Agent Position:</th>
            <td colspan="2"><input type="text" name="agentPosition" maxlength="15"/></td>
        </tr>
        <tr>
            <th>Agent Telephone:</th>
            <td><input type="text" name="agentTelephone" maxlength="10"/></td>
            <th>Agent Mobile:</th>
            <td><input type="text" name="agentMobile" maxlength="10"/></td>
            <th>Agent Fax:</th>
            <td><input type="text" name="agentFax" maxlength="10"/></td>
        </tr>
        <tr>
            <th>Listing Address:</th>
            <td colspan="2"><input type="text" class="address" name="listingAddress" maxlength="40"/></td>
            <th>Listing Suburb/State/Postcode:</th>
            <td colspan="2">
                <select name="listingAreaInfo">
                    <option value='0'></option>
                    <?php foreach ($this->areaInfo as $area) {
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2].'>'.$area[0].'-'.$area[1].
                             '-'.$area[2].'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Listing Phone:</th>
            <td colspan="2"><input type="text" name="listingPhone" maxlength="10"/></td>
            <th>URL:</th>
            <td colspan="2"><input type="text" name="url" maxlength="100"/></td>
        </tr>
        <tr><td colspan="6"><input type="submit" value="Add" /></td></tr>
    </table>
</form>
<br/>
<p class='centreSen'><a class="goBack" href="javascript:history.go(-1)"> Go back</a></p>
<script type="text/javascript">
    function validateForm() {
    var x = document.forms["regForm"]["customerName"].value;
    if (x == null || x == "") {
        alert("Customer name must be filled out");
        return false;
    }
}
</script>
