<?php

class ModelMarketingContact extends Model
{
    public function addContact($member_id, $email, $subject, $message, $token) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "mail SET member_id = '" . (int)$member_id . "', email = '" . $this->db->escape($email) . "', subject = '" . $this->db->escape($subject) . "', message = '" . $this->db->escape($message) . "', token = '" . $this->db->escape($token) . "', status = '0', date_sent = NOW(), date_read = NOW()");

        return $this->db->lastInsertId();
    }
}
