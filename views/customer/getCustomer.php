<h1>Update Customer</h1><br />
<form action= "<?php echo URL ?>customer/updateCustomer" method="post">
    <input type="hidden" name="customerName" maxlength="50"
                    value="<?php echo $this->customer['Customer Name']?>"/>
    <table class="customerInfoTable" border="1">
        <tr>
            <th>Customer Name:</th>
            <td colspan="5"><?php echo $this->customer['Customer Name']?></td>
        </tr>   
        <tr>
            <th>Address:</th>
            <td colspan="2"><input type="text" class="address" name="address" maxlength="40"
                    value="<?php echo $this->customer['Address']?>"/></td>
            <th>Suburb/State/Postcode:</th>
            <td colspan="2"><?php 
            $suburb =  preg_replace('/[^A-Za-z0-9\-]/', '', 
                    $this->customer['Suburb']); ?>
                <select name="customerAreaInfo">
                    <option value='0'></option>
                    <?php 
                    foreach ($this->areaInfo as $area) {
                       
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2]; 
                            if(strcmp(str_replace(array(' ','&nbsp;'), '', $area[0]), trim($suburb))==0) {
                                echo ' selected=selected;>';}
                            else echo'>'; 
                            echo $area[0].'-'.$area[1].'-'.$area[2];'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Contact Person:</th>
            <td colspan="2"><input type="text" name="contactPerson" maxlength="35" 
                    value="<?php echo $this->customer['Contact Person']?>"/></td>
            <th>Position:</th>
            <td colspan="2"><input type="text" name="contactPosition" maxlength="15"
                    value="<?php echo $this->customer['Position']?>"/></td>
        </tr> 
        <tr>
            <th>Contact Telephone:</th>
            <td><input type="text" name="contactTelephone" maxlength="10"
                    value="<?php echo $this->customer['Contact Telephone']?>"/></td>
            <th>Contact Mobile:</th>
            <td><input type="text" name="contactMobile" maxlength="10"
                       value="<?php echo $this->customer['Contact Mobile']?>"/></td>
            <th>Contact Fax:</th>
            <td><input type="text" name="contactFax" maxlength="10"
                       value="<?php echo $this->customer['Contact Fax']?>"/></td>
        </tr>
        <tr>
            <th>Billing Address:</th>
            <td colspan="2"><input type="text" class="address" name="billingAddress" maxlength="40"
                       value="<?php echo $this->customer['Billing Address']?>"/></td>
            <th>Billing Suburb/State/Postcode:</th>
            <td colspan="2"><?php 
            $billingSuburb = preg_replace('/[^A-Za-z0-9\-]/', '', 
                    $this->customer['Billing Suburb']); ?>
                <select name="billingAreaInfo">
                    <option value='0'></option>
                    <?php 
                    foreach ($this->areaInfo as $area) {
                       
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2]; 
                            if(strcmp(str_replace(array(' ','&nbsp;'), '',
                                $area[0]), trim($billingSuburb))==0) {
                                echo ' selected=selected;>';}
                            else echo'>'; 
                            echo $area[0].'-'.$area[1].'-'.$area[2];'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Agent:</th>
            <td colspan="2"><input type="text" name="agent" maxlength="35"
                       value="<?php echo $this->customer['Agent']?>"/></td>
            <th>Agent Position:</th>
            <td colspan="2"><input type="text" name="agentPosition" maxlength="15"
                       value="<?php echo $this->customer['Agent Position']?>"/></td>
        </tr>
        <tr>
            <th>Agent Telephone:</th>
            <td><input type="text" name="agentTelephone" maxlength="10"
                       value="<?php echo $this->customer['Agent Phone']?>"/></td>
            <th>Agent Mobile:</th>
            <td><input type="text" name="agentMobile" maxlength="10"
                       value="<?php echo $this->customer['Agent Mobile']?>"/></td>
            <th>Agent Fax:</th>
            <td><input type="text" name="agentFax" maxlength="10"
                       value="<?php echo $this->customer['Agent Fax']?>"/></td>
        </tr>
        <tr>
            <th>Listing Address:</th>
            <td colspan="2"><input type="text" class="address" name="listingAddress" maxlength="40"
                       value="<?php echo $this->customer['Listing Address']?>"/></td>
            <th>Listing Suburb/State/Postcode:</th>
            <td colspan="2"><?php 
            $listingSuburb =  preg_replace('/[^A-Za-z0-9\-]/', '', 
                    $this->customer['Listing Suburb']); ?>
                <select name="listingAreaInfo">
                    <option value='0'></option>
                    <?php 
                    foreach ($this->areaInfo as $area) {
                       
                        echo '<option value='.str_replace(' ', '&nbsp;', $area[0]).
                             '-'.$area[1].'-'.$area[2]; 
                            if(strcmp(str_replace(array(' ','&nbsp;'), '',
                                $area[0]), trim($listingSuburb))==0) {
                                echo ' selected=selected;>';}
                            else echo'>'; 
                            echo $area[0].'-'.$area[1].'-'.$area[2];'</option>';
                    } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Listing Phone:</th>
            <td colspan="2"><input type="text" name="listingPhone" maxlength="10"
                       value="<?php echo $this->customer['Listing Phone']?>"/></td>
            <th>URL:</th>
            <td colspan="2"><input type="text" name="url" maxlength="100"
                       value="<?php echo $this->customer['URL']?>"/></td>
        </tr>
        <tr>
            <th colspan="6" align="center">
                <input type="submit" value="Update">
            </th>
        </tr>
    </table>    
</form>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
