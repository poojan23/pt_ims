<?php

class ModelProductProduct extends Model {

    public function addProduct($data) {
        $sql = $this->db->query("INSERT INTO " . DB_PREFIX . "product SET product_name = '" . $this->db->escape($data['product_name']) . "', product_code = '" . $this->db->escape($data['product_code']) . "', sort_order = '" . (int) $data['sort_order'] . "', status = '1', org_id = '1', date_added = NOW(), date_modified = NOW()");
        return $sql;
    }

    public function editProduct($product_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET product_name = '" . $this->db->escape($data['product_name']) . "', product_code = '" . $this->db->escape($data['product_code']) . "', sort_order = '" . $this->db->escape($data['sort_order']) . "'  WHERE product_id = '" . (int) $product_id . "'");
    }

    public function deleteProduct($product_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
    }

    public function getProduct() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product");

        return $query->rows;
    }

    public function getProductByID($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");

        return $query->row;
    }

    public function getTotalProducts() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product");

        return $query->row['total'];
    }

}
