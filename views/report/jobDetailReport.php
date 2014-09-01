<script type="text/javascript">
    $(document).ready(function() {
        $('.target').loadingOverlay();
        $('#jobDetailDT').dataTable({
            "columns": [
                null,
                null,
                {"type": "date-uk"},
                {"type": "date-uk"},
                null,
                null,
                null,
                null,
                null
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                //Total over all pages
                data = api.column(4).data();
                total4 = data.length ?
                        data.reduce(function(a, b) {
                            return Number(intVal(a).toFixed(2)) +
                                    Number(intVal(b).toFixed(2));
                        }) :
                        0;

                data = api.column(5).data();
                total5 = data.length ?
                        data.reduce(function(a, b) {
                            return Number(intVal(a).toFixed(2)) +
                                    Number(intVal(b).toFixed(2));
                        }) :
                        0;

                data = api.column(6).data();
                total6 = data.length ?
                        data.reduce(function(a, b) {
                            return Number(intVal(a).toFixed(2)) +
                                    Number(intVal(b).toFixed(2));
                        }) :
                        0;

                // Total over this page
                pageTotal4 = getTotalValByCol(api, intVal, 4).toString().replace(/[\$,]/g, '');
                ;
                pageTotal5 = getTotalValByCol(api, intVal, 5).toString().replace(/[\$,]/g, '');
                ;
                pageTotal6 = getTotalValByCol(api, intVal, 6).toString().replace(/[\$,]/g, '');
                ;

                // Update footer
                $(api.column(4).footer()).html(
                        '$' + pageTotal4 + ' (Total:$' + total4 + ')');
                $(api.column(5).footer()).html(
                        '$' + pageTotal5 + ' (Total:$' + total5 + ')');
                $(api.column(6).footer()).html(
                        '<span class="attention">$' + pageTotal6 + ' (Total:$' + total6 + ')</span>');
            }
        });
        // Removing the loading overlay
        $('.target').loadingOverlay('remove');
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
</script>
<h1>Job Detail Report</h1>  
<div class="target loading">
    <div class="loading-overlay">
        <p class="loading-spinner">
            <span class="loading-text">Please wait... <img src="<?php echo URL; ?>public/images/loading.gif" /></span>

        </p>
    </div>
</div>
<table id="jobDetailDT" cellspacing="0">
    <thead>
        <tr>
            <th class='left'>Customer Name</th>
            <th>Job No</th>
            <th>Invoice Date</th>
            <th>Contract Date</th>
            <th>Deposit</th>
            <th>Amount Payable</th>
            <th>Outstanding Fees</th>
            <th class='left'>Special Request</th>
            <th class='left'>Remarks</th>
        </tr>
    </thead>
        <?php ?>
    <tbody>
        <?php
        foreach ($this->allJobs as $job) {
            $customerName = $this->helper->encodeCustomerNameUrl($job['Customer Name']);
            if(is_null($job['Invoice Date'])){
                $invoiceDate='no date';
            } else {
                $invoiceDate = date('d/m/y', strtotime($job['Invoice Date']));
            }
            if(is_null($job['Contract Date'])){
                $contractDate='no date';
            } else {
                $contractDate = date('d/m/y', strtotime($job['Contract Date']));
            }

            echo '<tr><td class="left"><a href="' . URL . 'customer/getCustomerInfo/' .
            $customerName . '">' . $job['Customer Name'] .
            '</a></td>' .
            '<td><a href="' . URL . 'job/retrieveJobs/' .
            $customerName . '">' . $job['Job No'] .
            '</a></td><td>' .
            $invoiceDate . "</td><td>" .
            $contractDate . "</td><td>$" .
            $job['Deposit'] . "</td><td>$" .
            $job['Amount Payable'] . "</td><td>$" .
            $job['Outstanding'] . "</td><td class='left'>" .
            $job['Special Request'] . "</td><td class='left'>" .
            $job['Payment Remark'] . "</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"></th>
            <th style="text-align:center">Page Sum:</th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2"></th>
        </tr>
    </tfoot>
</table>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>