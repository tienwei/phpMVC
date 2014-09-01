<?php

class Job_Model extends Model {

    function __construct($dbYear) {
        parent::__construct($dbYear);
    }

    public function saveJob($form) {
        // JD fields
        if ($form['invoiceDate'] != 'Not Specified') {
            $date1 = implode("-", array_reverse(explode("/", $form['invoiceDate'])));
            $invoiceDate = date('Y-m-d', strtotime($date1));
        } else {
            $invoiceDate = NULL;
        }
        if ($form['contractDate'] != 'Not Specified') {
            $date2 = implode("-", array_reverse(explode("/", $form['contractDate'])));
            $contractDate = date('Y-m-d', strtotime($date2));
        } else {
            $contractDate = NULL;
        }
        $salesCode = substr($form['jobNo'], 0, 4);

        try {
            if (isset($form['addJob'])) {
                // insert a new job
                //check job no.
                $sql = "SELECT * FROM JD WHERE `Job No`=:jobNo";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array(":jobNo" => $form['jobNo']));
                $check = $stmt->rowCount();
                if ($check == 0) {
                    // JQ fields
                    // $form['unit'], $form['classification'], $form['payable'], $form['nett'] 
                    $units = array(1, 2, 3, 4, 5, 6, 7, 8);
                    $subTotal = 0.0;
                    //$this->db->beginTransaction();
                    foreach ($units as $unitNo) {
                        if (!empty($form['unit' . $unitNo])) {
                            // add job items
                            $sql1 = "INSERT INTO JQ (`Job No`, `Display Unit`, `Classification`, "
                                    . "`Unit Amount`, `Rebated`, `Nett`) VALUES (:jobNo, :displayUnit, "
                                    . ":classification,:payable,:rebated,:nett)";
                            $stmt1 = $this->db->prepare($sql1);
                            $stmt1->execute(array(":jobNo" => $form['jobNo'],
                                ":displayUnit" => $form['unit' . $unitNo],
                                ":classification" => $form['classification' . $unitNo],
                                ":payable" => floatval($form['payable' . $unitNo]),
                                ":rebated" => floatval($form['payable' . $unitNo]) - floatval($form['nett' . $unitNo]),
                                ":nett" => floatval($form['nett' . $unitNo])));
                            $subTotal += $form['nett' . $unitNo];
                        }
                    }
                    // payment
                    $gst = $subTotal * 0.1; // 10% GST rate
                    $payable = $subTotal * 1.1;
                    $oustanding = $payable - $form['paid'];

                    $sql2 = "INSERT INTO JD (`Customer Name`, `Job No`, `Invoice Date`, "
                            . "`Contract Date`, `Sales Code`, `Payment Remark`, "
                            . "`Cheque`, `Cash`, `SC(F/P)`, `Customer Material`, "
                            . "`Designed by BCC`, `Supplied by Agency`, `Special Request`,"
                            . "`Deposit`, `Subtotal`, `Amount Payable`, `Paid`,"
                            . "`Outstanding`, `Film`, `Bromide`, `Photography`, `GST`) "
                            . "VALUES (:customerName, :jobNo, :invoiceDate, :contractDate, "
                            . ":salesCode, :remarks, :cheque, :cash, :sc, :customerMaterial,"
                            . ":designedByBCC, :suppliedByAgency, :specialRequest,"
                            . ":deposit, :subTotal, :amountPayable, :paid, :outstanding,"
                            . ":film, :bromide, :photo, :gst)";
                    $stmt2 = $this->db->prepare($sql2);
                    $stmt2->execute(array(":customerName" => $form['customerName'],
                        ":jobNo" => $form['jobNo'],
                        ":invoiceDate" => $invoiceDate,
                        ":contractDate" => $contractDate,
                        ":salesCode" => $salesCode,
                        ":remarks" => $form['remarks'],
                        ":cheque" => isset($form['cheque']),
                        ":cash" => isset($form['cash']),
                        ":sc" => $form['sc'],
                        ":customerMaterial" => isset($form['customerMaterial']),
                        ":designedByBCC" => isset($form['designedByBCC']),
                        ":suppliedByAgency" => isset($form['suppliedByAgency']),
                        ":specialRequest" => $form['specialRequest'],
                        ":subTotal" => $subTotal,
                        ":deposit" => floatval($form['deposit']),
                        ":amountPayable" => $payable,
                        ":paid" => floatval($form['paid']),
                        ":outstanding" => $oustanding,
                        ":film" => isset($form['film']),
                        ":bromide" => isset($form['bromide']),
                        ":photo" => isset($form['photo']),
                        ":gst" => $gst));
                    Session::set('message', 'The job has been added.');
                    header('location:' . URL . 'job/retrieveJobs/' . $form['urlCustomerName']);
                } else {
                    Session::set('errorMsg', 'The job No. has existed. Please add a new one');
                    header('location:' . URL . 'job/index/' . $form['urlCustomerName']);
                }
            } else {
                // update the job
                // JQ fields
                // $form['unit'], $form['classification'], $form['payable'], $form['nett'] 
                $units = array(1, 2, 3, 4, 5, 6, 7, 8);
                $subTotal = 0.0;

                foreach ($units as $unitNo) {
                    if (!empty($form['unit' . $unitNo])) {
                        $sql = "SELECT * FROM JQ WHERE `ID`=:ID";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute(array(":ID" => $form['ID' . $unitNo]));
                        $checkJobItem = $stmt->rowCount();
                        if ($checkJobItem == 0) {
                            // add job items
                            $sql1 = "INSERT INTO JQ (`Job No`, `Display Unit`, `Classification`, "
                                    . "`Unit Amount`, `Rebated`, `Nett`) VALUES (:jobNo, :displayUnit, "
                                    . ":classification,:payable,:rebated,:nett)";
                            $stmt1 = $this->db->prepare($sql1);
                            $stmt1->execute(array(":jobNo" => $form['jobNo'],
                                ":displayUnit" => $form['unit' . $unitNo],
                                ":classification" => $form['classification' . $unitNo],
                                ":payable" => floatval($form['payable' . $unitNo]),
                                ":rebated" => floatval($form['payable' . $unitNo]) - floatval($form['nett' . $unitNo]),
                                ":nett" => floatval($form['nett' . $unitNo])));
                            $subTotal += $form['nett' . $unitNo];
                        } else {
                            if (!empty($form['unit' . $unitNo])) {
                                // update job items
                                $sql1 = "UPDATE JQ SET"
                                        . "`Job No`=:jobNo, `Display Unit`=:displayUnit, "
                                        . "`Classification`=:classification, "
                                        . "`Unit Amount`=:payable, `Rebated`=:rebated, "
                                        . "`Nett`=:nett WHERE `ID`=:ID";
                                $stmt1 = $this->db->prepare($sql1);
                                $stmt1->execute(array(":jobNo" => $form['jobNo'],
                                    ":displayUnit" => $form['unit' . $unitNo],
                                    ":classification" => $form['classification' . $unitNo],
                                    ":payable" => floatval($form['payable' . $unitNo]),
                                    ":rebated" => floatval($form['payable' . $unitNo]) - floatval($form['nett' . $unitNo]),
                                    ":nett" => floatval($form['nett' . $unitNo]),
                                    ":ID" => $form['ID' . $unitNo]));
                                $subTotal += $form['nett' . $unitNo];
                            }
                        }
                    } else if (!empty($form['ID' . $unitNo])) {
                        $sql = "DELETE FROM JQ WHERE `ID`=:ID";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute(array(":ID" => $form['ID' . $unitNo]));
                    }
                }

                // payment
                $gst = $subTotal * 0.1; // 10% GST rate
                $payable = $subTotal * 1.1;
                $oustanding = $payable - $form['paid'];

                $sql2 = "UPDATE JD SET"
                        . "`Invoice Date`=:invoiceDate, "
                        . "`Contract Date`=:contractDate, "
                        . "`Payment Remark`=:remarks, `Cheque`=:cheque, "
                        . "`Cash`=:cash, `SC(F/P)`=:sc, "
                        . "`Customer Material`=:customerMaterial, "
                        . "`Designed by BCC`=:designedByBCC, "
                        . "`Supplied by Agency`=:suppliedByAgency, "
                        . "`Special Request`=:specialRequest,"
                        . "`Deposit`=:deposit, `Subtotal`=:subTotal, "
                        . "`Amount Payable`=:amountPayable, `Paid`=:paid,"
                        . "`Outstanding`=:outstanding, `Film`=:film, "
                        . "`Bromide`=:bromide, `Photography`=:photo, `GST`=:gst "
                        . "WHERE `Job No`=:jobNo";
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->execute(array(
                    ":jobNo" => $form['jobNo'],
                    ":invoiceDate" => $invoiceDate,
                    ":contractDate" => $contractDate,
                    ":remarks" => $form['remarks'],
                    ":cheque" => isset($form['cheque']),
                    ":cash" => isset($form['cash']),
                    ":sc" => $form['sc'],
                    ":customerMaterial" => isset($form['customerMaterial']),
                    ":designedByBCC" => isset($form['designedByBCC']),
                    ":suppliedByAgency" => isset($form['suppliedByAgency']),
                    ":specialRequest" => $form['specialRequest'],
                    ":subTotal" => $subTotal,
                    ":deposit" => floatval($form['deposit']),
                    ":amountPayable" => $payable,
                    ":paid" => floatval($form['paid']),
                    ":outstanding" => $oustanding,
                    ":film" => isset($form['film']),
                    ":bromide" => isset($form['bromide']),
                    ":photo" => isset($form['photo']),
                    ":gst" => $gst));

                Session::set('message', 'The job has been updated.');
                header('location:' . URL . 'job/retrieveJobs/' . $form['urlCustomerName']);
            }
        } catch (PDOException $e) {
            //$this->db->rollBack();
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
    }

    public function getJobByJobNo($jobNo) {
        try {
            $sql1 = "SELECT * FROM JD WHERE `Job No` = :jobNo";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute(array(":jobNo" => $jobNo));

            $sql2 = "SELECT * FROM JQ WHERE `Job No` = :jobNo";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->execute(array(":jobNo" => $jobNo));

            return Array($stmt1->fetchAll(), $stmt2->fetchAll());
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function retrieveJobs($customerName) {
        try {
            $sql1 = "SELECT * FROM JD WHERE `Customer Name` = "
                    . ":customerName ORDER BY `Contract Date`";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute(array(":customerName" => $customerName));
            if ($stmt1->rowCount() > 0) {
                return $stmt1->fetchAll();
            }
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function retrieveJobItems($jobNo) {
        try {
            $sql1 = "SELECT * FROM JQ WHERE `Job No` = :jobNo";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute(array(":jobNo" => $jobNo));
            return $stmt1->fetchAll();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function getAllJobs() {
        try {
            $sql1 = "SELECT * FROM JD "
                    . "ORDER BY `Customer Name`";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute();
            return $stmt1->fetchAll();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function getAllJobItems() {
        try {
            $sql1 = "SELECT * FROM JQ "
                    . "ORDER BY `Classification`";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute();
            return $stmt1->fetchAll();
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function getOutstandingJobs() {
        try {
            $sql1 = "SELECT * FROM JD WHERE `Outstanding` > 0.0 "
                    . "ORDER BY `Customer Name`";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute();
            if ($stmt1->rowCount() > 0) {
                return $stmt1->fetchAll();
            }
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function getPaidoffJobs() {
        try {
            $sql1 = "SELECT * FROM JD WHERE `Amount Payable` = `Paid` "
                    . "ORDER BY `Customer Name`";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute();
            if ($stmt1->rowCount() > 0) {
                return $stmt1->fetchAll();
            }
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

    public function deleteJob($customerName, $urlCustomerName) {
        try {
            $sql1 = "SELECT * FROM JD WHERE `Customer Name` = "
                    . ":customerName";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->execute(array(":customerName" => $customerName));
            if ($stmt1->rowCount() > 0) {
                $jobs = $stmt1->fetchAll();
                // Remove job items from JQ
                foreach ($jobs as $job) {
                    $sql2 = "DELETE FROM JQ WHERE `Job No`=:jobNo";
                    $stmt2 = $this->db->prepare($sql2);
                    $stmt2->execute(array(":jobNo" => $job['Job No']));
                }
                $sql3 = "DELETE FROM JD WHERE `Customer Name` = "
                        . ":customerName";

                // Remove the job from JD
                $stmt3 = $this->db->prepare($sql3);
                $stmt3->execute(array(":customerName" => $customerName));
            }
            Session::set('message', 'The job has been deleted.');
            header('location:' . URL . 'job/retrieveJobs/' . $urlCustomerName);
        } catch (PDOException $e) {
            Session::set('errorMsg', $e->getMessage());
            header('location:' . URL . 'error/error');
        }
        return 0;
    }

}
