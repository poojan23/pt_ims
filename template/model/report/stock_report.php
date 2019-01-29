<?php

class ModelReportStockReport extends Model {

    public function getCustomerWiseCoilNo($customer_id, $date1, $date2) {
        $query = $this->db->query("SELECT coil_no FROM " . DB_PREFIX . "inward WHERE (inward_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ) AND customer_id = '" . (int) $customer_id . "'");

        return $query->rows;
    }

    public function getCustomerWiseReport($coil_no, $date1, $date2) {

        $query = $this->db->query("SELECT  i.gross_weight as inwardTotal,i.coil_no, sum(d.gross_weight) as outwardTotal"
                . " FROM " . DB_PREFIX . "inward as i"
                . " LEFT JOIN " . DB_PREFIX . "delivery d ON i.customer_id = d.customer_id"
                . " WHERE (i.inward_date BETWEEN  '" . $date1 . "' AND '" . $date2 . "') AND i.coil_no = '" . $this->db->escape($coil_no) . "'");

        return $query->rows;
    }

    public function getStockBalance($customer_id, $date1, $date2) {

        $query = $this->db->query("(SELECT p.product_code,pt.product_type,i.unique_id,i.inward_date as crtDate,i.customer_id,i.coil_no,i.thickness as inTh,
                                i.width as inWd,i.length as inL,i.pieces as inP, i.gross_weight,i.product_type_id,
                                i.product_id,'Credit' as Debit_Credit FROM " . DB_PREFIX . "inward  as i 
                                LEFT JOIN " . DB_PREFIX . "product p ON p.product_id = i.product_id
                                LEFT JOIN " . DB_PREFIX . "product_type pt ON pt.product_type_id =i.product_type_id
                                WHERE i.customer_id = '" . (int) $customer_id . "'  AND (i.inward_date  BETWEEN  '" . $date1 . "' AND '" . $date2 . "')) 

                                UNION All (SELECT p.product_code,CONCAT(c.firstname, ' ', c.lastname) AS customer,d.challan_no,d.delivery_date as crtDate,d.customer_id,d.coil_no,
                                d.thickness as dTh,d.width as dWd,d.length as dL,d.pieces as dP,
                                d.gross_weight,d.service_type,d.product_id,'Debit' as Debit_Credit 
                                FROM " . DB_PREFIX . "delivery as d 
                                LEFT JOIN " . DB_PREFIX . "product p ON p.product_id =d.product_id
                                LEFT JOIN " . DB_PREFIX . "customer c ON c.customer_id =d.customer_id
                                WHERE d.customer_id='" . (int) $customer_id . "' AND (d.delivery_date BETWEEN  '" . $date1 . "' AND '" . $date2 . "'))");

        return $query->rows;
    }

}
