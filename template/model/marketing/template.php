<?php

class ModelMarketingTemplate extends Model
{
    public function addTemplate($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "template SET title = '" . $this->db->escape($data['title']) . "', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        return $this->db->lastInsertId();
    }

    public function editTemplate($template_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "template SET title = '" . $this->db->escape($data['title']) . "', subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape($data['message']) . "', status = '" . (isset($data['status']) ? (int)$data['status'] : 0) . "', date_modified = NOW() WHERE template_id = '" . (int)$template_id . "'");
    }

    public function deleteTemplate($template_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "template WHERE template_id = '" . (int)$template_id . "'");
    }

    public function getTemplate($template_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "template WHERE template_id = '" . (int)$template_id . "'");

        return $query->row;
    }

    public function getTemplates($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "template";

        $sort_data = array(
            'title',
            'status',
            'date_added'
        );

        if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY title";
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

    public function getTotalTemplates() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "template");

        return $query->row['total'];
    }
}
