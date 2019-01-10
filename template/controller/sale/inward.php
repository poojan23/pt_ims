<?php

class ControllerSaleInward extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        $this->getList();
    }

    public function add() {
        $this->load->language('sale/inward');

        $this->load->model('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_inward->addInward($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true));
        }
        
        $this->getForm();
    }

    public function edit() {
        $this->load->model('sale/inward');

        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_inward->editInward($this->request->get['inward_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get['text_success'];

            $this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->model('sale/inward');

        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->post['selected']) {
            foreach ($this->request->post['selected'] as $inward_id) {
                $this->model_sale_inward->deleteInward($inward_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true));
        }
    }

    protected function getList() {
        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('sale/inward/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('sale/inward/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('sale/inward/delete', 'member_token=' . $this->session->data['member_token'], true);

        $data['text_confirm'] = $this->language->get('text_confirm');

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/inward_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('sale/inward');

        $results = $this->model_sale_inward->getInwards();

        $table = array();

        foreach ($results as $result) {
            $nestedData['inward_id'] = $result['inward_id'];
            $nestedData['customer_name'] = $result['customer_name'];
            $nestedData['product_type'] = $result['product_type'];
            $nestedData['product_code'] = $result['product_code'];
            $nestedData['inward_date'] = $result['inward_date'];
            $nestedData['truck_no'] = $result['truck_no'];
            $nestedData['coil_no'] = $result['coil_no'];
            $nestedData['thickness'] = $result['thickness'];
            $nestedData['width'] = $result['width'];
            $nestedData['length'] = $result['length'];
            $nestedData['pieces'] = $result['pieces'];
            $nestedData['packaging'] = $result['packaging'];
            $nestedData['gross_weight'] = $result['gross_weight'];
            $nestedData['net_weight'] = $result['net_weight'];

            $table[] = $nestedData;
        }

        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['inward_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['member_token'] = $this->session->data['member_token'];

        if (isset($this->request->get['inward_id'])) {
            $data['inward_id'] = (int) $this->request->get['inward_id'];
        } else {
            $data['inward_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['customer_id'])) {
            $data['customer_error'] = $this->error['customer_id'];
        } else {
            $data['customer_error'] = '';
        }

        if (isset($this->error['truck_no'])) {
            $data['error_truck_no'] = $this->error['truck_no'];
        } else {
            $data['error_truck_no'] = '';
        }

        if (isset($this->error['coil_no'])) {
            $data['error_coil_no'] = $this->error['coil_no'];
        } else {
            $data['error_coil_no'] = '';
        }

        if (isset($this->error['product_type_id'])) {
            $data['error_product_type'] = $this->error['product_type_id'];
        } else {
            $data['error_product_type'] = '';
        }

        if (isset($this->error['thickness'])) {
            $data['error_thickness'] = $this->error['thickness'];
        } else {
            $data['error_thickness'] = '';
        }

        if (isset($this->error['width'])) {
            $data['error_width'] = $this->error['width'];
        } else {
            $data['error_width'] = '';
        }

        if (isset($this->error['length'])) {
            $data['error_length'] = $this->error['length'];
        } else {
            $data['error_length'] = '';
        }

        if (isset($this->error['pieces'])) {
            $data['error_pieces'] = $this->error['pieces'];
        } else {
            $data['error_pieces'] = '';
        }

        if (isset($this->error['product_id'])) {
            $data['error_product'] = $this->error['product_id'];
        } else {
            $data['error_product'] = '';
        }

        if (isset($this->error['gross_weight'])) {
            $data['error_gross_weight'] = $this->error['gross_weight'];
        } else {
            $data['error_gross_weight'] = '';
        }

        if (isset($this->error['net_weight'])) {
            $data['error_net_weight'] = $this->error['net_weight'];
        } else {
            $data['error_net_weight'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['inward_id'])) {
            $data['action'] = $this->url->link('sale/inward/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('sale/inward/add', 'member_token' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('sale/inward/edit', 'member_token=' . $this->session->data['member_token'] . '&inward_id=' . $this->request->get['inward_id'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('sale/inward/edit', 'member_token' . $this->session->data['member_token'], true)
            );
        }

        $data['member_token'] = $this->session->data['member_token'];

        $data['cancel'] = $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['inward_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $inward_info = $this->model_sale_inward->getInward($this->request->get['inward_id']);
        }

        if (isset($this->request->post['inward_date'])) {
            $data['inward_date'] = $this->request->post['inward_date'];
        } elseif (!empty($inward_info)) {
            $data['inward_date'] = $inward_info['inward_date'];
        } else {
            $data['inward_date'] = '';
        }


        $this->load->model('customer/customer');

        $data['customers'] = $this->model_customer_customer->getCustomers();

        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($inward_info)) {
            $data['customer_id'] = $inward_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }

        $this->load->model('product/product_type');

        $data['product_types'] = $this->model_product_product_type->getProductType();

        if (isset($this->post['product_type_id'])) {
            $data['product_type_id'] = $this->request->post['product_type_id'];
        } elseif (!empty($inward_info)) {
            $data['product_type_id'] = $inward_info['product_type_id'];
        } else {
            $data['product_type_id'] = '';
        }

        if (isset($this->post['product_type'])) {
            $data['product_type_name'] = $this->request->post['product_type'];
        } elseif (!empty($inward_info)) {
            $data['product_type_name'] = $inward_info['product_type'];
        } else {
            $data['product_type_name'] = '';
        }

        $this->load->model('product/product');

        $data['products'] = $this->model_product_product->getProduct();

        if (isset($this->post['product_id'])) {
            $data['product_id'] = $this->request->post['product_id'];
        } elseif (!empty($inward_info)) {
            $data['product_id'] = $inward_info['product_id'];
        } else {
            $data['product_id'] = '';
        }


        if (isset($this->post['truck_no'])) {
            $data['truck_no'] = $this->request->post['truck_no'];
        } elseif (!empty($inward_info)) {
            $data['truck_no'] = $inward_info['truck_no'];
        } else {
            $data['truck_no'] = '';
        }

        if (isset($this->post['coil_no'])) {
            $data['coil_no'] = $this->request->post['coil_no'];
        } elseif (!empty($inward_info)) {
            $data['coil_no'] = $inward_info['coil_no'];
        } else {
            $data['coil_no'] = '';
        }

        if (isset($this->post['gross_weight'])) {
            $data['gross_weight'] = $this->request->post['gross_weight'];
        } elseif (!empty($inward_info)) {
            $data['gross_weight'] = $inward_info['gross_weight'];
        } else {
            $data['gross_weight'] = '';
        }

        if (isset($this->post['net_weight'])) {
            $data['net_weight'] = $this->request->post['net_weight'];
        } elseif (!empty($inward_info)) {
            $data['net_weight'] = $inward_info['net_weight'];
        } else {
            $data['net_weight'] = '';
        }

        if (isset($this->post['thickness'])) {
            $data['thickness'] = $this->request->post['thickness'];
        } elseif (!empty($inward_info)) {
            $data['thickness'] = $inward_info['thickness'];
        } else {
            $data['thickness'] = '';
        }

        if (isset($this->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($inward_info)) {
            $data['width'] = $inward_info['width'];
        } else {
            $data['width'] = '';
        }

        if (isset($this->post['length'])) {
            $data['length'] = $this->request->post['length'];
        } elseif (!empty($inward_info)) {
            $data['length'] = $inward_info['length'];
        } else {
            $data['length'] = '';
        }

        if (isset($this->post['pieces'])) {
            $data['pieces'] = $this->request->post['pieces'];
        } elseif (!empty($inward_info)) {
            $data['pieces'] = $inward_info['pieces'];
        } else {
            $data['pieces'] = '';
        }

        if (isset($this->post['packaging'])) {
            $data['packaging'] = $this->request->post['packaging'];
        } elseif (!empty($inward_info)) {
            $data['packaging'] = $inward_info['packaging'];
        } else {
            $data['packaging'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/inward_form', $data));
    }

    protected function validateForm() {        
        if (!$this->member->hasPermission('modify', 'sale/inward')) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (($this->request->post['customer_id'] == '')) {
            $this->error['customer_id'] = $this->language->get('error_customer');
        }

        if (($this->request->post['truck_no'] == '')) {
            $this->error['truck_no'] = $this->language->get('error_truck_no');
        }

        if (($this->request->post['coil_no'] == '')) {
            $this->error['coil_no'] = $this->language->get('error_coil_no');
        }

        if (($this->request->post['product_type_id'] == '')) {
            $this->error['product_type_id'] = $this->language->get('error_product_type');
        }

        if (($this->request->post['thickness'] == '')) {
            $this->error['thickness'] = $this->language->get('error_thickness');
        }

        if (($this->request->post['width'] == '')) {
            $this->error['width'] = $this->language->get('error_width');
        }

        if (($this->request->post['length'] == '')) {
            $this->error['length'] = $this->language->get('error_length');
        }

        if (($this->request->post['pieces'] == '')) {
            $this->error['pieces'] = $this->language->get('error_pieces');
        }

        if (($this->request->post['product_id'] == '')) {
            $this->error['product_id'] = $this->language->get('error_product');
        }

        if (($this->request->post['gross_weight'] == '')) {
            $this->error['gross_weight'] = $this->language->get('error_gross_weight');
        }

        if (($this->request->post['net_weight'] == '')) {
            $this->error['net_weight'] = $this->language->get('error_net_weight');
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

}
