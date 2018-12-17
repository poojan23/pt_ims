<?php

class ModelProductProduct extends Model
{
    public function addProduct($data) {
        $sql= $this->db->query("INSERT INTO " . DB_PREFIX . "product SET product_name = '" . $this->db->escape($data['product_name']) . "', product_code = '" . $this->db->escape($data['product_code']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '1', org_id = '1', date_added = NOW(), date_modified = NOW()");
        return $sql;
    }

    public function editProduct($member_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "member SET member_group_id = '" . (int)$data['member_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', gender = '" . (isset($data['gender']) ? $this->db->escape($data['gender']) : 'm') . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : '') . "', status = '" . (int)$data['status'] . "', safe = '" . (isset($data['safe']) ? (int)$data['safe'] : '') . "' WHERE member_id = '" . (int)$member_id . "'");

        if(isset($data['avatar'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET image = '" . $this->db->escape($data['avatar']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }

        if(isset($data['designation'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET designation = '" . $this->db->escape($data['designation']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }

        if(isset($data['birthdate'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET birthdate = '" . $this->db->escape($data['birthdate']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }

        if(isset($data['anniversary'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET anniversary = '" . $this->db->escape($data['anniversary']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }

        if($data['password']) {
            $salt = ['salt' => token(22)];

            $this->db->query("UPDATE " . DB_PREFIX . "member SET salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', date_modified = NOW() WHERE member_id = '" . (int)$member_id . "'");
        }
    }

    public function deleteProduct($member_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$member_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "member_ip WHERE member_id = '" . (int)$member_id . "'");
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