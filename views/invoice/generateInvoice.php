<?php require('mpdf/mpdf.php'); 
$mpdf=new mPDF('win-1252','A4','','',20,15,48,25,10,10); 
$mpdf->useOnlyCoreFonts = true;    // false is default

$mpdf->SetTitle("Invoice");
$mpdf->showWatermarkText = true;
$mpdf->SetDisplayMode('fullpage');
$addressStr = ($this->customer['Billing Address'] != '')?$this->customer['Billing Address'].
        ', '.$this->customer['Billing Suburb'].',':'';
$stateStr = ($this->customer['Billing State']!='')?$this->customer['Billing State'].
        ', '.$this->customer['Billing Post Code']:'';
foreach($this->jobItems as $jobItem){
    $jobItemPart .= '<tr><td width="10%" align="left">'.$jobItem['Display Unit'].'</td>'.
        '<td align="left">'.$jobItem['Classification'].'</td>'.
        '<td align="right">$'.$jobItem['Unit Amount'].'</td>'.
        '<td align="right">$'.$jobItem['Rebated'].'</td></tr>';
    
    $amountPart .= '<tr>
           <td width="20%" align="right">$'.$jobItem['Nett'].'</td></tr>';
}


$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
    height: 100%;
}
.item thead td { background-color: #EEEEEE;
    font-weight: bold;
    text-align: center;
    border: 0.1mm solid #000000;
}

tfoot td { 
    font-weight: bold;
    text-align: center;
    border: 0.1mm solid #000000;
}

.item tbody td { 
    text-align: center;
    border-left: 0.1mm solid #000000;
    border-right: 0.1mm solid #000000;
}

.innerTable td {
    text-align: center;
    border-left: 0mm solid #000000;
    border-right: 0mm solid #000000;
}

.scissors {
    border-bottom: 3px dashed black;
}

</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table width="100%">
            <tr>
                <td width="75%" style="border-bottom:1px solid" >
                    <table width="100%">
                        <tr>
                            <td width="20%" ><img src="'.URL.'public/images/cbd_logo.png"></td>
                        <td width="80%">
                    <span style="font-weight: bold; font-size: 14pt;">BCC GROUP PTY LTD&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:8pt">ABN&nbsp;49&nbsp;062&nbsp;729&nbsp;631&nbsp;&nbsp;Trading as:</span></span><br />
                    <span style="font-weight: bold; font-size: 16pt;">CHINESE BUSINESS DIRECTORY, QLD</span><br />
                    <span style="font-size:8pt;">Tel:(07)3852&nbsp;1422&nbsp;&nbsp;Fax:(07)&nbsp;3852&nbsp;1422&nbsp;&nbsp;Email:cbd@bccgroup.com.au</span><br />
                    <span style="font-size: 8pt;">229&nbsp;Brunswick&nbsp;St,&nbsp;P.O.BOX&nbsp;1502,&nbsp;Fortitude&nbsp;Valley&nbsp;QLD&nbsp;4006</span>
                    </td></tr>
                    </table>
                </td>
                <td width="25%" style="text-align: right;">
                    <span style="font-weight: bold; font-size: 12pt;">TAX&nbsp;INVOICE</span><br />
                    <span style="font-weight: bold; font-size: 12pt;">
                        <table border="1" style="border-collapse: collapse;" cellpadding="5">
                            <tr><th>DATE</th><th>NUMBER</th></tr>
                            <tr><td>'.date('d/m/y').'</td><td align="center">'.$this->invoiceNo.'</td></tr>
                        </table>
                    </span>
                </td>
            </tr>
        </table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
        <div class="scissors">
            <div style="width:50%;float:left;text-align:left;margin:0px;padding:0px;"><span style="font-size:10pt;">&#9988;</span></div> 
            <div style="width:50%;float:right;text-align:right;;margin:0px;padding:0px;"><span style="font-size:8pt;">Please retain this portion for your records</span></div>
        </div>
        <table width="100%" style="margin-top:8pt;">
            <tr>
                <td width="50%"><b><span style="font-size:12pt;">REMITTANCE ADVICE</span></b></td>
                <td width="15%" style="margin-left: 20px;">Account:</td>
                <td width="35%" style="text-transform: uppercase;">'.$this->customer['Customer Name'].'</td>
            </tr>
            <tr>
                <td width="50%"><span style="font-size:8pt;">Please mail this portion with your cheque made payable to:</span></td>
                <td width="15%" style="margin-left: 20px;">Invoice No:</td>
                <td width="35%">'.$this->invoiceNo.'</td>
            </tr>
            <tr>
                <td width="50%" rowspan="2">
                    <table border="1" style="border-collapse: collapse;" cellpadding="10" width="300">
                        <tr>
                            <td>BCC GROUP PTY LTD<br/>PO BOX 1502<br/>Fortitude Valley QLD 4006</td>
                        </tr>
                    </table>
                </td>
                <td width="15%" style="margin-left: 20px;">Due Date:</td>
                <td width="35%">Nett 7 Days</td>
            </tr>
            <tr>
                            <td width="50%" align="left" colspan="2">
                                <table width="50%"  border="1"  style="border-collapse: collapse;" cellpadding="5" width="500">
                                    <tr>
                                        <td width="20%" align="left"><b>AMOUNT DUE</b></td>
                                        <td width="30%" align="right">$'.$this->jobDetail['Outstanding'].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
        </table>
        <div>
            <span style="font-size:7.5pt;font-style:italic;">Payment by Direct Deposit into our </span>
            <span style="font-size:7.5pt;"><b>WESTPAC BANK Account, BSB:&nbsp;034-010&nbsp;A/C&nbsp;No:347-038</b></span>
            <span style="font-size:7.5pt;font-style:italic;">&nbsp;and fax/email us the transaction details.</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<table width="50%">
    <tr>
        <td width="10%"><b>BILL TO: </b></td>
        <td width="40%">'.$this->customer['Customer Name'].'</td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%">'.$addressStr.'</td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="40%">'.$stateStr.'</td>
    </tr>
    <tr><td></td><tr/>
    <tr><td></td><tr/>
    <tr>
        <td width="10%"><b>Attention: </b></td>
        <td width="40%">'.$this->customer['Contact Person'].'</td>
    </tr>
</table>

<br/>
<br/>
<table class="item" style="border-collapse: collapse;font-size: 10pt;" width="100%" height="1000" cellpadding="5">
<thead>
<tr>
<td width="90%">DESCRIPTION</td>
<td width="10%">AMOUNT</td>
</tr>
</thead>
<!-- ITEMS HERE -->
<tbody>
<tr>
<td width="85%" >
     <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="90%" class="innerTable">
        <tr>
           <td width="20%" align="left"><p style="font-style:italic">Display Unit</p></td>
           <td width="30%" align="left"><p style="font-style:italic">Classification</p></td>
           <td width="35%" align="right"><p style="font-style:italic">Amount Payable</p></td>
           <td width="15%" align="right"><p style="font-style:italic">Discount</p></td>
         </tr>'.$jobItemPart.
         '<tr><td height="100" colspan="4"></td></tr>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td width="10%" align="right"><p><b>Sub Total</b></p></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td width="10%" align="right"><p><b>GST</b></p></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
           <td></td>
           <td width="10%" align="right"><p><b>Paid</b></p></td>
         </tr>
     </table>
</td>
<td width="15%">
    <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="15%" class="innerTable">
        <tr>
           <td width="10%" align="right"><p style="font-style:italic">Nett</p></td>
         </tr>'.
         $amountPart.
         '<tr><td width="20%" height="100"></td></tr>
         <tr><td width="20%" align="right">$'.$this->jobDetail['Subtotal'].'</td></tr>
         <tr><td width="20%" align="right">$'.$this->jobDetail['GST'].'</td></tr>
         <tr><td width="20%" align="right">$'.$this->jobDetail['Paid'].'</td></tr>
     </table>
</td>
</tr>
</tbody>
<tfoot>
    <tr>
        <td width="80%" align="right">PLEASE <br/>PAY<span style="font-size:18pt">&#9758;</span></td>
        <td width="20%" align="right">$'.$this->jobDetail['Amount Payable'].'</td>
    </tr>
   
</tfoot>
</table>
</body>
</html>';
$mpdf->WriteHTML($html);

$mpdf->Output(); exit;

exit;

?>