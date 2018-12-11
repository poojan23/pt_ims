<?php

class ModelToolOnline extends Model
{
    public function addOnline($ip, $url, $referer) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "unique_visitor WHERE date_added = '" . $this->db->escape($date = date('Y-m-d H:i:s')) ."'");

        if($query->num_rows == 0) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "unique_visitor SET date_added = '" . $date . "', ip = '" . $this->db->escape($ip) . "', url = '" . $this->db->escape($url) . "', referer = '" . $this->db->escape($referer) . "'");
        } else {
            $row = $query->row;

            if(!preg_match('/' . $ip . '/i', $row['ip'])) {
                $newIp = "$row[ip] $ip";

                $this->db->query("UPDATE " . DB_PREFIX . "unique_visitor SET ip = '" . $newIp . ", views = (views + 1) WHERE date_added = '" . $date . "'");
            }
        }
    }

    public function getUniqueVisitors($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "unique_visitor";

        $sort_data = array(
            'ip',
            'date_added'
        );

        if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY date_added";
        }

        if(isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if(isset($data['start']) && isset($data['limit'])) {
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

    public function getTotalUniqueVisitors() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "unique_visitors");

        return $query->row['total'];
    }
}
