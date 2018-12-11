<?php

class ControllerCustomerCustomerGroup extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('customer/customer_group');

        $this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function add() {
        $this->load->language('customer/customer_group');

        $this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_customer_customer_group->addCustomerGroup($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    } 

    public function edit() {
        $this->load->language('customer/customer_group');

        $this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_customer_customer_group->editCustomerGroup($this->request->get['customer_group_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('customer/customer_group');

        $this->load->model('customer/customer_group');

        $this->document->setTitle($this->language->get('heading_title'));

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $customer_group_id) {
                $this->model_customer_customer_group->deleteCustomerGroup($customer_group_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token']), true);
        }

        $this->getList();
    }

    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('customer/customer_group/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('customer/customer_group/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('customer/customer_group/delete', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_group_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('customer/customer_group');

        $totalData = $this->model_customer_customer_group->getTotalCustomerGroups();

        $totalFiltered = $totalData;

        $results = $this->model_customer_customer_group->getCustomerGroups();

        $table = array();

        foreach($results as $result) {
            $nestedData['customer_group_id']    = $result['customer_group_id'];
            $nestedData['name']                 = $result['name'];
            $nestedData['sort_order']           = $result['sort_order'];

            $table[] = $nestedData;
        }

        $json = array(
            'recordsTotal'      => $totalData,
            'recordsFiltered'   => $totalFiltered,
            'data'              => $table
        );

        echo json_encode($json);
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['customer_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = array();
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true)
        );

        if(!isset($this->request->get['customer_group_id'])) {
            $data['action'] = $this->url->link('customer/customer_group/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('customer/customer_group/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('customer/customer_group/edit', 'member_token=' . $this->session->data['member_token'] . '&customer_group_id=' . $this->request->get['customer_group_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('customer/customer_group/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->request->get['customer_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_group_info = $this->model_customer_customer_group->getCustomerGroup($this->request->get['customer_group_id']);
        }

        $this->load->language('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if(isset($this->request->post['customer_group_description'])) {
            $data['customer_group_description'] = $this->request->post['customer_group_description'];
        } elseif(isset($this->request->get['customer_group_id'])) {
            $data['customer_group_description'] = $this->model_customer_customer_group->getCustomerGroupDescriptions($this->request->get['customer_group_id']);
        } else {
            $data['customer_group_description'] = array();
        }

        if(isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif(!empty($customer_group_info)) {
            $data['sort_order'] = $customer_group_info['sort_order'];
        } else {
            $data['sort_order'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_group_form', $data));
    }

    protected function validateForm() {
        if($this->member->hasPermission('modify', 'customer/customer_group')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('customer/customer_group');

        foreach($this->request->post['customer_group_description'] as $language_id => $value) {
            if((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }

            $customer_group_info = $this->model_customer_customer_group->getCustomerGroupByName($value['name']);

            if(!isset($this->request->get['customer_group_id'])) {
                if($customer_group_info) {
                    $this->error['warning'] = $this->language->get('error_exists');
                }
            } else {
                if($customer_group_info && ($this->request->get['customer_group_id'] != $customer_group_info['customer_group_id'])) {
                    $this->error['warning'] = $this->language->get('error_exists');
                }
            }
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if($this->member->hasPermission('modify', 'customer/customer_group')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('customer/customer');

        foreach($this->request->post['selected'] as $customer_group_id) {
            $customer_total = $this->model_customer_customer->getTotalCustomersByCustomerGroupId($customer_group_id);

            if($customer_total) {
                $this->error['warning'] = sprintf($this->language->get('error_customer'), $customer_total);
            }
        }

        return !$this->error;
    }
}
