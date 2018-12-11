<?php

class ModelUserUser extends Model
{
    public function addUser($data) {
        $salt = ['salt' => token(22)];

        $this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET name = '" . $this->db->escape($data['name']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', email = '" . $this->db->escape($data['email']) . "', salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

        $user_id = $this->db->lastInsertId();

        return $user_id;
    }

    public function editUser($user_id, $data) {
        $this->db->query("UPDATE `" . DB_PREFIX . "user` SET name = '" . $this->db->escape($data['name']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', email = '" . $this->db->escape($data['email']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

        if(isset($data['designation'])) {
            $this->db->query("UPDATE `" . DB_PREFIX . "user` SET designation = '" . $this->db->escape($data['designation']) . "' WHERE user_id = '" . (int)$user_id . "'");
        }

        if(isset($data['image'])) {
            $this->db->query("UPDATE `" . DB_PREFIX . "user` SET image = '" . $this->db->escape($data['image']) . "' WHERE user_id = '" . (int)$user_id . "'");
        }

        if($data['password']) {
            $this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', date_modified = NOW() WHERE user_id = '" . (int)$user_id . "'");
        }

    }

    public function editPassword($user_id, $password) {
        $salt = ['salt' => token(22)];

        $this->db->query("UPDATE `" . DB_PREFIX ."user` SET salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($password, PASSWORD_DEFAULT, $salt)) . "', code = '' WHERE user_id = '" . (int)$user_id . "'");
    }

    public function editCode($email, $code) {
        $this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
    }

    public function deleteUser($user_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
    }

    public function getUser($user_id) {
        $query = $this->db->query("SELECT *, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group FROM `" . DB_PREFIX . "user` u WHERE user_id = '" . (int)$user_id . "'");

        return $query->row;
    }

    public function getUserByEmail($email) {
        $query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function getUserByLoginId($login_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE login_id = '" . (int)$login_id . "'");

        return $query->row;
    }

    public function getUserByCode($code) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

        return $query->row;
    }

    public function getUsers($data = array()) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "user`";

        $sort_data = array(
            'name',
            'status',
            'date_added'
        );

        if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
        }

        if(isset($data['order']) && ($data['order'] == 'DESC')) {
            $data['order'] = " DESC";
        } else {
            $data['order'] = " ASC";
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

    public function getTotalUsers() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

        return $query->row['total'];
    }

    public function getTotalUsersByGroupId($user_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");

        return $query->row['total'];
    }

    public function getTotalUsersByEmail($email) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");;

        return $query->row['total'];
    }
}
