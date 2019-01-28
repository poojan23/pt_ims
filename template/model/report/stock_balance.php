<?php

class ModelReportStockBalance extends Model {

    public function getStockReport($date1,$date2) {
    
        $query = $this->db->query("SELECT  o.customer_id,o.opening_gross_weight,o.closing_gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,i.gross_weight as inwardTotal,sum(d.gross_weight) as outwardTotal FROM " . DB_PREFIX . "clop as o 
            LEFT JOIN " . DB_PREFIX . "inward i on o.customer_id =i.customer_id
            LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id 
            LEFT JOIN " . DB_PREFIX . "delivery d on o.customer_id =d.customer_id WHERE (i.inward_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' )");

        return $query->rows;
    }

    public function getValue($code) {
        $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "statistics WHERE `code` = '" . $this->db->escape($code) . "'");

        if ($query->num_rows) {
            return $query->row['value'];
        } else {
            return null;
        }
    }

    public function addValue($code, $value) {
        $this->db->query("UPDATE " . DB_PREFIX . "statistics SET `value` = (`value` + '" . (float) $value . "') WHERE `code` = '" . $this->db->escape($code) . "'");
    }

    public function editValue($code, $value) {
        $this->db->query("UPDATE " . DB_PREFIX . "statistics SET `value` = '" . (float) $value . "' WHERE `code` = '" . $this->db->escape($code) . "'");
    }

    public function removeValue($code, $value) {
        $this->db->query("UPDATE " . DB_PREFIX . "statistics SET `value` = (`value` - '" . (float) $value . "') WHERE `code` = '" . $this->db->escape($code) . "'");
    }

}
