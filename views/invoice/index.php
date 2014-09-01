<form action="<?php echo URL;?>invoice/generateInvoice" method="post" onsubmit="return validateForm();">
    <table border="1" cellpadding="5">
        <tr>
            <th><label for="invoiceNo">Invoice No.:</label></th>
            <td><input type="text" id="invoiceNo" name="invoiceNo" value="" maxlength="10" /></td>
        </tr>
        <tr>
            <input type="hidden" name="customerName" value="<?php echo $this->customerName; ?>" />
            <td colspan="2"><input type="submit" value="Generate Invoice" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    function validateForm() {
    var x = $("#invoiceNo").val();
    if (x == null || x == "") {
        alert("Please fill an invoice number before generating it.");
        return false;
    }
}
</script>