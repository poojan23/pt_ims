<?php

class ControllerProductProduct extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        $this->getList();
    }

    public function add() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_product_product->addProduct($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_product_product->editProduct($this->request->get['product_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->model('product/product');

        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->post['selected']) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_product_product->deleteProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true));
        }
    }
    protected function getList() {

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('product/product/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('product/product/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('product/product/delete', 'member_token=' . $this->session->data['member_token'], true);

        $data['text_confirm'] = $this->language->get('text_confirm');

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

        $this->response->setOutput($this->load->view('product/product_list', $data));
    }

    public function getData() {
        $json = [];

        $this->load->model('product/product');

        $totalData = $this->model_product_product->getTotalProducts();

        $totalFiltered = $totalData;

        $results = $this->model_product_product->getProduct();

        $table = [];

        foreach ($results as $result) {

            $nestedData['product_id'] = $result['product_id'];
            $nestedData['product_name'] = $result['product_name'];
            $nestedData['product_code'] = $result['product_code'];

            $table[] = $nestedData;
        }

        $json = array(
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        
        $data['member_token'] = $this->session->data['member_token'];
        
        if (isset($this->request->get['product_id'])) {
            $data['product_id'] = (int) $this->request->get['product_id'];
        } else {
            $data['product_id'] = 0;
        }
        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['product_name'])) {
            $data['error_product_name'] = $this->error['product_name'];
        } else {
            $data['error_product_name'] = '';
        }

        if (isset($this->error['product_code'])) {
            $data['error_product_code'] = $this->error['product_code'];
        } else {
            $data['error_product_code'] = '';
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true)
        ];

        if (!isset($this->request->get['product_id'])) {
            $data['action'] = $this->url->link('product/product/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('product/product/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('product/product/edit', 'member_token=' . $this->session->data['member_token'] . '&product_id=' . $this->request->get['product_id'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('product/product/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $product_info = $this->model_product_product->getProductByID($this->request->get['product_id']);
        }

        $data['member_token'] = $this->session->data['member_token'];

        if (isset($this->request->post['product_name'])) {
            $data['product_name'] = $this->request->post['product_name'];
        } elseif (!empty($product_info)) {
            $data['product_name'] = $product_info['product_name'];
        } else {
            $data['product_name'] = '';
        }

        if (isset($this->request->post['product_code'])) {
            $data['product_code'] = $this->request->post['product_code'];
        } elseif (!empty($product_info)) {
            $data['product_code'] = $product_info['product_code'];
        } else {
            $data['product_code'] = '';
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($product_info)) {
            $data['sort_order'] = $product_info['sort_order'];
        } else {
            $data['sort_order'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_form', $data));
    }

    protected function validateForm() {
        if (!$this->member->hasPermission('modify', 'product/product')) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (($this->request->post['product_name'] == '')) {
            $this->error['product_name'] = $this->language->get('error_product_name');
        }

        if (($this->request->post['product_code'] == '')) {
            $this->error['product_code'] = $this->language->get('error_product_code');
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'product/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

}
