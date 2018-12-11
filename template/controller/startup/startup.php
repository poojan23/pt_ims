<?php

class ControllerStartupStartup extends Controller
{
    public function index() {
        # Settings
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "member_setting` WHERE org_id = '0' OR org_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY org_id ASC");

        foreach($query->rows as $result) {
            if(!$result['serialized']) {
                $this->config->set($result['key'], $result['value']);
            } else {
                $this->config->set($result['key'], json_decode($result['value'], true));
            }
        }

        # URL
        $this->registry->set('url', new Url($this->config->get('config_url'), $this->config->get('config_ssl')));

        # Language
        $code = '';

        $this->load->model('localisation/language');

        $languages = $this->model_localisation_language->getLanguages();

        if(isset($this->session->data['language'])) {
            $code = $this->session->data['language'];
        }

        if(isset($this->request->cookie['language']) && !array_key_exists($code, $languages)) {
            $code = $this->request->cookie['language'];
        }

        # Language Detection
        if(!empty($this->request->server['HTTP_ACCEPT_LANGUAGE']) && !array_key_exists($code, $languages)) {
            $detect = '';

            $browser_languages = explode(',', $this->request->server['HTTP_ACCEPT_LANGUAGE']);

            # Try using local to detect the language
            foreach($browser_languages as $browser_language) {
                foreach($languages as $key => $value) {
                    if($value['status']) {
                        $locale = explode(',', $value['locale']);

                        if(in_array($browser_language, $locale)) {
                            $detect = $key;
                            break 2;
                        }
                    }
                }
            }

            if(!$detect) {
                # Try using language folder to detect the language
                foreach($browser_languages as $browser_language) {
                    if(array_key_exists(strtolower($browser_language), $languages)) {
                        $detect = strtolower($browser_language);

                        break;
                    }
                }
            }

            $code = $detect ? $detect : '';
        }

        if(!array_key_exists($code, $languages)) {
            $code = $this->config->get('config_language');
        }

        if(!isset($this->session->data['language']) || $this->session->data['language'] != $code) {
            $this->session->data['language'] = $code;
        }

        if(!isset($this->request->cookie['language']) || $this->request->cookie['language'] != $code) {
            setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
        }

        # Overwrite the default language object
        $language = new Language($code);
        $language->load($code);

        $this->registry->set('language', $language);

        # Set the config language_id
        $this->config->set('config_language_id', $languages[$code]['language_id']);

        # Customer
        $this->registry->set('customer', new Account\Customer($this->registry));

        # Currency
        
    }
}
