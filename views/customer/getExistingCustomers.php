
<h1>Existing Customers</h1>
<p><a class='addCustomer' href="index">Add a new customer</a></p>  
<div class="target loading">
    <div class="loading-overlay">
        <p class="loading-spinner">
            <span class="loading-text">Please wait... <img src="<?php echo URL; ?>public/images/loading.gif" /></span>

        </p>
    </div>
</div>
<table id="customerDT" cellspacing="0">
    <thead>
        <tr>
            <th class="left">Customer Name</th>
            <th class="left">Contact Person</th>
            <th class="left">Position</th>
            <th>Contact Phone</th>
            <th>Contact Mobile</th>
            <th>Jobs</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <?php ?>
    <tbody>
        <?php
        foreach ($this->customers as $customer) {
            $urlCustomerName = $this->helper->encodeCustomerNameUrl($customer['Customer Name']);
            $deleteStr = 'deleteItem("'. $urlCustomerName . '");';

            echo "<tr><td class='left'><a title='Click to view detail' href=" . URL . 
            "customer/getCustomerInfo/" . $urlCustomerName . ">" . $customer['Customer Name'] . "</a></td><td class='left'>" .
            $customer['Contact Person'] . "</td><td class='left'>" .
            $customer['Position'] . "</td><td>" .
            $customer['Contact Telephone'] . "</td><td>" .
            $customer['Contact Mobile'] . "</td><td>" .
            '<a class="lookup" title="View the job" href="' . URL . 'job/retrieveJobs/' . $urlCustomerName . '">' .
            '</a></td><td><a title="Update the customer" class="update" href=' . URL . 
            'customer/getCustomer/' . $urlCustomerName . '>' .
            '</a></td><td><a title="Delete the customer" class="delete" id="delClientLink" onclick=' .
            $deleteStr . 'href="#"></a></td></tr>';
        }
        ?>
    </tbody>
</table>
<br/>
<p class='centreSen'>
    <a class="goBack" href="javascript:history.go(-1)">Go back</a></p>
<script type="text/javascript">
    $(document).ready(function() {
        $('.target').loadingOverlay();
        $('#customerDT').dataTable({
            "fnPreDrawCallback": function() {
                // gather info to compose a message
                //alert('Data Procressing...');
                return true;
            },
            "displayLength": 25,
            
            "bAutoWidth": false,
            
            "aoColumnDefs": [
                {
                    bSortable: false,
                    aTargets: [-1, -2, -3]
                }
            ]
        });
        // Removing the loading overlay
        $('.target').loadingOverlay('remove');
    });

    // delete confrimation dialog
    function deleteItem(customerName) {
        if (confirm("Are you sure to delete the customer?")) {
            window.location.href =
                    "<?php echo URL; ?>customer/deleteCustomer/" + customerName;
        }
        return false;
    }
</script>


