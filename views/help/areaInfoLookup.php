<script type="text/javascript">
    $(document).ready(function() {
        $('#areaInfoTB').dataTable({
            "displayLength": 25,
            "aoColumnDefs": [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ]
        });
    });
</script>
<h1>Area List</h1>
<p><a class="add" href="<?php echo URL;?>help/addArea">Add an area</a></p>
<table id="areaInfoTB" cellspacing="0" max-width="500" width="500">
    <thead>
        <tr>
            <th>Postcode</th>
            <th>State</th>
            <th class='left'>Suburb</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($this->areaInfo as $area) {
            echo "<tr><td>" . $area['PC'] . "</td><td>" .
            $area['ST'] . "</td><td class='left'>" .
            $area['SU'] . "</td><td>"
            . "<a class='delete' href='" . URL . "help/deleteArea/" . $area['SU'] . "'></a></td></tr>";
        }
        ?>
    </tbody>
</table>
<p class='centreSen'><a class="goBack" href="<?php echo URL;?>/index"> Go back</a></p>
