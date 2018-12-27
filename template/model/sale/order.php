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
//           print_r($query);exit;
           if ($query->row) {
                $net_weight = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $order_id . "'");
                $cal_net_weight = $query->row['net_weight'] + ($net_weight->row['net_weight'] - $data['netWeight']) ;
                
                $this->db->query("UPDATE " . DB_PREFIX . "order SET  `length` = '" . (isset($data['length']) ? $data['length'] : 0) . "',  `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "', service_type='" . $data['service_type'] . "' WHERE order_id = '" . (int) $order_id . "'");
        
                $this->db->query("UPDATE " . DB_PREFIX . "order_weight SET net_weight='" . $data['netWeight'] . "' , `pieces` = '" . (isset($data['pieces']) ? $data['pieces'] : 0) . "' WHERE order_id = '" . (int) $order_id . "'");

                $this->db->query("UPDATE " . DB_PREFIX . "inward_weight SET net_weight='" .$cal_net_weight . "'  WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");  
           }
            
        }
        
        
        
    }

    public function deleteOrder($order_id) {
        $order_info = $this->db->query("SELECT inward_weight_id FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "'");
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "order WHERE order_id = '" . (int) $order_id . "'");
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "order_weight WHERE order_id = '" . (int) $order_id . "'");
        
        $this->db->query("DELETE FROM " . DB_PREFIX . "inward_weight WHERE inward_weight_id = '" . (int) $order_info->row['inward_weight_id'] . "'");
    }

    public function repairCategories($parent_id = 0) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int) $parent_id . "'");

        foreach ($query->rows as $category) {
            // Delete the path below the current one
            $this->db->query("DELETE FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $category['category_id'] . "'");

            // Fix for records with no paths
            $level = 0;

            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int) $parent_id . "' ORDER BY level ASC");

            foreach ($query->rows as $result) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category['category_id'] . "', `path_id` = '" . (int) $result['path_id'] . "', level = '" . (int) $level . "'");

                $level++;
            }

            $this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET category_id = '" . (int) $category['category_id'] . "', `path_id` = '" . (int) $category['category_id'] . "', level = '" . (int) $level . "'");

            $this->repairCategories($category['category_id']);
        }
    }

    public function getOrders() {
        $query = $this->db->query("SELECT o.*,ow.net_weight,DATEDIFF(iw.cutting_date, iw.date_added) as aging,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "order o "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON o.order_id = ow.order_id"
                . " LEFT JOIN " . DB_PREFIX . "inward_weight iw ON o.inward_weight_id = iw.inward_weight_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON o.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON o.product_id = p.product_id group by o.order_id");

        return $query->rows;
    }

    public function getOrder($order_id) {
        $query = $this->db->query("SELECT o.*,ow.net_weight,CONCAT(c.firstname, ' ' , c.lastname) AS customer_name,p.product_code FROM " . DB_PREFIX . "order o "
                . " LEFT JOIN " . DB_PREFIX . "order_weight ow ON o.order_id = ow.order_id"
                . " LEFT JOIN " . DB_PREFIX . "customer c ON o.customer_id = c.customer_id "
                . " LEFT JOIN " . DB_PREFIX . "product p ON o.product_id = p.product_id  where o.order_id = '" . $order_id . "' group by o.order_id");

        return $query->row;
    }

    public function getClients($data = array()) {
        $sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int) $this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sql .= " GROUP BY cp.category_id";

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY sort_order";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getClientDescriptions($category_id) {
        $category_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_description WHERE category_id = '" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $category_description_data[$result['language_id']] = array(
                'name' => $result['name'],
                'meta_title' => $result['meta_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword' => $result['meta_keyword'],
                'description' => $result['description']
            );
        }

        return $category_description_data;
    }

    public function getCategoryPath($category_id) {
        $query = $this->db->query("SELECT category_id, path_id, level FROM " . DB_PREFIX . "category_path WHERE category_id = '" . (int) $category_id . "'");

        return $query->rows;
    }

    public function getCategorySeoUrls($category_id) {
        $category_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'category_id=" . (int) $category_id . "'");

        foreach ($query->rows as $result) {
            $category_seo_url_data[$result['language_id']] = $result['keyword'];
        }

        return $category_seo_url_data;
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

    public function showCategories() {
        $sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order, c1.status, c1.top FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int) $this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        if (isset($this->request->post['search']['value'])) {
            $sql .= " AND name LIKE '%" . $_POST['search']['value'] . "%'";
        }

        $sql .= " GROUP BY category_id";

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY sort_order";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . $data['start'] . "," . $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

}
