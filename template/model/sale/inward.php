<?php

class ModelSaleInward extends Model {

    public function addInward($data) {
        $truck_no = strtoupper($data['truck_no']);
        $coil_no = strtoupper($data['coil_no']);
        
//        $query = $this->db->query("SELECT coil_no FROM " . DB_PREFIX . "inward WHERE coil_no = '" . $this->db->escape($coil_no) . "'");
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "inward SET inward_date='" . $data['inward_date'] . "', customer_id = '" . (int) $data['customer_id'] . "', "
                . " product_id = '" . (int) $data['product_id'] . "', product_type_id = '" . (int) $data['product_type_id'] . "', truck_no = '" . $this->db->escape($truck_no) . "',"
                . " coil_no = '" . $this->db->escape($coil_no) . "',thickness = '" . $data['thickness'] . "', width = '" . $data['width'] . "',   `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "',"
                . " gross_weight='" . $data['gross_weight'] . "', net_weight = '" . $data['net_weight'] . "',  packaging = '" . (int) $data['packaging'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

        $inward_id = $this->db->lastInsertId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "inward_weight SET date_added='" . $data['inward_date'] . "',gross_weight='" . $data['gross_weight'] . "', net_weight = '" . $data['net_weight'] . "',inward_id = '" . (int) $inward_id . "', org_id = '1', cutting_date='" . $data['inward_date'] . "'");

        return $inward_id;
    }

    public function editInward($inward_id, $data) {
        $truck_no = strtoupper($data['truck_no']);
        $this->db->query("UPDATE " . DB_PREFIX . "inward SET inward_date='" . $data['inward_date'] . "', customer_id = '" . (int) $data['customer_id'] . "', product_id = '" . (int) $data['product_id'] . "',net_weight='" . $data['net_weight'] . "',gross_weight='" . $data['gross_weight'] . "',"
                . " truck_no = '" . $this->db->escape($truck_no) . "', thickness = '" . $data['thickness'] . "', width = '" . $data['width'] . "', `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "',  packaging = '" . (int) $data['packaging'] . "',"
                . " date_modified = NOW() WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET net_weight='" . $data['net_weight'] . "',gross_weight='" . $data['gross_weight'] . "' WHERE inward_id = '" . (int) $inward_id . "' limit 1");
    }

    public function deleteInward($inward_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_id = '" . (int) $inward_id . "'");
    }

    public function getInwards() {
        $query = $this->db->query("SELECT i.*,i.net_weight,i.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type,pt.product_type_id FROM " . DB_PREFIX . "inward i "
//                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " LEFT JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id = pt.product_type_id  ORDER BY i.inward_date DESC");

        return $query->rows;
    }

    public function getInwardReport() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');

        $query = $this->db->query("SELECT i.*,sum(iw.gross_weight) as totalInward,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type,pt.product_type_id FROM " . DB_PREFIX . "inward i "
                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " INNER JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id"
                . " WHERE (iw.date_added BETWEEN '" . $first_day_this_month . "' AND '" . $last_day_this_month . "' ) GROUP BY i.customer_id ORDER BY totalInward DESC limit 10");

        return $query->rows;
    }

    public function getInwardSummary() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');

        $query = $this->db->query("SELECT i.*,sum(i.gross_weight) as totalInward,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " WHERE (i.date_added BETWEEN '" . $first_day_this_month . "' AND '" . $last_day_this_month . "' ) GROUP BY i.customer_id");

        return $query->rows;
    }

    public function getWeeklyInward() {
        $date2 = date('Y-m-d');
        $date1 = date('Y-m-d');
        $date1 = date('Y-m-d', strtotime($date1 . ' -6 day'));
                
        $query = $this->db->query("SELECT i.*,sum(i.gross_weight) as totalInward,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " WHERE (i.date_added BETWEEN '" . $date1 . "' AND '" . $date2 . "' ) GROUP BY i.inward_date");

        return $query->rows;
    }

    public function getMonthlyInward() {
        $date1 = date('Y-m-01');
        $date2 =  date('Y-m-t');

        $query = $this->db->query("SELECT i.*,sum(i.gross_weight) as totalInward,sum(i.thickness) as totalThickness,(DATE_FORMAT(i.inward_date,'%Y-%m'))  as crt,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " WHERE (i.inward_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ) GROUP BY DATE_FORMAT(i.inward_date,'%m')");

        return $query->rows;
    }
    
    public function getQuarterlyInward($date1,$date2) {

        $query = $this->db->query("SELECT i.*,sum(i.gross_weight) as totalInward,(DATE_FORMAT(i.inward_date,'%Y-%m'))  as crt,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " WHERE (i.inward_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ) GROUP BY DATE_FORMAT(i.inward_date,'%m')");

        return $query->rows;
    }
    public function getYearlyInward($date1,$date2) {

        $query = $this->db->query("SELECT i.*,sum(i.gross_weight) as totalInward,(DATE_FORMAT(i.inward_date,'%Y'))  as crt,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " WHERE (i.inward_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ) GROUP BY DATE_FORMAT(i.inward_date,'%Y')");

        return $query->rows;
    }

    public function getInward($inward_id) {

        $query = $this->db->query("SELECT i.*,iw.net_weight,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type FROM " . DB_PREFIX . "inward i "
                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " INNER JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id where i.inward_id = '" . $inward_id . "' group by i.inward_id");

        return $query->row;
    }

    public function getTotalInward() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "inward_details");

        return $query->row['total'];
    }

    public function getTotalInwards() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');

        $query = $this->db->query("SELECT SUM(gross_weight) AS total FROM " . DB_PREFIX . "inward_weight where (date_added BETWEEN '" . $first_day_this_month . "' AND '" . $last_day_this_month . "' )");

        return $query->row['total'];
    }

    public function getCoilNo($coil_no) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward WHERE coil_no = '" . $this->db->escape($coil_no) . "'");

        return $query->row;
    }
    
    public function getproductType($product_type) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type WHERE product_type_id = '" . (int)($product_type) . "'");

        return $query->row;
    }
    
    public function getCoilNosByCustomerId($customer_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward WHERE customer_id = '" . $customer_id . "'");

        return $query->rows;
    }

    public function getGrade() {

        $query = $this->db->query("SELECT count(i.product_id)as gd,p.product_code FROM " . DB_PREFIX . "inward as i"
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . "  GROUP BY i.product_id");

        return $query->rows;
    }

    public function getInwardDetailsByCoilNo($coil_no) {
        $query = $this->db->query("SELECT i.*,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type FROM " . DB_PREFIX . "inward i "
       
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id = pt.product_type_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id WHERE i.coil_no = '" . $coil_no . "'");

        return $query->row;
    }

}
