<!Doctype html>
<html>
    <head>
        <title>
            Clients/Sales Management System
        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery-ui.css">
        <script src="<?php echo URL; ?>public/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>public/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/loading-overlay.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css">

        <script type="text/javascript">
            $(function() {
                $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});
            });
            $(document).ready(function() {
                var gobackImg = $(
                        '<img src="<?php echo URL; ?>public/images/arrow_left.png">');
                gobackImg.insertBefore($('.goBack'));
                var addImg = $('<img style="vertical-align: middle; \n\
            width:16px; height:16px" src="<?php echo URL; ?>public/images/add.png" \n\
            >');
                addImg.insertBefore($('.add'));

                var addCustomerImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/newCustomer.jpeg">');
                addCustomerImg.insertBefore($('.addCustomer'));

                var reportImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/report.png">');
                reportImg.insertBefore($('.report'));

                var outstandingImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/outstanding_customer.png">');
                outstandingImg.insertBefore($('.badguy'));

                var paidoffImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/paid_customer.png">');
                paidoffImg.insertBefore($('.goodguy'));
                
                var invoiceImg = $('<img style="vertical-align: middle; \n\
            width:20px; height:20px" src="<?php echo URL ?>public/images/invoice.png">');
                invoiceImg.insertBefore($('.invoice'));
                
                var usersImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/users.png">');
                usersImg.insertBefore($('.users'));
                
                var addUserImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/add_user.png">');
                addUserImg.insertBefore($('.add_user'));
                
                var passwordImg = $('<img style="vertical-align: middle; \n\
            width:30px; height:30px" src="<?php echo URL ?>public/images/password.png">');
                passwordImg.insertBefore($('.password'));

                var lookupImg = $(
                        '<img src="<?php echo URL; ?>public/images/magnifier.png">');
                lookupImg.appendTo($('.lookup'));
                var updateImg = $(
                        '<img src="<?php echo URL; ?>public/images/edit.png">');
                updateImg.appendTo($('.update'));
                var deleteImg = $(
                        '<img src="<?php echo URL; ?>public/images/remove.png">');
                deleteImg.appendTo($('.delete'));
                var lookupFrontImg = $(
                        '<img src="<?php echo URL; ?>public/images/magnifier.png">');
                lookupFrontImg.insertBefore($('.lookupFront'));
            });
        </script>
    </head>

    <body>
        <a id="headerLink" href="<?php echo URL; ?>index" title="Back to main menu">
            <div id="header">
                <p><img style="vertical-align: middle;" 
                        src='<?php echo URL; ?>public/images/cbd_logo.png'> 
                    <span id="appTitle">Client/Sales Management System</span>
                </p>
                <?php if (Session::get('loggedIn')) { ?>
                    <div id="navigation">
                        <a href= '<?php echo URL; ?>index/logout'>
                            <img src="<?php echo URL; ?>public/images/logout.png" 
                                 style="width:30px;height:30px;vertical-align: middle;">Logout</a>
                    </div>
                <?php } ?>
            </div>
        </a>



        <div id="content">
            <?php
            if (Session::get('errorMsg') != '') {
                echo '<span class="error"><b>'
                . Session::get('errorMsg') . '</b></span><br/>';
            }
            Session::set('errorMsg', '');
            if (Session::get('message') != '') {
                echo '<span class="message"><b>'
                . Session::get('message') . '</b></span><br/>';
            }
            Session::set('message', '');
            ?>

            


