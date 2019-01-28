<?php

class ControllerCustomerCustomer extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function add() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_customer_customer->addCustomer($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        if (isset($this->request->post['selected'])) {
            foreach ($this->request->post['selected'] as $customer_id) {
                $this->model_customer_customer->deleteCustomer($customer_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('customer/customer/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('customer/customer/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('customer/customer/delete', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('customer/customer');

        $totalData = $this->model_customer_customer->getTotalCustomers();

        $totalFiltered = $totalData;

        $results = $this->model_customer_customer->getCustomers();

        $table = array();

        foreach ($results as $result) {
            $nestedData['customer_id'] = $result['customer_id'];
            $nestedData['customer'] = $result['customer'];
            $nestedData['email'] = $result['email'];
            $nestedData['name'] = $result['name'];
            $nestedData['status'] = $result['status'];
            $nestedData['newsletter'] = $result['newsletter'];
            $nestedData['date_added'] = date('d/m/Y', strtotime($result['date_added']));

            $table[] = $nestedData;
        }

        $json = array(
            'resultsTotal' => intval($totalData),
            'resultFiltered' => intval($totalFiltered),
            'data' => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['member_token'] = $this->session->data['member_token'];

        if (isset($this->request->get['customer_id'])) {
            $data['customer_id'] = (int) $this->request->get['customer_id'];
        } else {
            $data['customer_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['customer_group_id'])) {
            $data['customer_group_err'] = $this->error['customer_group_id'];
        } else {
            $data['customer_group_err'] = '';
        }

        if (isset($this->error['firstname'])) {
            $data['firstname_err'] = $this->error['firstname'];
        } else {
            $data['firstname_err'] = '';
        }

        if (isset($this->error['lastname'])) {
            $data['lastname_err'] = $this->error['lastname'];
        } else {
            $data['lastname_err'] = '';
        }

        if (isset($this->error['email'])) {
            $data['email_err'] = $this->error['email'];
        } else {
            $data['email_err'] = '';
        }

        if (isset($this->error['telephone'])) {
            $data['telephone_err'] = $this->error['telephone'];
        } else {
            $data['telephone_err'] = '';
        }

        if (isset($this->error['mobile'])) {
            $data['mobile_err'] = $this->error['mobile'];
        } else {
            $data['mobile_err'] = '';
        }

        if (isset($this->error['gst'])) {
            $data['gst_err'] = $this->error['gst'];
        } else {
            $data['gst_err'] = '';
        }

        if (isset($this->error['closing_gross_weight'])) {
            $data['closing_err'] = $this->error['closing_gross_weight'];
        } else {
            $data['closing_err'] = '';
        }

        if (isset($this->error['address'])) {
            $data['address_err'] = $this->error['address'];
        } else {
            $data['address_err'] = array();
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['customer_id'])) {
            $data['action'] = $this->url->link('customer/customer/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('customer/customer/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('customer/customer/edit', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . $this->request->get['customer_id'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('customer/customer/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
        }

        $this->load->model('customer/customer_group');

        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($customer_info)) {
            $data['customer_group_id'] = $customer_info['customer_group_id'];
        } else {
            $data['customer_group_id'] = '';
        }

        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($customer_info)) {
            $data['firstname'] = $customer_info['firstname'];
        } else {
            $data['firstname'] = '';
        }

        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($customer_info)) {
            $data['lastname'] = $customer_info['lastname'];
        } else {
            $data['lastname'] = '';
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($customer_info)) {
            $data['email'] = $customer_info['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($customer_info)) {
            $data['telephone'] = $customer_info['telephone'];
        } else {
            $data['telephone'] = '';
        }

        if (isset($this->request->post['mobile'])) {
            $data['mobile'] = $this->request->post['mobile'];
        } elseif (!empty($customer_info)) {
            $data['mobile'] = $customer_info['mobile'];
        } else {
            $data['mobile'] = '';
        }

        if (isset($this->request->post['gst'])) {
            $data['gst'] = $this->request->post['gst'];
        } elseif (!empty($customer_info)) {
            $data['gst'] = $customer_info['gst'];
        } else {
            $data['gst'] = '';
        }

        if (isset($this->request->post['closing_gross_weight'])) {
            $data['closing_gross_weight'] = $this->request->post['closing_gross_weight'];
        } elseif (!empty($customer_info)) {
            $data['closing_gross_weight'] = $customer_info['closing_gross_weight'];
        } else {
            $data['closing_gross_weight'] = '';
        }
      

        if (isset($this->request->post['newsletter'])) {
            $data['newsletter'] = $this->request->post['newsletter'];
        } elseif (!empty($customer_info)) {
            $data['newsletter'] = $customer_info['newsletter'];
        } else {
            $data['newsletter'] = 1;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($customer_info)) {
            $data['status'] = $customer_info['status'];
        } else {
            $data['status'] = true;
        }

        $this->load->model('localisation/country');

        $data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['address'])) {
            $data['addresses'] = $this->request->post['address'];
        } elseif (!empty($customer_info)) {
            $data['addresses'] = $this->model_customer_customer->getAddresses($this->request->get['customer_id']);
        } else {
            $data['addresses'] = array();
        }

        if (isset($this->request->post['default'])) {
            $data['default'] = $this->request->post['default'];
        } elseif (!empty($customer_info)) {
            $data['default'] = array_search($customer_info['address_id'], array_column($data['addresses'], 'address_id'));
        } else {
            $data['default'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_form', $data));
    }

    protected function validateForm() {
        if (!$this->member->hasPermission('modify', 'customer/customer')) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        
        if (($this->request->post['customer_group_id'] == '')) {
            $this->error['customer_group_id'] = $this->language->get('customer_group_err');
        }
        
        if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen(trim($this->request->post['firstname']) > 32))) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen(trim($this->request->post['lastname']) > 32))) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if ((utf8_strlen($this->request->post['gst']) < 1) || (utf8_strlen(trim($this->request->post['firstname']) > 12))) {
            $this->error['gst'] = $this->language->get('error_gst');
        }
        
        if (($this->request->post['closing_gross_weight'] == '')) {
            $this->error['closing_gross_weight'] = $this->language->get('error_closing');
        }
        $customer_info = $this->model_customer_customer->getCustomerByEmail($this->request->post['email']);

        if (!isset($this->request->get['customer_id'])) {
            if ($customer_info) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        } else {
            if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

        if ((utf8_strlen($this->request->post['telephone']) < 8) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if ((utf8_strlen($this->request->post['mobile']) < 10) || (utf8_strlen($this->request->post['mobile']) > 11)) {
            $this->error['mobile'] = $this->language->get('error_mobile');
        }

        if (isset($this->request->post['address'])) {
            foreach ($this->request->post['address'] as $key => $value) {
                if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
                    $this->error['address'][$key]['firstname'] = $this->language->get('error_firstname');
                }

                if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
                    $this->error['address'][$key]['lastname'] = $this->language->get('error_firstname');
                }

                if ((utf8_strlen($value['address_1']) < 1) || (utf8_strlen($value['address_1']) > 32)) {
                    $this->error['address'][$key]['address_1'] = $this->language->get('error_firstname');
                }

                if ((utf8_strlen($value['city']) < 1) || (utf8_strlen($value['city']) > 32)) {
                    $this->error['address'][$key]['city'] = $this->language->get('error_firstname');
                }

                $this->load->model('localisation/country');

                $country_info = $this->model_localisation_country->getCountry($value['country_id']);

                if ($country_info && $country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2 || utf8_strlen($value['postcode']) > 10)) {
                    $this->error['address'][$key]['postcode'] = $this->language->get('error_postcode');
                }

                if ($value['country_id'] == '') {
                    $this->error['address'][$key]['country'] = $this->language->get('error_country');
                }

                if (!isset($value['zone_id']) || $value['zone_id'] == '') {
                    $this->error['address'][$key]['zone'] = $this->language->get('error_zone');
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->member->hasPermission('modify', 'customer/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function file() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['files'] = array();

        $results = $this->model_customer_customer->getFiles($customer_id, ($page - 1) * 10, 10);

        foreach ($results as $result) {
            if (file_exists(DIR_DOWNLOAD . urldecode($result['filename']))) {
                $size = filesize(DIR_DOWNLOAD . urldecode($result['filename']));

                $i = 0;

                $suffix = array(
                    'B',
                    'KB',
                    'MB',
                    'GB',
                    'TB',
                    'PB',
                    'EB',
                    'ZB',
                    'YB'
                );

                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }

                $data['files'][] = array(
                    'filename' => urldecode($result['name']),
                    'size' => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
                    'href' => $this->url->link('customer/customer/download', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . $customer_id . '&customer_file_id=' . $result['customer_file_id'], true),
                    'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
                );
            }
        }

        $file_total = $this->model_customer_customer->getTotalFilesByCustomerId($customer_id);

        $data['pagination'] = $this->load->controller('common/pagination', array(
            'total' => $file_total,
            'page' => $page,
            'limit' => 10,
            'href' => $this->url->link('customer/customer/file', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . $customer_id . '&page={page}')
        ));

        $data['results'] = sprintf($this->language->get('text_pagination'), ($file_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($file_total - 10)) ? $file_total : ((($page - 1) * 10) + 10), $file_total, ceil($file_total / 10));

        $this->response->setOutput($this->load->view('customer/customer_file', $data));
    }

    public function addfile() {
        $this->load->language('customer/customer');

        $json = array();

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (!$this->member->hasPermission('modify', 'customer/customer')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            $this->load->model('customer/customer');

            $this->model_customer_customer->addFile($customer_id, $this->request->post['download_name'], $this->request->post['filename'], $this->request->post['mask']);

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function history() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['histories'] = array();

        $results = $this->model_customer_customer->getHistories($customer_id, ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $data['histories'][] = array(
                'comment' => $result['comment'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $history_total = $this->model_customer_customer->getTotalHistoriesByCustomerId($customer_id);

        $data['pagination'] = $this->load->controller('common/pagination', array(
            'total' => $history_total,
            'page' => $page,
            'limit' => 10,
            'url' => $this->url->link('customer/customer/history', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . $customer_id . '&page={page}')
        ));

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('customer/customer_history', $data));
    }

    public function addhistory() {
        $this->load->language('customer/customer');

        $json = array();

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (!$this->member->hasPermission('modify', 'customer/customer')) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            $this->load->model('customer/customer');

            $this->model_customer_customer->addHistory($customer_id, $this->request->post['comment']);

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function mail() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $customer_info = $this->model_customer_customer->getCustomerEmail($customer_id);

        $data['mails'] = array();

        $results = $this->model_customer_customer->getMails($customer_info['email'], ($page - 1) * 10, 10);

        $this->load->model('member/member');

        foreach ($results as $result) {
            $member_info = $this->model_member_member->getMember($result['member_id']);

            $data['mails'][] = array(
                'member' => $member_info['firstname'] . ' ' . $member_info['lastname'],
                'email' => $result['email'],
                'subject' => $result['subject'],
                'status' => $result['status'],
                'viewed' => $result['viewed'],
                'date_sent' => date($this->language->get('datetime_format'), strtotime($result['date_sent'])),
                'date_read' => date($this->language->get('datetime_format'), strtotime($result['date_read']))
            );
        }

        $history_total = $this->model_customer_customer->getTotalMailsByEmail($customer_info['email']);

        $data['pagination'] = $this->load->controller('common/pagination', array(
            'total' => $history_total,
            'page' => $page,
            'limit' => 10,
            'url' => $this->url->link('customer/customer/mail', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . $customer_id . '&page={page}')
        ));

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('customer/customer_mail', $data));
    }

    public function upload() {
        $this->load->language('customer/customer');

        $json = array();

        # Check user has permission
        if (!$this->member->hasPermission('modify', 'customer/customer')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
                # Sanitize the filename
                $filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

                # Validate the filename length
                if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
                    $json['error'] = $this->language->get('error_filename');
                }

                # Allowed file extention types
                $allowed = array();

                $extention_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

                $filetypes = explode("\n", $extention_allowed);

                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                # Allowed file mime type
                $allowed = array();

                $mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

                $filetypes = explode("\n", $mime_allowed);

                foreach ($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if (!in_array($this->request->files['file']['type'], $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                # Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($this->request->files['file']['tmp_name']);

                if (preg_match('/\<\?php/i', $content)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                # Return an upload error
                if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('error_upload');
            }
        }

        if (!$json) {
            //$file = $filename . '.' . token(32);

            move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $filename);

            $json['filename'] = $filename;
            $json['mask'] = $filename . '.' . token(32);

            $json['success'] = $this->language->get('text_upload');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function download() {
        $this->load->model('customer/customer');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        if (isset($this->request->get['customer_file_id'])) {
            $customer_file_id = $this->request->get['customer_file_id'];
        } else {
            $customer_file_id = 0;
        }

        $customer_file_info = $this->model_customer_customer->getFile($customer_file_id);

        if ($customer_file_info) {
            $file = DIR_DOWNLOAD . $customer_file_info['filename'];

            if (!headers_sent()) {
                if (file_exists($file)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename = "' . basename($file) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));

                    if (ob_get_level()) {
                        ob_end_clean();
                    }

                    readfile($file, 'rb');

                    exit();
                } else {
                    exit('Error: Could not find file ' . $file . '!');
                    ;
                }
            } else {
                exit('Error: Headers already sent out!');
            }
        } else {
            $this->response->redirect($this->url->link('customer/customer/edit', 'member_token=' . $this->session->data['member_token'] . '&customer_id=' . (int) $customer_id, true));
        }
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name']) || isset($this->request->get['email'])) {
            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['filter_email'])) {
                $filter_email = $this->request->get['filter_email'];
            } else {
                $filter_email = '';
            }

            $this->load->model('customer/customer');

            $filter_data = array(
                'filter_name' => $filter_name,
                'filter_email' => $filter_email,
                'start' => 0,
                'limit' => 5
            );

            $results = $this->model_customer_customer->getCustomers($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'customer_id' => $result['customer_id'],
                    'customer_group_id' => $result['customer_group_id'],
                    'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'customer_group' => $result['customer_group'],
                    'firstname' => $result['firstname'],
                    'lastname' => $result['lastname'],
                    'email' => $result['email'],
                    'telephone' => $result['telephone'],
                    'fax' => $result['fax'],
                    'address' => $this->model_customer_customer->getAddresses($result['customer_id'])
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function autocompleteFiles() {
        $json = array();

        if (isset($this->request->get['filter_name']) && isset($this->request->get['customer_id'])) {
            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['customer_id'])) {
                $customer_id = (int) $this->request->get['customer_id'];
            } else {
                $customer_id = 0;
            }

            $this->load->model('customer/customer');

            $filter_data = array(
                'filter_name' => $filter_name,
                'start' => 0,
                'limit' => 5
            );

            $results = $this->model_customer_customer->getFilesByCustomerId($customer_id, $filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'customer_file_id' => $result['customer_file_id'],
                    'customer_id' => $result['customer_id'],
                    'name' => strip_tags(html_entities_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'filename' => urldecode($result['filename']),
                    'mask' => urldecode($result['mask']),
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
