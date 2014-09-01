<script type="text/javascript">
    $(document).ready(function() {
        $('.target').loadingOverlay();
        $('#salesDetailDT').dataTable({
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

                // Total over this page
                pageTotal4 = getTotalValByCol(api, intVal, 4).toString().replace(/[\$,]/g, '');;
                pageTotal5 = getTotalValByCol(api, intVal, 5).toString().replace(/[\$,]/g, '');;
                

                // Update footer
                $(api.column(4).footer()).html(
                        '$' + pageTotal4 + ' (Total:$' + total4 + ')');
                $(api.column(5).footer()).html(
                        '$' + pageTotal5 + ' (Total:$' + total5 + ')');
            },
            
            "order": [[0, 'asc']],
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;

                api.column(0, {page: 'current'}).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="6" align="center"><b>' + group + '</b></td></tr>'
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
<h1>Sales Detail Report</h1>  
<div class="target loading">
    <div class="loading-overlay">
        <p class="loading-spinner">
            <span class="loading-text">
                Please wait... <img src="<?php echo URL; ?>public/images/loading.gif" />
            </span>
        </p>
    </div>
</div>
<table id="salesDetailDT" cellspacing="0">
    <thead>
        <tr>
            <th>Sales Code</th>
            <th class='left'>Job No</th>
            <th class='left'>Customer Name</th>
            <th>Full/Partial Comm.</th>
            <th>Deposit</th>
            <th>Amount Payable</th>
        </tr>
    </thead>
    <?php ?>
    <tbody>
        <?php
        foreach ($this->allJobs as $job) {
            $customerName = $this->helper->encodeCustomerNameUrl($job['Customer Name']);

            echo "<tr><td>". $job['Sales Code'] ."</td>" .
            '<td class="left"><a href="' . URL . "job/retrieveJobs/" .
            $customerName . '">' . $job['Job No'] .
            '</a></td><td class="left">' .
            '<a href="' . URL . 'customer/getCustomerInfo/' .
            $customerName . '">' . $job['Customer Name'] .
            '</a></td><td>' .
            $job['SC(F/P)'] . "</td><td>$" .
            $job['Deposit'] . "</td><td>$" .
            $job['Amount Payable'] . "</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"></th>
            <th style="text-align:center">Summary:</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>