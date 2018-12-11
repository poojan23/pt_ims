<?php
namespace Account;
class Member
{
    private $member_id;
    private $firstname;
    private $lastname;
    private $member_group_id;
    private $email;
    private $telephone;
    private $newsletter;
    private $address_id;
    private $permission = array();

    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->db = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');

        if(isset($this->session->data['member_id'])) {
            $member_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member WHERE member_id = '" . (int)$this->session->data['member_id'] . "' AND status = '1'");

            if($member_query->num_rows) {
                $this->member_id = $member_query->row['member_id'];
                $this->firstname = $member_query->row['firstname'];
                $this->lastname = $member_query->row['lastname'];
                $this->member_group_id = $member_query->row['member_group_id'];
                $this->email = $member_query->row['email'];
                $this->telephone = $member_query->row['telephone'];
                $this->newsletter = $member_query->row['newsletter'];
                $this->address_id = $member_query->row['address_id'];

                $this->db->query("UPDATE " . DB_PREFIX . "member SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE member_id = '" . (int)$this->member_id . "'");

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member_ip WHERE member_id = '" . (int)$this->session->data['member_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

                if(!$query->num_rows) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "member_ip SET member_id = '" . (int)$this->session->data['member_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
                }
                
                $member_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "member_group WHERE member_group_id = '" . (int)$member_query->row['member_group_id'] . "'");

                $permissions = json_decode($member_group_query->row['permission'], true);

                if(is_array($permissions)) {
                    foreach($permissions as $key => $value) {
                        $this->permission[$key] = $value;
                    }
                }
            } else {
                $this->logout();
            }
        }
    }

    public function login($email, $password, $override = false) {
        if($override) {
            $member_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
        } else {
            $member_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
        }

        if($member_query->num_rows) {
            if(password_verify($password, $member_query->row['password'])) {
                $this->session->data['member_id'] = $member_query->row['member_id'];

                $this->member_id = $member_query->row['member_id'];
                $this->firstname = $member_query->row['firstname'];
                $this->lastname = $member_query->row['lastname'];
                $this->member_group_id = $member_query->row['member_group_id'];
                $this->email = $member_query->row['email'];
                $this->telephone = $member_query->row['telephone'];
                $this->newsletter = $member_query->row['newsletter'];
                $this->address_id = $member_query->row['address_id'];

                $this->db->query("UPDATE " . DB_PREFIX . "member SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE member_id = '" . (int)$this->member_id . "'");

                $member_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "member_group WHERE member_group_id = '" . (int)$member_query->row['member_group_id'] . "'");

                $permissions = json_decode($member_group_query->row['permission'], true);

                if(is_array($permissions)) {
                    foreach($permissions as $key => $value) {
                        $this->permission[$key] = $value;
                    }
                }

                return true;
            }
        } else {
            return false;
        }
    }

    public function logout() {
        unset($this->session->data['member_id']);

        $this->member_id = '';
        $this->firstname = '';
        $this->lastname = '';
        $this->member_group_id = '';
        $this->email = '';
        $this->telephone = '';
        $this->newsletter = '';
        $this->address_id = '';
    }

    public function hasPermission($key, $value) {
        if(isset($this->permission[$key])) {
            return in_array($value, $this->permission[$key]);
        } else {
            return false;
        }
    }

    public function isLogged() {
        return $this->member_id;
    }

    public function getId() {
        return $this->member_id;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function getGroupId() {
        return $this->member_group_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }

    public function getAddressId() {
        return $this->address_id;
    }
}
