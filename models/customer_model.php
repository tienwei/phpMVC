<?php

class Customer_Model extends Model {

    function __construct($dbYear) {
        parent::__construct($dbYear);
    }

    private function checkDuplicateCustomer($customerName) {
        // check if the information has been registered by checking firstname
        // surname and email
        $sql1 = "SELECT * FROM CD WHERE `Customer Name`=:customerName";
        $q1 = $this->db->prepare($sql1);
        $q1->execute(array(
            ":customerName" => $customerName));
        return (int) COUNT($q1->fetchAll());
    }

    public function register() {

        if (!empty(filter_input_array(INPUT_POST))) {
            $count = 
                    $this->checkDuplicateCustomer(filter_input(INPUT_POST, 'customerName'));

            if ($count == 0) {
                $customerName = trim(filter_input(INPUT_POST, 'customerName'));

                // Contact Info
                $address = filter_input(INPUT_POST, 'address');
                // Suburb/State/Postcode
                if (!(filter_input(INPUT_POST, 'customerAreaInfo'))) {
                    $suburb = '';
                    $state = '';
                    $postcode = '';
                } else {
                    $areaInfo = explode('-', filter_input(INPUT_POST, 'customerAreaInfo'));
                    $suburb = str_replace('&nbsp;', ' ', $areaInfo[0]);
                    $state = $areaInfo[1];
                    $postcode = $areaInfo[2];
                }

                $contactPerson = filter_input(INPUT_POST, 'contactPerson');
                $contactPosition = filter_input(INPUT_POST, 'contactPosition');
                $contactTelephone = filter_input(INPUT_POST, 'contactTelephone');
                $contactMobile = filter_input(INPUT_POST, 'contactMobile');
                $contactFax = filter_input(INPUT_POST, 'contactFax');

                // Billing Info
                $billingAddress = filter_input(INPUT_POST, 'billingAddress');
                // Suburb/State/Postcode

                if (!(filter_input(INPUT_POST, 'billingAreaInfo'))) {
                    $billingSuburb = '';
                    $billingState = '';
                    $billingPostcode = '';
                } else {
                    $billingAreaInfo = explode('-', filter_input(INPUT_POST, 'billingAreaInfo'));
                    $billingSuburb = str_replace('&nbsp;', ' ', $billingAreaInfo[0]);
                    $billingState = $billingAreaInfo[1];
                    $billingPostcode = $billingAreaInfo[2];
                }

                // Agent Info
                $agent = trim(filter_input(INPUT_POST, 'agent'));
                $agentPosition = trim(filter_input(INPUT_POST, 'agentPosition'));
                $agentTelephone = filter_input(INPUT_POST, 'agentTelephone');
                $agentMobile = filter_input(INPUT_POST, 'agentMobile');
                $agentFax = filter_input(INPUT_POST, 'agentFax');

                // Listing Info
                $listingAddress = filter_input(INPUT_POST, 'listingAddress');
                // Suburb/State/Postcode
                if (!(filter_input(INPUT_POST, 'listingAreaInfo'))) {
                    $listingSuburb = '';
                    $listingState = '';
                    $listingPostcode = '';
                } else {
                    $listingAreaInfo = explode('-', filter_input(INPUT_POST, 'listingAreaInfo'));
                    $listingSuburb = str_replace('&nbsp;', ' ', $listingAreaInfo[0]);
                    $listingState = $listingAreaInfo[1];
                    $listingPostcode = $listingAreaInfo[2];
                }

                $listingPhone = filter_input(INPUT_POST, 'listingPhone');
                $url = filter_input(INPUT_POST, 'url');
                // if the information is available
                $sql2 = 'INSERT INTO CD (`Customer Name`, `Address`, `Suburb`, '
                        . '`State`, `Post Code`, `Contact Person`, `Position`,'
                        . '`Contact Telephone`, `Contact Mobile`, `Contact Fax`,'
                        . '`Billing Address`, `Billing Suburb`, `Billing State`,'
                        . '`Billing Post Code`, `Agent`, `Agent Position`, '
                        . '`Agent Phone`, `Agent Fax`, `Agent Mobile`, '
                        . '`Listing Address`, `Listing Suburb`, `Listing State`,'
                        . '`Listing Post Code`, `Listing Phone`, `URL`) VALUES '
                        . '(:customerName, :address, :suburb, :state, :postcode,'
                        . ' :contactPerson, :contactPosition, :contactTelephone,'
                        . ' :contactMobile, :contactFax, :billingAddress,'
                        . ' :billingSuburb, :billingState, :billingPostcode,'
                        . ' :agent, :agentPosition, :agentTelephone, :agentFax,'
                        . ' :agentMobile, :listingAddress, :listingSuburb,'
                        . ' :listingState, :listingPostcode, :listingPhone, '
                        . ' :url)';
                try {
                    $q2 = $this->db->prepare($sql2);
                    $q2->execute(array(
                        ':customerName' => $customerName,
                        ':address' => $address,
                        ':suburb' => $suburb,
                        ':state' => $state,
                        ':postcode' => $postcode,
                        ':contactPerson' => $contactPerson,
                        ':contactPosition' => $contactPosition,
                        ':contactTelephone' => $contactTelephone,
                        ':contactMobile' => $contactMobile,
                        ':contactFax' => $contactFax,
                        ':billingAddress' => $billingAddress,
                        ':billingSuburb' => $billingSuburb,
                        ':billingState' => $billingState,
                        ':billingPostcode' => $billingPostcode,
                        ':agent' => $agent,
                        ':agentPosition' => $agentPosition,
                        ':agentTelephone' => $agentTelephone,
                        ':agentFax' => $agentFax,
                        ':agentMobile' => $agentMobile,
                        ':listingAddress' => $listingAddress,
                        ':listingSuburb' => $listingSuburb,
                        ':listingState' => $listingState,
                        ':listingPostcode' => $listingPostcode,
                        ':listingPhone' => $listingPhone,
                        ':url' => $url));
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                    header('location:' . URL . 'error/error');
                }
                Session::set('message', $customerName . ' has been added.');
                header('location:' . URL . 'customer/getExistingCustomers');
            } else {
                Session::set('errorMsg', $customerName . ' has been used. Please pick another name');
                header('location:' . URL . 'customer/index');
            }
        } else {
            header('location:' . URL . 'error/error');
        }
    }

    public function getExistingCustomers() {
        // retrieve all existing customers
        $sql = "SELECT * FROM CD";
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $numOfCustomers = $stm->rowCount();
            if ($numOfCustomers) {
                return $stm->fetchAll();
            }
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function getCustomer($customerName) {
        $sql = "SELECT * FROM CD WHERE `Customer Name`=:customerName";
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute(array(":customerName" => $customerName));
            return $stm->fetch();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function updateCustomer($formArray, $urlCustomerName) {
        $customerName = $formArray['customerName'];

        // Contact Info
        $address = $formArray['address'];
        // Suburb/State/Postcode
        if (!($formArray['customerAreaInfo'])) {
            $suburb = '';
            $state = '';
            $postcode = '';
        } else {
            $areaInfo = explode('-', $formArray['customerAreaInfo']);
            $suburb = str_replace('&nbsp;', ' ', $areaInfo[0]);
            $state = $areaInfo[1];
            $postcode = $areaInfo[2];
        }

        $contactPerson = $formArray['contactPerson'];
        $contactPosition = $formArray['contactPosition'];
        $contactTelephone = $formArray['contactTelephone'];
        $contactMobile = $formArray['contactMobile'];
        $contactFax = $formArray['contactFax'];

        // Billing Info
        $billingAddress = $formArray['billingAddress'];
        // Suburb/State/Postcode

        if (!($formArray['billingAreaInfo'])) {
            $billingSuburb = '';
            $billingState = '';
            $billingPostcode = '';
        } else {
            $billingAreaInfo = explode('-', $formArray['billingAreaInfo']);
            $billingSuburb = str_replace('&nbsp;', ' ', $billingAreaInfo[0]);
            $billingState = $billingAreaInfo[1];
            $billingPostcode = $billingAreaInfo[2];
        }

        // Agent Info
        $agent = $formArray['agent'];
        $agentPosition = $formArray['agentPosition'];
        $agentTelephone = $formArray['agentTelephone'];
        $agentMobile = $formArray['agentMobile'];
        $agentFax = $formArray['agentFax'];

        // Listing Info
        $listingAddress = $formArray['listingAddress'];
        // Suburb/State/Postcode
        if (!($formArray['listingAreaInfo'])) {
            $listingSuburb = '';
            $listingState = '';
            $listingPostcode = '';
        } else {
            $listingAreaInfo = explode('-', $formArray['listingAreaInfo']);
            $listingSuburb = str_replace('&nbsp;', ' ', $listingAreaInfo[0]);
            $listingState = $listingAreaInfo[1];
            $listingPostcode = $listingAreaInfo[2];
        }

        $listingPhone = $formArray['listingPhone'];
        $url = $formArray['url'];

        $sql = "UPDATE CD SET "
                . "`Address`=:address,"
                . "`Suburb`=:suburb,"
                . "`State`=:state,"
                . "`Post Code`=:postcode,"
                . "`Contact Person`=:contactPerson,"
                . "`Position`=:contactPosition,"
                . "`Contact Telephone`=:contactTelephone,"
                . "`Contact Mobile`=:contactMobile,"
                . "`Contact Fax`=:contactFax,"
                . "`Billing Address`=:billingAddress,"
                . "`Billing Suburb`=:billingSuburb,"
                . "`Billing State`=:billingState,"
                . "`Billing Post Code`=:billingPostcode,"
                . "`Agent`=:agent,"
                . "`Agent Position`=:agentPosition,"
                . "`Agent Phone`=:agentTelephone,"
                . "`Agent Fax`=:agentFax,"
                . "`Agent Mobile`=:agentMobile,"
                . "`Listing Address`=:listingAddress,"
                . "`Listing Suburb`=:listingSuburb,"
                . "`Listing State`=:listingState,"
                . "`Listing Post Code`=:listingPostcode,"
                . "`Listing Phone`=:listingPhone,"
                . "`URL`=:url WHERE `Customer Name`=:customerName";
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute(array(
                ':customerName' => $customerName,
                ':address' => $address,
                ':suburb' => $suburb,
                ':state' => $state,
                ':postcode' => $postcode,
                ':contactPerson' => $contactPerson,
                ':contactPosition' => $contactPosition,
                ':contactTelephone' => $contactTelephone,
                ':contactMobile' => $contactMobile,
                ':contactFax' => $contactFax,
                ':billingAddress' => $billingAddress,
                ':billingSuburb' => $billingSuburb,
                ':billingState' => $billingState,
                ':billingPostcode' => $billingPostcode,
                ':agent' => $agent,
                ':agentPosition' => $agentPosition,
                ':agentTelephone' => $agentTelephone,
                ':agentFax' => $agentFax,
                ':agentMobile' => $agentMobile,
                ':listingAddress' => $listingAddress,
                ':listingSuburb' => $listingSuburb,
                ':listingState' => $listingState,
                ':listingPostcode' => $listingPostcode,
                ':listingPhone' => $listingPhone,
                ':url' => $url));
            Session::set('message', $customerName . ' has been updated.');
            header('location:'. URL .'customer/getCustomerInfo/'.$urlCustomerName);
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

    public function deleteCustomer($customerName) {
        try {
            $sql = "DELETE FROM CD WHERE `Customer Name`=:customerName";
            $sql1 = "SELECT * FROM JD WHERE `Customer Name`=:customerName";
            $stm1 = $this->db->prepare($sql1);
            $stm1->execute(array(":customerName" => $customerName));
            if ($stm1->rowCount() > 0) {
                $remainedJobNos = $stm1->fetchAll();
                foreach ($remainedJobNos as $remainedJobNo) {
                    // Remove job items in JQ
                    $sql2 = "DELETE FROM JQ WHERE `Job No`=:jobNo";
                    $stm2 = $this->db->prepare($sql2);
                    $stm2->execute(array(":jobNo" => $remainedJobNo['Job No']));
                }
                // Remove the jobs in JD 
                $sql3 = "DELETE FROM JD WHERE `Customer Name`=:customerName";
                $stm3 = $this->db->prepare($sql3);
                $stm3->execute(array(":customerName" => $customerName));
            }
            // Remove the customer
            $stm = $this->db->prepare($sql);
            $stm->execute(array(":customerName" => $customerName));
            Session::set('message', $customerName . ' and the related jobs have been deleted.');
            header('location:' . URL . 'customer/getExistingCustomers');
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

}
