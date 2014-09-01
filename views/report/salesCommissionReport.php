<script type="text/javascript">
    $(document).ready(function() {
        $('.target').loadingOverlay();
        $('#salesCommissionDT').dataTable({
            "columns": [
                null,
                null,
                {"type": "date-uk"},
                null,
                null,
                null,
                {"type": "date-uk"},
                null,
                {"type": "date-uk"},
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
                data = api.column(3).data();
                total3 = data.length ?
                        data.reduce(function(a, b) {
                            return Number(intVal(a).toFixed(2)) +
                                    Number(intVal(b).toFixed(2));
                        }) :
                        0;
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
                data = api.column(7).data();
                total7 = data.length ?
                        data.reduce(function(a, b) {
                            return Number(intVal(a).toFixed(2)) +
                                    Number(intVal(b).toFixed(2));
                        }) :
                        0;

                // Total over this page
                pageTotal3 = getTotalValByCol(api, intVal, 3).toString().replace(/[\$,]/g, '');
                ;
                pageTotal4 = getTotalValByCol(api, intVal, 4).toString().replace(/[\$,]/g, '');
                ;
                pageTotal5 = getTotalValByCol(api, intVal, 5).toString().replace(/[\$,]/g, '');
                ;
                pageTotal7 = getTotalValByCol(api, intVal, 7).toString().replace(/[\$,]/g, '');
                ;


                // Update footer
                $(api.column(3).footer()).html(
                        '$' + pageTotal3 + ' (Total:$' + total3 + ')');
                $(api.column(4).footer()).html(
                        '$' + pageTotal4 + ' (Total:$' + total4 + ')');
                $(api.column(5).footer()).html(
                        '$' + pageTotal5 + ' (Total:$' + total5 + ')');

                $(api.column(7).footer()).html(
                        '$' + pageTotal7 + ' (Total:$' + total7 + ')');
            },
            "order": [[0, 'asc']],
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;

                api.column(0, {page: 'current'}).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="10" align="center"><b>' + group + '</b></td></tr>'
                                );

                        last = group;
                    }
                });
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
<h1>Sales Commission Report</h1>  
<div class="target loading">
    <div class="loading-overlay">
        <p class="loading-spinner">
            <span class="loading-text">
                Please wait... <img src="<?php echo URL; ?>public/images/loading.gif" />
            </span>
        </p>
    </div>
</div>
<table id="salesCommissionDT" cellspacing="0">
    <thead>
        <tr>
            <th class='left'>Job No</th>
            <th class='left'>Customer Name</th>
            <th>Pay Date</th>
            <th>Amount</th>
            <th>Total(gst excl.)</th>
            <th>Comm.</th>
            <th>Comm. Pay Date</th>
            <th>Bonus</th>
            <th>Bonus Pay Date</th>
            <th class='left'>Remark</th>
        </tr>
    </thead>
        <?php ?>
    <tbody>
        <?php
        foreach ($this->commRecords as $commRecord) {
            $customerName = $this->helper->encodeCustomerNameUrl($commRecord['cust']);
            if(is_null($commRecord['paydate'])){
                $payDate='no date';
            } else {
                $payDate= $commRecord['paydate'];
            }
            if(is_null($commRecord['commpaydate'])){
                $commPayDate='no date';
            } else {
                $commPayDate= $commRecord['commpaydate'];
            }
            if(is_null($commRecord['bonuspaydate'])){
                $bounsPayDate='no date';
            } else {
                $bounsPayDate = $commRecord['bonuspaydate'];
            }

            echo '<tr><td class="left"><a href="' . URL . "job/retrieveJobs/" .
            $customerName . '">' . $commRecord['job'] .
            '</a></td><td class="left">' .
            '<a href="' . URL . 'customer/getCustomer/' .
            $customerName . '">' . $commRecord['cust'] .
            "</a></td><td>" .
            $payDate . "</td><td>$" .
            $commRecord['amount'] . "</td><td>$" .
            $commRecord['subt'] . "</td><td>$" .
            $commRecord['commission'] . "</td><td>" .
            $commPayDate . "</td><td>$" .
            $commRecord['bonus'] . "</td><td>" .
            $bounsPayDate . "</td><td class='left'>" .
            $commRecord['remark'] . "</td></tr>";
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
            <th></th>
            <th></th>
            <th colspan="2"></th>
        </tr>
    </tfoot>
</table>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>