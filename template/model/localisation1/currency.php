<?php

class ModelLocalisationCurrency extends Model
{
    public function getCurrency($currency_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE currency_id = '" . (int)$currency_id . "'");

        return $query->row;
    }

    public function getCurrencies($data = array()) {
        if($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "currency";

            $sort_data = array(
                'title',
                'code',
                'symbol'
            );

            if(isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY title";
            }

            if(isset($data['order']) && ($data['order'] != 'DESC')) {
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
        } else {
            $currency_data = $this->cache->get('currency');

			if (!$currency_data) {
				$currency_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency ORDER BY title ASC");

				foreach ($query->rows as $result) {
					$currency_data[$result['code']] = array(
						'currency_id'   => $result['currency_id'],
						'title'         => $result['title'],
						'code'          => $result['code'],
						'symbol'        => $result['symbol'],
						'pos'           => $result['pos'],
						'decimal_place' => $result['decimal_place'],
						'value'         => $result['value'],
						'status'        => $result['status'],
						'date_added'    => $result['date_added'],
						'date_modified' => $result['date_modified']
					);
				}

				$this->cache->set('currency', $currency_data);
			}

			return $currency_data;
        }
    }

    public function getTotalCurrencies() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "currency");

        return $query->row['total'];
    }
}
