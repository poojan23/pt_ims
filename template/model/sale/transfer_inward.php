<?php

class ModelSaleTransferInward extends Model {

    public function addTransferInward($data) {
        $truck_no = strtoupper($data['truck_no']);
        $coil_no = strtoupper($data['coil_no']);
        $trans_coil_no = strtoupper($data['coil_no'] . '-T');

        $this->db->query("INSERT INTO " . DB_PREFIX . "transfer_inward SET transfer_date='" . $data['transfer_date'] . "',org_id = '1' ,inward_id = '" . (int) $data['hdnInwardId'] . "',customer_id_from = '" . (int) $data['customer_id'] . "', "
                . "product_id = '" . (int) $data['hdnProductId'] . "',customer_id_to = '" . (int) $data['transfer_to'] . "', product_type_id = '" . (int) $data['hdnProductTypeId'] . "', truck_no = '" . $this->db->escape($truck_no) . "', "
                . "coil_no = '" . $this->db->escape($coil_no) . "',trans_coil_no = '" . $this->db->escape($trans_coil_no) . "',thickness = '" . $data['hdnThickness'] . "', width = '" . $data['hdnWidth'] . "',   `length` = '" . $data['hdnLength'] . "', "
                . " `pieces` = '" . $data['hdnPieces'] . "',  packaging = '" . (int) $data['packaging'] . "',gross_weight='" . $data['hdnGrossWeight'] . "', net_weight = '" . $data['hdnNetWeight'] . "',is_cut = '0', status = '1', date_modified = NOW(), date_added = NOW()");

        $this->db->query("INSERT INTO " . DB_PREFIX . "inward SET inward_date='" . $data['transfer_date'] . "', customer_id = '" . (int) $data['customer_id'] . "',"
                . " product_id = '" . (int) $data['hdnProductId'] . "', product_type_id = '" . (int) $data['hdnProductTypeId'] . "', truck_no = '" . $this->db->escape($truck_no) . "',"
                . " coil_no = '" . $this->db->escape($trans_coil_no) . "',thickness = '" . $data['hdnThickness'] . "', width = '" . $data['hdnWidth'] . "',   `length` = '" . $data['hdnLength'] . "', "
                . " `pieces` = '" . $data['hdnPieces'] . "',  packaging = '" . (int) $data['packaging'] . "', status = '1', date_modified = NOW(), date_added = NOW()");


        $inward_id = $this->db->lastInsertId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "inward_weight SET date_added='" . $data['transfer_date'] . "',gross_weight='" . $data['hdnGrossWeight'] . "', net_weight = '" . $data['hdnNetWeight'] . "',inward_id = '" . (int) $inward_id . "', cutting_date='" . $data['transfer_date'] . "'");


        $this->db->query("INSERT INTO " . DB_PREFIX . "transfer_outward SET inward_date='" . $data['transfer_date'] . "', org_id = '1' , inward_id = '" . (int) $data['hdnInwardId'] . "', customer_id = '" . (int) $data['customer_id'] . "',"
                . " product_id = '" . (int) $data['hdnProductId'] . "', product_type_id = '" . (int) $data['hdnProductTypeId'] . "', truck_no = '" . $this->db->escape($truck_no) . "',"
                . " coil_no = '" . $this->db->escape($trans_coil_no) . "',thickness = '" . $data['hdnThickness'] . "', width = '" . $data['hdnWidth'] . "',   `length` = '" . $data['hdnLength'] . "', "
                . " `pieces` = '" . $data['hdnPieces'] . "',gross_weight='" . $data['hdnGrossWeight'] . "', net_weight = '" . $data['hdnNetWeight'] . "',  "
                . "packaging = '" . (int) $data['packaging'] . "', status = '1', date_added = NOW()");

        $this->db->query("DELETE FROM " . DB_PREFIX . "inward WHERE inward_id = '" . (int) $data['hdnInwardId'] . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_id = '" . (int) $data['hdnInwardId'] . "'");

        return $inward_id;
    }

    public function editTransferInward($inward_id, $data) {
        $truck_no = strtoupper($data['truck_no']);
        $this->db->query("UPDATE " . DB_PREFIX . "inward SET inward_date='" . $data['inward_date'] . "', customer_id = '" . (int) $data['customer_id'] . "', product_id = '" . (int) $data['product_id'] . "', truck_no = '" . $this->db->escape($truck_no) . "', thickness = '" . $data['thickness'] . "', width = '" . $data['width'] . "', `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "',  packaging = '" . (int) $data['packaging'] . "',  date_modified = NOW() WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET net_weight='" . $data['net_weight'] . "',gross_weight='" . $data['gross_weight'] . "' WHERE inward_id = '" . (int) $inward_id . "' limit 1");
    }

    public function deleteTransferInward($inward_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward WHERE inward_id = '" . (int) $inward_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_id = '" . (int) $inward_id . "'");
    }

    public function getTransferInwards() {

        $query = $this->db->query("SELECT ti.*,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type FROM " . DB_PREFIX . "transfer_inward ti "
                . " INNER JOIN " . DB_PREFIX . "customer c ON ti.customer_id_from = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON ti.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON ti.product_type_id=pt.product_type_id");

        return $query->rows;
    }

    public function getTransferInward($inward_id) {
        $query = $this->db->query("SELECT i.*,iw.net_weight,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type,pt.product_type_id FROM " . DB_PREFIX . "inward i "
                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " INNER JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id where i.inward_id = '" . $inward_id . "' group by i.inward_id");

        return $query->row;
    }

    public function getTotalTransferInward() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "inward_details");

        return $query->row['total'];
    }

}
