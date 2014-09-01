<h1>Customer Information</h1><br />

<table class="customerInfoTable" border="1" cellspacing='5' cellpadding='5' width='900'>
    <tr>
        <th>Customer Name:</th>
        <td colspan="5"><?php echo $this->customer['Customer Name'] ?></td>
    </tr>   
    <tr>
        <th>Address:</th>
        <td colspan="2"><?php echo $this->customer['Address'] ?></td>
        <th>Postcode:</th>
        <td colspan="2"><?php echo $this->customer['Post Code']; ?>
        </td>
    </tr>
    <tr>
        <th>State</th>
        <td colspan="2"><?php echo $this->customer['State']; ?></td>
        <th>Suburb</th>
        <td colspan="2"><?php echo $this->customer['Suburb']; ?></td>
    </tr>
    <tr>
        <th>Contact Person:</th>
        <td colspan="2"><?php echo $this->customer['Contact Person'] ?></td>
        <th>Position:</th>
        <td colspan="2"><?php echo $this->customer['Position'] ?></td>
    </tr> 
    <tr>
        <th>Contact Telephone:</th>
        <td><?php echo $this->customer['Contact Telephone'] ?></td>
        <th>Contact Mobile:</th>
        <td><?php echo $this->customer['Contact Mobile'] ?></td>
        <th>Contact Fax:</th>
        <td><?php echo $this->customer['Contact Fax'] ?></td>
    </tr>
    <tr>
        <th>Billing Address:</th>
        <td colspan="2"><?php echo $this->customer['Billing Address'] ?></td>
        <th>Billing Postcode:</th>
        <td colspan="2"><?php echo $this->customer['Billing Post Code']; ?>
        </td>
    </tr>
    <tr>
        <th>Billing State</th>
        <td colspan="2"><?php echo $this->customer['Billing State']; ?></td>
        <th>Billing Suburb</th>
        <td colspan="2"><?php echo $this->customer['Billing Suburb']; ?></td>
    </tr>
    <tr>
        <th>Agent:</th>
        <td colspan="2"><?php echo $this->customer['Agent'] ?></td>
        <th>Agent Position:</th>
        <td colspan="2"><?php echo $this->customer['Agent Position'] ?></td>
    </tr>
    <tr>
        <th>Agent Telephone:</th>
        <td><?php echo $this->customer['Agent Phone'] ?></td>
        <th>Agent Mobile:</th>
        <td><?php echo $this->customer['Agent Mobile'] ?></td>
        <th>Agent Fax:</th>
        <td><?php echo $this->customer['Agent Fax'] ?></td>
    </tr>
    <tr>
        <th>Listing Address:</th>
        <td colspan="2"><?php echo $this->customer['Listing Address'] ?></td>
        <th>Listing Postcode:</th>
        <td colspan="2"><?php echo $this->customer['Listing Post Code']; ?>
        </td>
    </tr>
    <tr>
        <th>Listing State</th>
        <td colspan="2"><?php echo $this->customer['Listing State']; ?></td>
        <th>Listing Suburb</th>
        <td colspan="2"><?php echo $this->customer['Listing Suburb']; ?></td>
    </tr>
    <tr>
        <th>Listing Phone:</th>
        <td colspan="2"><?php echo $this->customer['Listing Phone'] ?></td>
        <th>URL:</th>
        <td colspan="2"><?php echo $this->customer['URL'] ?></td>
    </tr>
</table>    
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
