<?php

class ModelProductProductType extends Model {

    public function addProductType($data) {
        $sql = $this->db->query("INSERT INTO " . DB_PREFIX . "product_type SET product_type = '" . $this->db->escape($data['product_type']) . "',  sort_order = '" . (int) $data['sort_order'] . "', org_id = '1'");
        return $sql;
    }

    public function editProductType($member_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "member SET member_group_id = '" . (int) $data['member_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', gender = '" . (isset($data['gender']) ? $this->db->escape($data['gender']) : 'm') . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', newsletter = '" . (isset($data['newsletter']) ? (int) $data['newsletter'] : '') . "', status = '" . (int) $data['status'] . "', safe = '" . (isset($data['safe']) ? (int) $data['safe'] : '') . "' WHERE member_id = '" . (int) $member_id . "'");

        if (isset($data['avatar'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET image = '" . $this->db->escape($data['avatar']) . "' WHERE member_id = '" . (int) $member_id . "'");
        }

        if (isset($data['designation'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET designation = '" . $this->db->escape($data['designation']) . "' WHERE member_id = '" . (int) $member_id . "'");
        }

        if (isset($data['birthdate'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET birthdate = '" . $this->db->escape($data['birthdate']) . "' WHERE member_id = '" . (int) $member_id . "'");
        }

        if (isset($data['anniversary'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET anniversary = '" . $this->db->escape($data['anniversary']) . "' WHERE member_id = '" . (int) $member_id . "'");
        }

        if ($data['password']) {
            $salt = ['salt' => token(22)];

            $this->db->query("UPDATE " . DB_PREFIX . "member SET salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', date_modified = NOW() WHERE member_id = '" . (int) $member_id . "'");
        }
    }

    public function deleteProductType($member_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "member WHERE member_id = '" . (int) $member_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "member_ip WHERE member_id = '" . (int) $member_id . "'");
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

}
