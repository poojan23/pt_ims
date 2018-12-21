<?php

class ControllerProductProductType extends Controller {

    private $error;

    public function index() {
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

        $this->getList();
    }

    public function add() {
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->model_product_product_type->addProductType($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->model_product_product_type->editProductType($this->request->get['product_type_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

     public function delete() {
        
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

        if (isset($this->request->post['selected'])) {
            
            foreach ($this->request->post['selected'] as $product_type_id) {
                $this->model_product_product_type->deleteProductType($product_type_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    public function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['add'] = $this->url->link('product/product_type/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('product/product_type/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('product/product_type/delete', 'member_token=' . $this->session->data['member_token'], true);

        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_type_list', $data));
    }

    public function getData() {
        $json = [];

        $this->load->model('product/product_type');

        $totalData = $this->model_product_product_type->getTotalProductTypes();

        $totalFiltered = $totalData;

        $results = $this->model_product_product_type->getProductType();

        $table = [];

        foreach ($results as $result) {

            $nestedData['product_type_id'] = $result['product_type_id'];
            $nestedData['product_type'] = $result['product_type'];
            $nestedData['sort_order'] = $result['sort_order'];

            $table[] = $nestedData;
        }

        $json = array(
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $table
        );

        echo json_encode($json);
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['product_type_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['product_type_id'])) {
            $data['action'] = $this->url->link('product/product_type/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('product/product_type/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('product/product_type/edit', 'member_token=' . $this->session->data['member_token'] . '&product_type_id=' . $this->request->get['product_type_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('product/product_type/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['product_type_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
            $product_type_info = $this->model_product_product_type->getProductTypeByID($this->request->get['product_type_id']);
        }
        $data['member_token'] = $this->session->data['member_token'];
        if (isset($this->request->post['product_type'])) {
            $data['product_type'] = $this->request->post['product_type'];
        } elseif (!empty($product_type_info)) {
            $data['product_type'] = $product_type_info['product_type'];
        } else {
            $data['product_type'] = '';
        }
        

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($product_type_info)) {
            $data['sort_order'] = $product_type_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }
       
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_type_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'user/user_permission')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        
    }

}
