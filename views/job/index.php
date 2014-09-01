<h1>Add A Job for <span class='highlighted'><?php echo $this->customerName; ?></span></h1>
<form action='<?php echo URL;?>job/saveJob' onsubmit="return validateForm()" method="post" name='addJobForm' id="addJobForm">
    <input type="hidden" value='<?php echo $this->customerName; ?>' name='customerName'>
    <input type="hidden" value='<?php echo $this->urlCustomerName; ?>' name='urlCustomerName'>
    <input type="hidden" value='1' name='addJob'> 
    <table id='jobTable' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <th>Job No.</th>
            <td><input name='jobNo' type='text' maxlength="8" max="8" /></td>
            <th>Invoice Date</th>
            <td><input type="text" id="invoiceDate" class="datepicker" name="invoiceDate" /></td>
            <th>Contract Date</th>
            <td><input type="text" id="contractDate" class="datepicker" name="contractDate" /></td>
        </tr>
        <tr>
            <th>Pay Method</th>
            <td><input type='checkbox' name='cheque' /> Cheque &nbsp;&nbsp;
                <input type='checkbox' name='cash' /> Cash</td>
            <th>Deposit</th>
            <td nowrap='nowrap'>$<input type="text" name="deposit" value="0"/></td>
            <th>Paid</th>
            <td nowrap='nowrap'>$<input type="text" name="paid" value="0"/></td>
        </tr>
        <tr>
            <th>Sales Commission(Full or Partial)</th>
            <td>
                <select name='sc'>
                    <option value="">Not Specified</option>
                    <option value="Full">Full Commission</option>
                    <option value="Partial">Partial Commission</option>
                </select>
            </td>
            <th>Requirements</th>
            <td colspan="3">
                <input type='checkbox' name='film' /> Film &nbsp;&nbsp;
                <input type='checkbox' name='bromide' /> Bromide &nbsp;&nbsp;
                <input type='checkbox' name='photo' /> Photography
            </td>
        </tr>
        <tr>
            <th>Art Work</th>
            <td colspan="5">
                <input type='checkbox' name='customerMaterial' /> Supplied By Client &nbsp;&nbsp;
                <input type='checkbox' name='suppliedByAgency' /> Supplied By Agency &nbsp;&nbsp;
                <input type='checkbox' name='designedByBCC' /> Designed By BCC
            </td>
        </tr>
        <tr>
            <th>Special Request</th>
            <td colspan="2"><textarea name="specialRequest" rows="6" cols="50"></textarea></td>
            <th>Remarks</th>
            <td colspan="2"><textarea name="remarks" rows="6" cols="50" maxlength="14"></textarea></td>
        </tr>
        <tr>
            <th colspan="6">************ JOB ITEMS ************</th>
        </tr>
        <tr>
            <th>Item No.</th>
            <th>DISPLAY UNIT</th>
            <th colspan="2">CLASSIFICATION</th>
            <th>AMOUNT PAYABLE</th>
            <th>NETT</th>
        </tr>
        <?php 
            $unitNos =  array(1,2,3,4,5,6,7,8);
            foreach($unitNos as $unitNo) { ?>
                <tr>
            <th><?php echo $unitNo;?></th>
            <td colspan="1">
                <select name='unit<?php echo $unitNo;?>'>
                    <option value=''>- Select -</option>
                    <?php foreach ($this->units as $unit) { ?>
                        <option value='<?php echo $unit ?>'><?php echo $unit ?></option>
                    <?php } ?>
                </select>
            </td>
            <td colspan="2">
                <select name='classification<?php echo $unitNo;?>'>
                    <option value=''>- Select -</option>
                    <?php foreach ($this->classifications as $classification) { ?>
                        <option value='<?php echo $classification['CL'] ?>'><?php echo $classification['CL'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td nowrap='nowrap'>$<input type="text" name="payable<?php echo $unitNo;?>" value="0" /></td>
            <td nowrap='nowrap'>$<input type="text" name="nett<?php echo $unitNo;?>" value="0" /></td>
        </tr>
            <?php } ?>
        <tr>
            <th colspan="6"><input type="submit" value="Add Job" /></th>
        </tr>
    </table>
</form>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
<script type="text/javascript">
    function validateForm() {
    var x = document.forms["addJobForm"]["jobNo"].value;
    if (x == null || x == "") {
        alert("Job No. is a compulsory field, please fill it");
        return false;
    }
}
$('#invoiceDate').focus(function(){
       $(this).val(''); 
    });
    $('#invoiceDate').focusout(function(){
       if($(this).val()=='')$(this).val('Not Specified'); 
    });
    $('#contractDate').focus(function(){
       $(this).val(''); 
    });
    $('#contractDate').focusout(function(){
       if($(this).val()=='')$(this).val('Not Specified'); 
    });
</script>

