<?php

class ModelUserUser extends Model
{
    public function addUser($data) {
        $salt = ['salt' => token(22)];

        $this->db->query("INSERT INTO " . DB_PREFIX . "member SET member_group_id = '" . (int)$data['member_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', newsletter = '" . (int)$data['newsletter'] . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

        $member_id = $this->db->lastInsertId();

        if(isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET image = '" . $this->db->escape($data['image']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }

        return $member_id;
    }

    public function editUser($member_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "member SET member_role_id  = '" . (int)$data['member_role_id'] . "',member_group_id = '" . (int)$data['member_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', status = '" . (int)$data['status'] . "' WHERE member_id = '" . (int)$member_id . "'");

        if(isset($data['avatar'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "member SET image = '" . $this->db->escape($data['avatar']) . "' WHERE member_id = '" . (int)$member_id . "'");
        }


        if($data['password']) {
            $salt = ['salt' => token(22)];

            $this->db->query("UPDATE " . DB_PREFIX . "member SET salt = '" . $this->db->escape($salt['salt']) . "', password = '" . $this->db->escape(password_hash($data['password'], PASSWORD_DEFAULT, $salt)) . "', date_modified = NOW() WHERE member_id = '" . (int)$member_id . "'");
        }
    }

    public function deleteUser($member_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$member_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "member_ip WHERE member_id = '" . (int)$member_id . "'");
    }

    public function getUser($member_id) {
        $query = $this->db->query("SELECT *, (SELECT mgd.name FROM `" . DB_PREFIX ."member_group_description` mgd WHERE mgd.member_group_id = m.member_group_id) AS member_group FROM `" . DB_PREFIX . "member` m WHERE member_id = '" . (int)$member_id . "'");

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

    public function getTotalUsers() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "member");

        return $query->row['total'];
    }

    public function getTotalUsersByUserGroupId($member_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "member WHERE member_group_id = '" . (int)$member_group_id . "'");

        return $query->row['total'];
    }

    public function addLoginAttempts($email) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server["REMOTE_ADDR"]) . "'");

        if(!$query->num_rows) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "member_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
        } else {
            $this->db->query("UPDATE " . DB_PREFIX . "member_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE member_login_id = '" . (int)$query->row['member_login_id'] . "'");
        }
    }

    public function getLoginAttempts($email) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "member_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function deleteLoginAttempts($email) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "member_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
    }
}