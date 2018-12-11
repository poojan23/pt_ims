<?php
namespace Account;
class Currency
{
    private $currencies = array();

    public function __construct($registry) {
        $this->db = $registry->get('db');
        $this->language = $registry->get('language');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency");

        foreach($query->rows as $result) {
            $this->currencies[$result['code']] = array(
                'currency_id'   => $result['currency_id'],
                'title'         => $result['title'],
                'symbol'        => $result['symbol'],
                'pos'           => $result['placement'],
                'decimal_place' => $result['decimal_place'],
                'value'         => $result['value']
            );
        }
    }

    public function format($number, $currency, $value = '', $format = true) {
        $symbol = $this->currencies[$currency]['symbol'];
        $position = $this->currencies[$currency]['pos'];
        $decimal_place = $this->currencies[$currency]['decimal_place'];

        if(!$value) {
            $value = $this->currencies[$currency]['value'];
        }

        $amount = $value ? (float)$number * $value : (float)$number;

        $amount = round($amount, (int)$decimal_place);

        if(!$format) {
            return $amount;
        }

        $string = '';

        if($position == 0) {
            $string .= $symbol;
        }

        $string .= number_format($amount, (int)$decimal_place, $this->language->get('decimal_point'), $this->language->get('thousand_point'));

        if($position == 1) {
            $string .= $symbol;
        }

        return $string;
    }

    public function convert($value, $from, $to) {
        if(isset($this->currencies[$from])) {
            $from = $this->currencies[$from]['value'];
        } else {
            $from = 1;
        }

        if(isset($this->currencies[$to])) {
            $to = $this->currencies[$to]['value'];
        } else {
            $to = 1;
        }

        return $value * ($to / $from);
    }

    public function getId($currency) {
        if(isset($this->currencies[$currency])) {
            return $this->currencies[$currency]['currency_id'];
        } else {
            return 0;
        }
    }

    public function getSymbol($currency) {
        if(isset($this->currencies[$currency])) {
            return $this->currencies[$currency]['symbol'];
        } else {
            return '';
        }
    }

    public function getPosition($currency) {
        if(isset($this->currencies[$currency])) {
            return $this->currencies[$currency]['pos'];
        } else {
            return '';
        }
    }

    public function getDecimalPlace($currency) {
        if(isset($this->currencies[$currency])) {
            return $this->currencies[$currency]['decimal_place'];
        } else {
            return 0;
        }
    }

    public function getValue($currency) {
        if(isset($this->currencies[$currency])) {
            return $this->currencies[$currency]['value'];
        } else {
            return 0;
        }
    }

    public function has($currency) {
        return isset($this->currencies[$currency]);
    }
}
