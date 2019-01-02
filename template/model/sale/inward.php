<?php

class ModelSaleInward extends Model {

    public function addInward($data) {
        $truck_no = strtoupper($data['truck_no']);
        $coil_no = strtoupper($data['coil_no']);

        $this->db->query("INSERT INTO " . DB_PREFIX . "inward SET inward_date='" . $data['inward_date'] . "', customer_id = '" . (int) $data['customer_id'] . "', product_id = '" . (int) $data['product_id'] . "', product_type_id = '" . (int) $data['product_type_id'] . "', truck_no = '" . $this->db->escape($truck_no) . "', coil_no = '" . $this->db->escape($coil_no) . "',thickness = '" . $data['thickness'] . "', width = '" . $data['width'] . "',   `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "',  packaging = '" . (int) $data['packaging'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

        $inward_id = $this->db->lastInsertId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "inward_weight SET date_added='" . $data['inward_date'] . "',gross_weight='" . $data['gross_weight'] . "', net_weight = '" . $data['net_weight'] . "',inward_id = '" . (int) $inward_id . "', cutting_date='" . $data['inward_date'] . "'");

        return $inward_id;
    }

    public function editInward($inward_id, $data) {
        $truck_no = strtoupper($data['truck_no']);
        $this->db->query("UPDATE " . DB_PREFIX . "inward SET inward_date='" . $data['inward_date'] . "', customer_id = '" . (int) $data['customer_id'] . "', product_id = '" . (int) $data['product_id'] . "', truck_no = '" . $this->db->escape($truck_no) . "', thickness = '" . $data['thickness'] . "', width = '" . $data['width'] . "', `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "',  packaging = '" . (int) $data['packaging'] . "',  date_modified = NOW() WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET net_weight='" . $data['net_weight'] . "',gross_weight='" . $data['gross_weight'] . "' WHERE inward_id = '" . (int) $inward_id . "' limit 1");
    }

    public function deleteInward($inward_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_id = '" . (int) $inward_id . "'");
    }

    public function getInwards() {
        $query = $this->db->query("SELECT i.*,iw.net_weight,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type FROM " . DB_PREFIX . "inward i "
                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " INNER JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id group by i.inward_id");

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

}
