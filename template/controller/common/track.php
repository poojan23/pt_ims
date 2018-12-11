<?php

class ControllerCommonTrack extends Controller
{
    public function index() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mail WHERE token = '" . $this->db->escape($this->request->get['token']) . "'");

        if($query->num_rows) {
            $this->db->query("UPDATE " . DB_PREFIX . "mail SET viewed = (viewed + 1), date_read = NOW() WHERE token = '" . $this->db->escape($this->request->get['token']) . "' AND status = '1'");
        } else {
            $this->db->query("UPDATE " . DB_PREFIX . "mail SET status = '1', date_read = NOW() WHERE token = '" . $this->db->escape($this->request->get['token']) . "'");
        }
    }
}
