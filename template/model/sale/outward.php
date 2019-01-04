<?php

class ModelSaleOutward extends Model {

    public function addOutward($data) {
        $outward_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE order_no = '" . (string) $data['order_no'] . "'");

        if ($outward_info->num_rows) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $outward_info->row['order_id'] . "'");

            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "order_weight SET delivery_date = '" . $data['delivery_date'] . "' WHERE order_no = '" . (string) $data['order_no'] . "'");

                $inward_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . $outward_info->row['inward_weight_id'] . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET gross_weight = '" . ($inward_info->row['gross_weight'] - $data['gross_weight']) . "' WHERE inward_weight_id = '" . $outward_info->row['inward_weight_id'] . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "order_weight SET order_id = '" . (int) $data['hdnOrderId'] . "',order_no = '" . $data['order_no'] . "',date_added='" . $data['delivery_date'] . "',delivery_date='" . $data['delivery_date'] . "', net_weight = '" . $query->row['net_weight'] . "',pieces='" . ($query->row['pieces'] - $data['pieces']) . "'");

                $order_weight_id = $this->db->lastInsertId();

                $this->db->query("INSERT INTO " . DB_PREFIX . "delivery SET delivery_date='" . $data['delivery_date'] . "', coil_no='" . $data['coil_no'] . "', challan_no='" . $data['challan_no'] . "', customer_id='" . (int) $data['hdnCustomerId'] . "',org_id='0', truck_no='" . $data['truck_no'] . "', order_id='" . (int) $data['hdnOrderId'] . "', order_weight_id='" . (int) $order_weight_id . "', product_id='" . (int) $data['hdnProductId'] . "', thickness = '" . $data['hdnthickness'] . "', width = '" . $data['hdnwidth'] . "', `length` = '" . $data['hdnlength'] . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['hdnservice'] . "', gross_weight='" . $data['gross_weight'] . "', packaging='" . (int) $data['packaging'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

                $delivery_id = $this->db->lastInsertId();
            }
        } else {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $data['hdnOrderId'] . "'");

            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "order_weight SET delivery_date = '" . $data['delivery_date'] . "' WHERE order_weight_id = '" . $query->row['order_weight_id'] . "'");

                $inward_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . $outward_info->row['inward_weight_id'] . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET gross_weight = '" . ($inward_info->row['gross_weight'] - $data['gross_weight']) . "' WHERE inward_weight_id = '" . $outward_info->row['inward_weight_id'] . "'");

                $this->db->query("INSERT INTO " . DB_PREFIX . "order_weight SET order_id = '" . (int) $data['hdnOrderId'] . "',order_no = '" . $data['order_no'] . "',date_added='" . $data['delivery_date'] . "',delivery_date='" . $data['delivery_date'] . "', net_weight = '" . $query->row['net_weight'] . "',pieces='" . $data['pieces'] . "'");

                $order_weight_id = $this->db->lastInsertId();

                $this->db->query("INSERT INTO " . DB_PREFIX . "delivery SET delivery_date='" . $data['delivery_date'] . "', coil_no='" . $data['coil_no'] . "', challan_no='" . $data['challan_no'] . "', customer_id='" . (int) $data['hdnCustomerId'] . "',org_id='0', truck_no='" . $data['truck_no'] . "', order_id='" . (int) $data['hdnOrderId'] . "', order_weight_id='" . (int) $order_weight_id . "', product_id='" . (int) $data['hdnProductId'] . "', thickness = '" . $data['hdnthickness'] . "', width = '" . $data['hdnwidth'] . "', `length` = '" . $data['hdnlength'] . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['hdnservice'] . "', gross_weight='" . $data['gross_weight'] . "', packaging='" . (int) $data['packaging'] . "', status = '1', date_modified = NOW(), date_added = NOW()");

                $delivery_id = $this->db->lastInsertId();
            }
        }

        return $delivery_id;
    }

    public function editOutward($delivery_id, $data) {
        $order_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "delivery WHERE delivery_id = '" . (int) $delivery_id . "'");

        if ($order_info->num_rows) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_weight_id = '" . (int) $order_info->row['order_weight_id'] . "'");

            if ($query->row) {
                $inward_weight_id = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $query->row['order_id'] . "'");

                $gross_weight = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $inward_weight_id->row['inward_weight_id'] . "'");

                $cal_gross_weight = $order_info->row['gross_weight'] + ($gross_weight->row['gross_weight'] - $data['gross_weight']);

                $cal_pieces = $order_info->row['pieces'] + ($query->row['pieces'] - $data['pieces']);

                $this->db->query("UPDATE " . DB_PREFIX . "delivery SET  delivery_date='" . $data['delivery_date'] . "', truck_no='" . $data['truck_no'] . "',   challan_no='" . $data['challan_no'] . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', gross_weight ='" . $data['gross_weight'] . "', packaging='" . (int) $data['packaging'] . "'  WHERE delivery_id = '" . (int) $delivery_id . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "order_weight SET  `pieces` = '" . $cal_pieces . "' WHERE order_weight_id = '" . (int) $order_info->row['order_weight_id'] . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET gross_weight='" . $cal_gross_weight . "'  WHERE inward_weight_id = '" . (int) $inward_weight_id->row['inward_weight_id'] . "'");
            }
        }
    }

    public function deleteOutward($delivery_id) {
        $order_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "delivery WHERE delivery_id = '" . (int) $delivery_id . "'");

        if ($order_info->num_rows) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_weight_id = '" . (int) $order_info->row['order_weight_id'] . "'");

            if ($query->row) {
                $inward_weight_id = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $query->row['order_id'] . "'");

                $gross_weight = $this->db->query("SELECT * FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $inward_weight_id->row['inward_weight_id'] . "'");
               
                $cal_gross_weight = ($order_info->row['gross_weight'] + $gross_weight->row['gross_weight']);
                
                $cal_pieces = $order_info->row['pieces'] + $query->row['pieces'];

                $this->db->query("INSERT INTO " . DB_PREFIX . "cancel_delivery SET order_id = '" . (int) $order_info->row['order_id'] . "', org_id = '1' ,delivery_id = '" . $delivery_id . "',"
                        . " customer_id='" . (int) $order_info->row['customer_id'] . "',truck_no='" . (int) $order_info->row['truck_no'] . "',product_id='" . (int) $order_info->row['product_id'] . "',"
                        . " coil_no = '" . $order_info->row['coil_no'] . "',challan_no='" . (int) $order_info->row['challan_no'] . "',thickness='" . (int) $order_info->row['thickness'] . "',"
                        . " width='" . (int) $order_info->row['width'] . "',length='" . (int) $order_info->row['length'] . "',pieces='" . (int) $order_info->row['pieces'] . "',service_type='" . (int) $order_info->row['service_type'] . "',gross_weight='" . (int) $order_info->row['gross_weight'] . "',"
                        . " packaging='" . (int) $order_info->row['packaging'] . "', status = '1', date_added = NOW()");
                $this->db->query("DELETE FROM " . DB_PREFIX . "order_weight  WHERE order_weight_id = '" . (int) $order_info->row['order_weight_id'] . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET gross_weight='" . $cal_gross_weight . "'  WHERE inward_weight_id = '" . (int) $inward_weight_id->row['inward_weight_id'] . "'");

                $this->db->query("DELETE FROM " . DB_PREFIX . "delivery WHERE delivery_id = '" . (int) $delivery_id . "'");
            }
        }
    }

    public function getOutwards() {
        $query = $this->db->query("SELECT d.*,DATEDIFF(ow.delivery_date, ow.date_added) as aging,ow.order_no,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "delivery d "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON d.order_weight_id = ow.order_weight_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON d.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON d.product_id = p.product_id  group by d.order_weight_id");

        return $query->rows;
    }
    
    public function getInwardReport() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');
        
        $query = $this->db->query("SELECT i.*,iw.net_weight,iw.gross_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code,pt.product_type,pt.product_type_id FROM " . DB_PREFIX . "inward i "
                . " INNER JOIN " . DB_PREFIX . "inward_weight iw ON i.inward_id = iw.inward_id"
                . " INNER JOIN " . DB_PREFIX . "customer c ON i.customer_id = c.customer_id "
                . " INNER JOIN " . DB_PREFIX . "product p ON i.product_id = p.product_id "
                . " INNER JOIN " . DB_PREFIX . "product_type pt ON i.product_type_id=pt.product_type_id"
                . " WHERE (iw.date_added BETWEEN '" . $first_day_this_month . "' AND '" . $last_day_this_month . "' ) GROUP BY i.inward_id ORDER BY iw.gross_weight DESC limit 10");

        return $query->rows;
    }
    public function getOutwardReport() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');
        
        $query = $this->db->query("SELECT sum(d.gross_weight) as total_gross_weight,d.customer_id, CONCAT(c.firstname, ' ' , c.lastname) AS customer_name FROM " . DB_PREFIX . "delivery d "
                . " LEFT JOIN " . DB_PREFIX . "customer c ON d.customer_id = c.customer_id GROUP BY d.customer_id ORDER BY total_gross_weight DESC limit 10");

        return $query->rows;
    }

    public function getOutward($delivery_id) {
        $query = $this->db->query("SELECT d.*,DATEDIFF(ow.delivery_date, ow.date_added) as aging,ow.order_no,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "delivery d "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON d.order_weight_id = ow.order_weight_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON d.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON d.product_id = p.product_id  where d.delivery_id = '" . $delivery_id . "' group by d.order_weight_id");

        return $query->row;
    }

    public function getOrderNosByCoilNo($coil_no) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE coil_no = '" . $coil_no . "'");

        return $query->rows;
    }

    public function getOutwardDetailsByOrderNo($order_no) {
        $query = $this->db->query("SELECT o.*,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "order o "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON o.order_id = ow.order_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON o.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON o.product_id = p.product_id WHERE o.order_no = '" . $order_no . "'");

        return $query->row;
    }

    public function getTotalOutward() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "inward_details");

        return $query->row['total'];
    }
    
    public function getTotalOutwards() {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month = date('Y-m-t');
        
        $query = $this->db->query("SELECT SUM(gross_weight) AS total FROM " . DB_PREFIX . "delivery where (delivery_date BETWEEN '" . $first_day_this_month . "' AND '" . $last_day_this_month . "' )");

        return $query->row['total'];
    }

}
