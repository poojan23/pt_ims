<?php

class ModelUserUserGroup extends Model
{
    public function addUserGroup($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "member_group SET permission = '" . (isset($data['permission']) ? $this->db->escape(json_encode($data['permission'])) : '') . "', sort_order = '" . (int)$data['sort_order'] . "'");

        $member_group_id = $this->db->lastInsertId();

        foreach($data['user_group_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "member_group_description SET member_group_id = '" . (int)$member_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        return $member_group_id;
    }

    public function editUserGroup($member_group_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "member_group SET permission = '" . (isset($data['permission']) ? $this->db->escape(json_encode($data['permission'])) : '') . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE member_group_id = '" . (int)$member_group_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "member_group_description WHERE member_group_id = '" . (int)$member_group_id . "'");

        foreach($data['user_group_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "member_group_description SET member_group_id = '" . (int)$member_group_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }
    }

    public function deleteUserGroup($member_group_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "member_group WHERE member_group_id = '" . (int)$member_group_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "member_group_description WHERE member_group_id = '" . (int)$member_group_id . "'");
    }

    public function getUserGroup($member_group_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member_group mg LEFT JOIN " . DB_PREFIX . "member_group_description mgd ON (mg.member_group_id = mgd.member_group_id) WHERE mg.member_group_id = '" . (int)$member_group_id . "' AND mgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        $user_group = array(
            'name'          => $query->row['name'],
            'description'   => $query->row['description'],
            'permission'     => json_decode($query->row['permission'], true),
            'sort_order'     => $query->row['sort_order']
        );

        return $user_group;
    }

    public function getUserGroups() {
        $sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "member_group mg LEFT JOIN " . DB_PREFIX . "member_group_description mgd ON (mg.member_group_id = mgd.member_group_id) WHERE mgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $sort_data = array(
            'mgd.name',
            'mg.sort_order'
        );

        if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY mgd.name";
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

    public function getUserGroupDescriptions($member_group_id) {
        $member_group_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member_group_description WHERE member_group_id = '" . (int)$member_group_id . "'");

        foreach($query->rows as $result) {
            $member_group_data[$result['language_id']] = array(
                'name'          => $result['name'],
                'description'   => $result['description']
            );
        }

        return $member_group_data;
    }

    public function getTotalUserGroups() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "member_group");

        return $query->row['total'];
    }

    public function addPermission($member_group_id, $type, $route) {
        $member_group_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member_group WHERE member_group_id = '" . (int)$member_group_id . "'");

        if($member_group_query->num_rows) {
            $data = json_decode($member_group_query->row['permission'], true);

            $data[$type][] = $route;

            $this->db->query("UPDATE " . DB_PREFIX . "member_group SET permission = '" . $this->db->escape(json_encode($data)) . "' WHERE member_group_id = '" . (int)$member_group_id . "'");
        }
    }

    public function removePermission($member_group_id, $type, $route) {
        $member_group_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "member_group WHERE member_group_id = '" . (int)$member_group_id . "'");

        if($member_group_query->num_rows) {
            $data = json_decode($member_group_query->row['permission'], true);

            $data[$type] = array_diff($data[$type], array($route));

            $this->db->query("UPDATE " . DB_PREFIX . "member_group SET permission = '" . $this->db->escape(json_encode($data)) . "' WHERE member_group_id = '" . (int)$member_group_id . "'");
        }
    }
}
