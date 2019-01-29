<?php

class ModelCustomerCustomer extends Model {

    public function addCustomer($data) {
        $closingDate = date("Y-m-t", strtotime("-1 months"));
        $openingDate = date("Y-m-01");

        $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int) $data['customer_group_id'] . "', org_id='1', language_id='1', address_id='0', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', gst = '" . $this->db->escape($data['gst']) . "',  newsletter = '" . (isset($data['newsletter']) ? (int) $data['newsletter'] : 0) . "', status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");

        $customer_id = $this->db->lastInsertId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "clop SET customer_id = '" . (int) $customer_id . "', org_id='1',  opening_date = '" . $openingDate . "', opening_gross_weight = '" . $data['closing_gross_weight'] . "', closing_date = '" . $closingDate . "', closing_gross_weight = '" . $this->db->escape($data['closing_gross_weight']) . "', date_modified = NOW(), date_added = NOW()");
        $year = date("y");
        $month = date("m");
        $unique_id= $year."".$month."".$customer_id;
        
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET unique_id = '" .$unique_id . "' WHERE customer_id = '" . (int) $customer_id . "'");

        if (isset($data['address'])) {
            foreach ($data['address'] as $key => $address) {

                $this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int) $customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int) $address['country_id'] . "', zone_id = '" . (int) $address['zone_id'] . "'");

                $address_id = $this->db->lastInsertId();

                $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $customer_id . "'");
            }
        }

        return $customer_id;
    }

    public function editCustomer($customer_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET customer_group_id = '" . (int) $data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', newsletter = '" . (isset($data['newsletter']) ? (int) $data['newsletter'] : 0) . "', status = '" . (isset($data['status']) ? (int) $data['status'] : 0) . "', date_modified = NOW() WHERE customer_id = '" . (int) $customer_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");

        if (isset($data['address'])) {
            foreach ($data['address'] as $key => $address) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int) $customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int) $address['country_id'] . "', zone_id = '" . (int) $address['zone_id'] . "'");

                if (isset($data['default']) && $data['default'] == $key) {
                    $address_id = $this->db->lastInsertId();

                    $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $customer_id . "'");
                }
            }
        }
    }

    public function deleteCustomer($customer_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");
    }

    public function getCustomer($customer_id) {
        $query = $this->db->query("SELECT c.*,CONCAT(c.firstname, ' ', c.lastname) AS customer FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id) WHERE c.customer_id = '" . (int) $customer_id . "'");

        return $query->row;
    }

    public function getCustomers() {
        $query = $this->db->query("SELECT c.*,CONCAT(c.firstname, ' ', c.lastname) AS customer,cgd.name FROM " . DB_PREFIX . "customer c"
                . " LEFT JOIN " . DB_PREFIX . "customer_group cg ON (c.customer_group_id = cg.customer_group_id)"
                . " LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id)");

        return $query->rows;
    }

    public function getCustomerByEmail($email) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function getAddress($address_id) {
        $address_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "'");

        if ($address_query->num_rows) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $address_query->row['country_id'] . "'");

            if ($country_query->num_rows) {
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $address_query->row['zone_id'] . "'");

            if ($zone_query->num_rows) {
                $zone = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            } else {
                $zone = '';
                $zone_code = '';
            }

            return array(
                'address_id' => $address_query->row['address_id'],
                'customer_id' => $address_query->row['customer_id'],
                'firstname' => $address_query->row['firstname'],
                'lastname' => $address_query->row['lastname'],
                'company' => $address_query->row['company'],
                'address_1' => $address_query->row['address_1'],
                'address_2' => $address_query->row['address_2'],
                'postcode' => $address_query->row['postcode'],
                'city' => $address_query->row['city'],
                'zone_id' => $address_query->row['zone_id'],
                'zone' => $zone,
                'zone_code' => $zone_code,
                'country_id' => $address_query->row['country_id'],
                'country' => $country,
                'iso_code_2' => $iso_code_2,
                'iso_code_3' => $iso_code_3,
                'address_format' => $address_format
            );
        }
    }

    public function getAddresses($customer_id) {
        $address_data = array();

        $query = $this->db->query("SELECT address_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");

        foreach ($query->rows as $result) {
            $address_info = $this->getAddress($result['address_id']);

            if ($address_info) {
                $address_data[$result['address_id']] = $address_info;
            }
        }

        return $address_data;
    }

    public function getTotalCustomers($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape((string) $data['filter_name']) . "%'";
        }

        if (!empty($data['filter_email'])) {
            $implode[] = "email LIKE '" . $this->db->escape((string) $data['filter_email']) . "%'";
        }

        if (!empty($data['newsletter']) && !is_null($data['filter_newsletter'])) {
            $implode[] = "newsletter = '" . (int) $data['filter_newsletter'] . "'";
        }

        if (!empty($data['filter_customer_group_id'])) {
            $implode[] = "customer_group_id = '" . (int) $data['filter_customer_group_id'] . "'";
        }

        if ($implode) {
            $sql .= " WHERE " . implode(" AND ", $implode);
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalAddressesByCustomerId($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalAddressesByCountryId($country_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE country_id = '" . (int) $country_id . "'");

        return $query->row['total'];
    }

    public function getTotalAddressesByZoneId($zone_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int) $zone_id . "'");

        return $query->row['total'];
    }

    public function getTotalCustomersByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int) $customer_group_id . "'");

        return $query->row['total'];
    }

    public function addHistory($customer_id, $comment) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_history SET customer_id = '" . (int) $customer_id . "', comment = '" . $this->db->escape(strip_tags($comment)) . "', date_added = NOW()");
    }

    public function getHistories($customer_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT comment, date_added FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int) $customer_id . "' ORDER BY date_added DESC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    public function getTotalHistoriesByCustomerId($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalHistories() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history");

        return $query->row['total'];
    }

    public function getLastHistories() {

        $query = $this->db->query("SELECT ch.*, c.*  FROM " . DB_PREFIX . "customer_history ch INNER JOIN " . DB_PREFIX . "customer c ON ch.customer_id = c.customer_id WHERE customer_history_id IN (SELECT MAX(customer_history_id) FROM " . DB_PREFIX . "customer_history GROUP BY customer_id)");

        return $query->rows;
    }

    public function addFile($customer_id, $name, $filename, $mask) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_file SET customer_id = '" . (int) $customer_id . "', name = '" . $this->db->escape($name) . "', filename = '" . $this->db->escape($filename) . "', mask = '" . $this->db->escape($mask) . "', date_added = NOW()");
    }

    public function getFile($customer_file_id) {
        $query = $this->db->query("SELECT filename FROM " . DB_PREFIX . "customer_file WHERE customer_file_id = '" . (int) $customer_file_id . "'");

        return $query->row;
    }

    public function getFiles($customer_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_file WHERE customer_id = '" . (int) $customer_id . "' ORDER BY date_added DESC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    public function getFilesByCustomerId($customer_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer_file WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->rows;
    }

    public function getFilesByCustomerFileId($customer_file_id, $customer_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer_file WHERE customer_file_id = '" . (int) $customer_file_id . "' AND customer_id = '" . (int) $customer_id . "'");

        return $query->rows;
    }

    public function getTotalFilesByCustomerId($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_file WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalFiles() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_file");

        return $query->row['total'];
    }

    public function getCustomerEmail($customer_id) {
        $query = $this->db->query("SELECT email FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row;
    }

    public function getMails($email, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mail WHERE LCASE(email) = '" . $this->db->escape(strtolower($email)) . "'");

        return $query->rows;
    }

    public function getTotalMailsByEmail($email) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mail WHERE LCASE(email) = '" . $this->db->escape(strtolower($email)) . "'");

        return $query->row['total'];
    }

    public function getTotalMails() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mail");

        return $query->row['total'];
    }

    public function getTotalMailsRead() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mail WHERE status = 1");

        return $query->row['total'];
    }

    public function getTotalMailsUnread() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mail WHERE status = 0");

        return $query->row['total'];
    }

}
