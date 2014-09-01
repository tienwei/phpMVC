<?php
if ($this->booleanJob) {
    if (is_null($this->jobs['Invoice Date'])) {
        $invoiceDate = 'Not Specified';
    } else {
        $invoiceDate = date('d/m/Y', strtotime($this->jobs['Invoice Date']));
    }
    if (is_null($this->jobs['Contract Date'])) {
        $contractDate = 'Not Specified';
    } else {
        $contractDate = date('d/m/Y', strtotime($this->jobs['Contract Date']));
    }
    ?>
    <h1><span class='highlighted'>
            <?php echo $this->customerName; ?>'s</span> Job Detail</h1>
    <table id="jobDT" cellspacing='1' cellpadding='5' border='1'>
        <tr>
            <th>Job No.</th>
            <td><?php
                $deleteStr = "deleteJob('" . $this->urlCustomerName . "');";
                echo $this->jobs['Job No']."&nbsp;<a class='update' title='Update the Job' href='" . URL . "job/updateJob/" .
                $this->jobs['Job No'] . "'>" .
                "</a>&nbsp;<a class='delete' href='#' onclick=" . $deleteStr .
                " title='Delete the job'></a>";
                ?></td>
            <th>Invoice Date</th>
            <td><?php
                if (empty($invoiceDate)) {
                    echo 'Not specified';
                } else {
                    echo $invoiceDate;
                }
                ?></td>
            <th>Contract Date</th>
            <td><?php
                if (empty($contractDate)) {
                    echo 'Not specified';
                } else {
                    echo $contractDate;
                }
                ?></td>
        </tr>
        <tr>
            <th>Sales Code</th>
            <td><?php
                if (empty($this->jobs['Sales Code'])) {
                    echo 'Not specified';
                } else {
                    echo $this->jobs['Sales Code'];
                }
                ?></td>
            <th>Pay Method</th>
            <td colspan="3"><input type='checkbox' name='cheque' disabled="disabled" 
                <?php
                if ($this->jobs['Cheque']) {
                    echo ' checked="checked" ';
                }
                ?>/> Cheque &nbsp;&nbsp;
                <input type='checkbox' name='cash' disabled="disabled" 
                <?php
                if ($this->jobs['Cash']) {
                    echo ' checked="checked" ';
                }
                ?> /> Cash</td>
        </tr>
        <tr>
            <th>Total Payment(GST excl.)</th>
            <td nowrap='nowrap'>$<?php echo $this->jobs['Subtotal']; ?></td>
            <th>GST</th>
            <td nowrap='nowrap'>$<?php echo $this->jobs['GST']; ?></td>
            <th>Full Payment</th>
            <td nowrap='nowrap'>$<?php echo $this->jobs['Amount Payable']; ?></td>
        </tr>
        <tr>
            <th>Deposit</th>
            <td nowrap='nowrap'>$<?php echo $this->jobs['Deposit']; ?></td>
            <th>Paid</th>
            <td nowrap='nowrap'>$<?php echo $this->jobs['Paid']; ?></td>
            <th>Outstanding</th>
            <td nowrap='nowrap'><span style="color: red;">$<?php echo $this->jobs['Outstanding']; ?></span></td>
        </tr>
        <tr>
            <th>Sales Commission(Full or Partial)</th>
            <td><?php
                if (empty($this->jobs['SC(F/P)'])) {
                    echo 'Not specified';
                } else {
                    echo $this->jobs['SC(F/P)'];
                }
                ?></td>
            <th>Requirements</th>
            <td colspan="3">
                <input type='checkbox' name='film' disabled="disabled" 
                <?php
                if ($this->jobs['Film']) {
                    echo ' checked="checked" ';
                }
                ?>/> Film &nbsp;&nbsp;
                <input type='checkbox' name='bromide' disabled="disabled" 
                <?php
                if ($this->jobs['Bromide']) {
                    echo ' checked="checked" ';
                }
                ?> /> Bromide &nbsp;&nbsp;
                <input type='checkbox' name='photo' disabled="disabled" 
                <?php
                if ($this->jobs['Photography']) {
                    echo ' checked="checked" ';
                }
                ?>/> Photography
            </td>
        </tr>
        <tr>
            <th>Art Work</th>
            <td colspan="5">
                <input type='checkbox' name='customerMaterial' disabled="disabled" 
                <?php
                if ($this->jobs['Customer Material']) {
                    echo ' checked="checked" ';
                }
                ?>/> Supplied By Client &nbsp;&nbsp;
                <input type='checkbox' name='suppliedByAgent' disabled="disabled" 
                <?php
                if ($this->jobs['Supplied by Agency']) {
                    echo ' checked="checked" ';
                }
                ?>/> Supplied By Agency &nbsp;&nbsp;
                <input type='checkbox' name='designedByBCC' disabled="disabled" 
                <?php
                if ($this->jobs['Designed by BCC']) {
                    echo ' checked="checked" ';
                }
                ?>/> Designed By BCC
            </td>
        </tr>
        <tr>
            <th>Special Request</th>
            <td colspan="2"><?php
                if (empty($this->jobs['Special Request'])) {
                    echo 'Not specified';
                } else {
                    echo $this->jobs['Special Request'];
                }
                ?></td>
            <th>Remarks</th>
            <td colspan="2"><?php
                if (empty($this->jobs['Payment Remark'])) {
                    echo 'Not specified';
                } else {
                    echo $this->jobs['Payment Remark'];
                }
                ?></td>
        </tr>

    </table>

    <h2>Job Items</h2>
    <table id="jobItemDT" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th class='left'>Display Unit</th>
                <th class='left'>Classification</th>
                <th>Unit Amount</th>
                <th>Rebated Amount</th>
                <th>Net Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->jobItems as $job) {
                echo "<tr><td>" . $job['ID'] . "</td><td class='left'>" .
                $job['Display Unit'] . "</td><td class='left'>" .
                $job['Classification'] . "</td><td>$" .
                $job['Unit Amount'] . "</td><td>$" .
                $job['Rebated'] . "</td><td>$" .
                $job['Nett'] . "</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2"></th>
                <th style="text-align:center">Page Sum:</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <br/>
    <?php
} else {
    echo 'The customer (' . $this->customerName . ') seems not to have any job yet.<br />';
}
?>
<br/>

<p class='centreSen'><a class='add' 
                        href="<?php echo URL ?>job/index/<?php echo $this->urlCustomerName; ?>">Add a new job</a>
                            <?php if ($this->booleanJob) {?> / <a class='invoice' 
                        href="<?php echo URL ?>invoice/index/<?php echo $this->urlCustomerName; ?>">Invoice the job</a>
                            <?php }?> 
</p>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
<script type="text/javascript">
    $(document).ready(function() {
        $('#jobItemDT').dataTable({
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                // Total over this page
                pageTotal3 = getTotalValByCol(api, intVal, 3).toString().replace(/[\$,]/g, '');;
                pageTotal4 = getTotalValByCol(api, intVal, 4).toString().replace(/[\$,]/g, '');;
                pageTotal5 = getTotalValByCol(api, intVal, 5).toString().replace(/[\$,]/g, '');;

                // Update footer
                $(api.column(3).footer()).html(
                        '$' + pageTotal3
                        );
                $(api.column(4).footer()).html(
                        '$' + pageTotal4
                        );
                $(api.column(5).footer()).html(
                        '$' + pageTotal5
                        );
            }
        });
    });
    function getTotalValByCol(api, intVal, colNum) {
        data = api.column(colNum, {page: 'current'}).data();
        return pageTotal = data.length ?
                data.reduce(function(a, b) {
                    return Number(intVal(a).toFixed(2)) +
                            Number(intVal(b).toFixed(2));
                }) :
                0;
    }
    // delete confrimation dialog
    function deleteJob(customerName) {
        if (confirm("Are you sure to delete the job?")) {
            window.location.href =
                    "<?php echo URL; ?>job/deleteJob/" + customerName;
        }
        return false;
    }
</script>
