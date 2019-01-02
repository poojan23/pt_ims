<?php

class ModelSaleOrder extends Model {

    public function addOrder($data) {
        $order_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE coil_no = '" . (string) $data['coil_no'] . "'");

        if ($order_info->num_rows) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");

            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET cutting_date = '" . $data['order_date'] . "' WHERE inward_weight_id = '" . (int) $query->row['inward_weight_id'] . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "inward_weight SET inward_id = '" . (int) $data['hdnInwardId'] . "',date_added='" . $data['order_date'] . "',cutting_date='" . $data['order_date'] . "', net_weight = '" . ($query->row['net_weight'] - $data['netWeight']) . "',gross_weight='" . $data['hdnGrossWeight'] . "'");

                $inward_weight_id = $this->db->lastInsertId();

                $this->db->query("INSERT INTO " . DB_PREFIX . "order SET order_date='" . $data['order_date'] . "', coil_no='" . $data['coil_no'] . "', customer_id='" . (int) $data['hdnCustomerId'] . "', inward_id='" . (int) $data['hdnInwardId'] . "', inward_weight_id='" . (int) $inward_weight_id . "', product_id='" . (int) $data['hdnProductId'] . "', thickness = '" . (int) $data['hdnthickness'] . "', width = '" . (int) $data['hdnwidth'] . "', `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['service_type'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

                $order_id = $this->db->lastInsertId();

                $date = date('Y');

                $this->db->query("UPDATE " . DB_PREFIX . "order SET order_no = '" . ($data['service_type'] . '/' . $date . '/' . $order_id ) . "' WHERE order_id = '" . $order_id . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "order_weight SET date_added='" . $data['order_date'] . "', net_weight = '" . $data['netWeight'] . "',pieces = '" . (int) $data['pieces'] . "',order_id = '" . (int) $order_id . "', delivery_date='" . $data['order_date'] . "'");
            }
        } else {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_id = '" . (int) $data['hdnInwardId'] . "'");

            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET cutting_date = '" . $data['order_date'] . "' WHERE inward_weight_id = '" . (int) $query->row['inward_weight_id'] . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "inward_weight SET inward_id = '" . (int) $data['hdnInwardId'] . "',date_added='" . $data['order_date'] . "',cutting_date='" . $data['order_date'] . "', net_weight = '" . ($query->row['net_weight'] - $data['netWeight']) . "',gross_weight='" . $data['hdnGrossWeight'] . "'");

                $inward_weight_id = $this->db->lastInsertId();

                $this->db->query("INSERT INTO " . DB_PREFIX . "order SET order_date='" . $data['order_date'] . "', coil_no='" . $data['coil_no'] . "', customer_id='" . (int) $data['hdnCustomerId'] . "', inward_id='" . (int) $data['hdnInwardId'] . "', inward_weight_id='" . (int) $inward_weight_id . "', product_id='" . (int) $data['hdnProductId'] . "', thickness = '" . (int) $data['hdnthickness'] . "', width = '" . (int) $data['hdnwidth'] . "', `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['service_type'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

                $order_id = $this->db->lastInsertId();

                $date = date('Y');

                $this->db->query("UPDATE " . DB_PREFIX . "order SET order_no = '" . ($data['service_type'] . '/' . $date . '/' . $order_id ) . "' WHERE order_id = '" . $order_id . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "order_weight SET date_added='" . $data['order_date'] . "', net_weight = '" . $data['netWeight'] . "',pieces = '" . (int) $data['pieces'] . "',order_id = '" . (int) $order_id . "', delivery_date='" . $data['order_date'] . "'");
            }
        }

        return $order_id;
    }

    public function editOrder($order_id, $data) {
        $order_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "'");

        if ($order_info->num_rows) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");

            if ($query->row) {
                $net_weight = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $order_id . "'");
                $cal_net_weight = $query->row['net_weight'] + ($net_weight->row['net_weight'] - $data['netWeight']);

                $this->db->query("UPDATE " . DB_PREFIX . "order SET  `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['service_type'] . "' WHERE order_id = '" . (int) $order_id . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "order_weight SET net_weight='" . $data['netWeight'] . "' , `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "' WHERE order_id = '" . (int) $order_id . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET net_weight='" . $cal_net_weight . "'  WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");
            }
        }
    }

    public function deleteOrder($order_id) {
        $order_info = $this->db->query("SELECT inward_weight_id FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $order_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");
    }

    public function getOrders() {
        $query = $this->db->query("SELECT o.*,ow.net_weight,DATEDIFF(iw.cutting_date, iw.date_added) as aging,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "order o "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON o.order_id = ow.order_id"
                . " LEFT JOIN " . DB_PREFIX . "inward_weight iw ON o.inward_weight_id = iw.inward_weight_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON o.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON o.product_id = p.product_id group by o.order_id");

        return $query->rows;
    }

    public function getCoilNo() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order group by coil_no");

        return $query->rows;
    }

    public function getOrder($order_id) {
        $query = $this->db->query("SELECT o.*,ow.net_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "order o "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON o.order_id = ow.order_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON o.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON o.product_id = p.product_id  where o.order_id = '" . $order_id . "' group by o.order_id");

        return $query->row;
    }

    public function getOrderDetailsByCoilNo($coil_no) {
        $query = $this->db->query("SELECT i.*,iw.inward_weight_id,iw.net_weight,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type FROM " . DB_PREFIX . "inward i "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " LEFT JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id where i.coil_no = '" . $coil_no . "'");

        return $query->row;
    }

    public function getTotalOrder() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "inward_details");

        return $query->row['total'];
    }

}
