<?php
$jobNo = explode('/', filter_input(INPUT_GET, 'url'))[2];
if (is_null($this->updatedJob['Invoice Date'])) {
    $invoiceDate = 'Not Specified';
} else {
    $invoiceDate = date('d/m/Y', strtotime($this->updatedJob['Invoice Date']));
}
if (is_null($this->updatedJob['Contract Date'])) {
    $contractDate = 'Not Specified';
} else {
    $contractDate = date('d/m/Y', strtotime($this->updatedJob['Contract Date']));
}
?>
<h1>Update Job <span class='highlighted'><?php echo $jobNo; ?></span></h1>
<form action='<?php echo URL; ?>job/saveJob' method="post" name='updateJobForm'>
    <input type="hidden" value='<?php echo $jobNo; ?>' name='jobNo'> 
    <input type="hidden" value='<?php echo $this->urlCustomerName; ?>' name='urlCustomerName'>
    <input type="hidden" value='<?php echo $this->updatedJob['Customer Name']; ?>' name='customerName'> 
    <table id="transactionTB" cellspacing='1' cellpadding='5' border='1'>
        <tr>
            <th>Job No.</th>
            <td><?php echo $jobNo; ?></td>
            <th>Invoice Date</th>
            <td><input type="text" id='invoiceDate' class="datepicker" name="invoiceDate" 
                       value="<?php echo $invoiceDate; ?>" /></td>
            <th>Contract Date</th>
            <td><input type="text" id="contractDate" class="datepicker" name="contractDate" 
                       value="<?php echo $contractDate; ?>"/></td>
        </tr>
        <tr>
            <th>Pay Method</th>
            <td><input type='checkbox' name='cheque'  
                <?php
                if ($this->updatedJob['Cheque']) {
                    echo ' checked="checked" ';
                }
                ?>/> Cheque &nbsp;&nbsp;
                <input type='checkbox' name='cash'  
                <?php
                if ($this->updatedJob['Cash']) {
                    echo ' checked="checked" ';
                }
                ?> /> Cash</td>

            <th>Deposit</th>
            <td nowrap='nowrap'>$<input type="text" name="deposit" 
                                        value="<?php echo $this->updatedJob['Deposit']; ?>"/></td>
            <th>Paid</th>
            <td nowrap='nowrap'>$<input type="text" name="paid" 
                                        value="<?php echo $this->updatedJob['Paid']; ?>"/></td>
        </tr>
        <tr>
            <th>Sales Commission(Full or Partial)</th>
            <td>
                <select name='sc'>
                    <option value="">Not Specified</option>
                    <option value="Full" <?php
                    if ($this->updatedJob['SC(F/P)'] == 'Full') {
                        echo 'selected="selected"';
                    }
                    ?>>Full Commission</option>
                    <option value="Partial" <?php
                    if ($this->updatedJob['SC(F/P)'] == 'Partial') {
                        echo 'selected="selected"';
                    }
                    ?>>Partial Commission</option>
                </select>
            </td>
            <th>Requirements</th>
            <td colspan="3">
                <input type='checkbox' name='film' 
                <?php
                if ($this->updatedJob['Film']) {
                    echo ' checked="checked" ';
                }
                ?>/> Film &nbsp;&nbsp;
                <input type='checkbox' name='bromide'  
                <?php
                if ($this->updatedJob['Bromide']) {
                    echo ' checked="checked" ';
                }
                ?> /> Bromide &nbsp;&nbsp;
                <input type='checkbox' name='photo'  
                <?php
                if ($this->updatedJob['Photography']) {
                    echo ' checked="checked" ';
                }
                ?>/> Photography
            </td>
        </tr>
        <tr>
            <th>Art Work</th>
            <td colspan="5">
                <input type='checkbox' name='customerMaterial'  
                <?php
                if ($this->updatedJob['Customer Material']) {
                    echo ' checked="checked" ';
                }
                ?>/> Supplied By Client &nbsp;&nbsp;
                <input type='checkbox' name='suppliedByAgent'  
                <?php
                if ($this->updatedJob['Supplied by Agency']) {
                    echo ' checked="checked" ';
                }
                ?>/> Supplied By Agency &nbsp;&nbsp;
                <input type='checkbox' name='designedByBCC'  
                <?php
                if ($this->updatedJob['Designed by BCC']) {
                    echo ' checked="checked" ';
                }
                ?>/> Designed By BCC
            </td>
        </tr>
        <tr>
            <th>Special Request</th>
            <td colspan="2"><textarea name="specialRequest" rows="6" cols="50"><?php echo $this->updatedJob['Special Request'] ?></textarea></td>
            <th>Remarks</th>
            <td colspan="2"><textarea name="remarks" rows="6" cols="50" maxlength="14"><?php echo $this->updatedJob['Payment Remark'] ?></textarea></td>
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
        $unitNos = array(1, 2, 3, 4, 5, 6, 7, 8);
        foreach ($unitNos as $unitNo) {
            if (isset($this->updatedJobItems[$unitNo - 1])) {
                echo '<input type="hidden" name="ID' . $unitNo . '" value="' . $this->updatedJobItems[$unitNo - 1]['ID'] . '">';
            } else {
                echo '<input type="hidden" name="ID' . $unitNo . '" value="0">';
            }
            ?> 
            <tr>
                <th><?php echo $unitNo; ?></th>
                <td colspan="1">
                    <select name='unit<?php echo $unitNo; ?>'>
                        <option value=''>- Select -</option>
                        <?php foreach ($this->units as $unit) { ?>
                            <option value='<?php echo $unit ?>'
                            <?php
                            if (isset($this->updatedJobItems[$unitNo - 1])) {
                                if ($unit == $this->updatedJobItems[$unitNo - 1]['Display Unit']) {
                                    echo 'selected="selected";';
                                }
                            }
                            ?>><?php echo $unit ?></option>
                                <?php } ?>
                    </select>
                </td>
                <td colspan="2">
                    <select name='classification<?php echo $unitNo; ?>'>
                        <option value=''>- Select -</option>
                        <?php foreach ($this->classifications as $classification) { ?>
                            <option value='<?php echo $classification['CL'] ?>'
                            <?php
                            if (isset($this->updatedJobItems[$unitNo - 1])) {
                                if ($classification['CL'] == $this->updatedJobItems[$unitNo - 1]['Classification']) {
                                    echo 'selected="selected";';
                                }
                            }
                            ?>><?php echo $classification['CL'] ?></option>
                                <?php } ?>
                    </select>
                </td>
                <td nowrap='nowrap'>$<input type="text" name="payable<?php echo $unitNo; ?>" 
                                            value='<?php
                                            if (isset($this->updatedJobItems[$unitNo - 1])) {
                                                echo $this->updatedJobItems[$unitNo - 1]['Unit Amount'];
                                            }
                                            ?>' /></td>
                <td nowrap='nowrap'>$<input type="text" name="nett<?php echo $unitNo; ?>" value='<?php
                    if (isset($this->updatedJobItems[$unitNo - 1])) {
                        echo $this->updatedJobItems[$unitNo - 1]['Nett'];
                    }
                    ?>' /></td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan="6"><input type="submit" value="Update the job" /></th>
        </tr>
    </table>
</form>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
<script type="text/javascript">
    $('#invoiceDate').focus(function() {
        $(this).val('');
    });
    $('#invoiceDate').focusout(function() {
        if ($(this).val() == '')
            $(this).val('Not Specified');
    });
    $('#contractDate').focus(function() {
        $(this).val('');
    });
    $('#contractDate').focusout(function() {
        if ($(this).val() == '')
            $(this).val('Not Specified');
    });
</script>
