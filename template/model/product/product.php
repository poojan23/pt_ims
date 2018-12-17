<?php

class ModelProductProduct extends Model
{
    public function addProduct($data) {
        $sql= $this->db->query("INSERT INTO " . DB_PREFIX . "product SET product_name = '" . $this->db->escape($data['product_name']) . "', product_code = '" . $this->db->escape($data['product_code']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '1', org_id = '1', date_added = NOW(), date_modified = NOW()");
        return $sql;
    }

    public function editProduct($product_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET product_name = '" . $this->db->escape($data['product_name']) . "', product_code = '" . $this->db->escape($data['product_code']) . "', sort_order = '" . $this->db->escape($data['sort_order']) . "'  WHERE product_id = '" . (int)$product_id . "'");
       
    }

    public function deleteProduct($product_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
    }

    public function getProduct() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product");

        return $query->rows;
    }
    public function getProductByID($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");

        return $query->row;
    }
    
    public function getUserByEmail($email) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function getUsers($data = array()) {
        $sql = "SELECT *, CONCAT(m.firstname, ' ', m.lastname) AS name, mgd.name AS member_group FROM " . DB_PREFIX . "member m LEFT JOIN " . DB_PREFIX . "member_group_description mgd ON (m.member_group_id = mgd.member_group_id) WHERE mgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $sort_data = array(
            'name',
            'm.email',
            'member_group',
            'm.status',
            'm.ip',
            'm.date_added'
        );

        if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
        }

        if(isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if(isset($data['start']) || isset($data['limit'])) {
            if($data['start'] < 0) {
                $data['start'] = 0;
            }

            if($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalProducts() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product");

        return $query->row['total'];
    }

  
}