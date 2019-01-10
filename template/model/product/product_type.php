<?php

class ModelProductProductType extends Model {

    public function addProductType($data) {
        $sql = $this->db->query("INSERT INTO " . DB_PREFIX . "product_type SET product_type = '" . $this->db->escape($data['product_type']) . "',  sort_order = '" . (int) $data['sort_order'] . "', org_id = '1'");
        return $sql;
    }

    public function editProductType($product_type_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "product_type SET  product_type = '" . $this->db->escape($data['product_type']) . "',sort_order = '" . (int) $data['sort_order'] . "' WHERE product_type_id = '" . (int) $product_type_id . "'");

    }

    public function deleteProductType($product_type_id) {
        $this->db->query("DELETE FROM " .DB_PREFIX. "product_type WHERE product_type_id='" .(int)$product_type_id. "'");
        
    }

    public function getProductType() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type");

        return $query->rows;
    }

    public function getTotalProductTypes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_type");

        return $query->row['total'];
    }

    public function getProductTypeByID($product_type_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type WHERE product_type_id = '" . (int) $product_type_id . "'");

        return $query->row;
    }

    public function getProductByProductType($product_type) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_type WHERE product_type = '" . $this->db->escape($product_type). "'");

        return $query->row;
    }

}
