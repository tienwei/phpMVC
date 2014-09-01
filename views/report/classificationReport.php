<script type="text/javascript">
    $(document).ready(function() {
        $('.target').loadingOverlay();
        $('#classificationDT').dataTable({
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

                // Total over this page
                pageTotal3 = getTotalValByCol(api, intVal, 3).toString().replace(/[\$,]/g, '');;
                pageTotal4 = getTotalValByCol(api, intVal, 4).toString().replace(/[\$,]/g, '');;
                pageTotal5 = getTotalValByCol(api, intVal, 5).toString().replace(/[\$,]/g, '');;

                // Update footer
                $(api.column(3).footer()).html(
                        '$' + pageTotal3 + ' (Total:$' + total3 + ')');
                $(api.column(4).footer()).html(
                        '$' + pageTotal4 + ' (Total:$' + total4 + ')');
                $(api.column(5).footer()).html(
                        '$' + pageTotal5 + ' (Total:$' + total5 + ')');
            },
            "order": [[ 0, 'asc' ]],
            "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="6" align="center"><b>'+group+'</b></td></tr>'
                    );
 
                    last = group;
                }
            } );
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
<h1>Classification Report</h1>  
<div class="target loading">
    <div class="loading-overlay">
        <p class="loading-spinner">
            <span class="loading-text">
                Please wait... <img src="<?php echo URL; ?>public/images/loading.gif" />
            </span>
        </p>
    </div>
</div>
<table id="classificationDT" cellspacing="0" width=800"">
    <thead>
        <tr>
            <th class='left'>Classification</th>
            <th class='left'>Job No</th>
            <th class='left'>Display Uni</th>
            <th>Unit Amount</th>
            <th>Rebated Price</th>
            <th>Net Price</th>
        </tr>
    </thead>
    <?php ?>
    <tbody>
        <?php
        foreach ($this->allJobItems as $jobitem) {
            echo "<tr><td class='left'>" .
            $jobitem['Classification'] . "</td><td class='left'>" .
            $jobitem['Job No'] . "</td><td class='left'>" .
            $jobitem['Display Unit'] . "</td><td>" .
            $jobitem['Unit Amount'] . "</td><td>$" .
            $jobitem['Rebated'] . "</td><td>$" .
            $jobitem['Nett'] . "</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th style="text-align:center">Page Sum:</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>