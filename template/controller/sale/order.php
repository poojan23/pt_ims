<?php

class ControllerSaleOrder extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/order');

        $this->getList();
    }

    public function add() {
        $this->load->model('sale/order');

        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_order->addOrder($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true));
        }
        $this->getForm();
    }

    public function edit() {
        $this->load->model('sale/order');

        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_order->editOrder($this->request->get['order_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get['text_success'];

            $this->response->redirect($this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->model('sale/order');

        $this->load->language('sale/order');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->post['selected']) {
            foreach ($this->request->post['selected'] as $order_id) {
                $this->model_sale_order->deleteOrder($order_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true));
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
            'href' => $this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('sale/order/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('sale/order/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('sale/order/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('sale/order_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('sale/order');

        $results = $this->model_sale_order->getOrders();

        $table = array();

        foreach ($results as $result) {
            $nestedData['order_id'] = $result['order_id'];
            $nestedData['order_no'] = $result['order_no'];
            $nestedData['order_date'] = $result['order_date'];
            $nestedData['customer_name'] = $result['customer_name'];
            $nestedData['coil_no'] = $result['coil_no'];
            $nestedData['customer_id'] = $result['customer_id'];
            $nestedData['inward_weight_id'] = $result['inward_weight_id'];
            $nestedData['product_id'] = $result['product_id'];
            $nestedData['product_code'] = $result['product_code'];
            $nestedData['thickness'] = $result['thickness'];
            $nestedData['width'] = $result['width'];
            $nestedData['length'] = $result['length'];
            $nestedData['pieces'] = $result['pieces'];
            $nestedData['net_weight'] = $result['net_weight'];
            $nestedData['service_type'] = $result['service_type'];
            $nestedData['aging'] = $result['aging'];

            $table[] = $nestedData;
        }
        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type : application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['order_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->request->get['order_id'])) {
            $data['order_id'] = (int) $this->request->get['order_id'];
        } else {
            $data['order_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }
        
        if (isset($this->error['coil_no'])) {
            $data['error_coil_no'] = $this->error['coil_no'];
        } else {
            $data['error_coil_no'] = '';
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

        if (isset($this->error['service_type'])) {
            $data['error_service_type'] = $this->error['service_type'];
        } else {
            $data['error_service_type'] = '';
        }
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $dat['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['order_id'])) {
            $data['action'] = $this->url->link('sale/order/add', 'member_token=' . $this->session->data['member_token'], true);
            $dat['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('sale/order/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('sale/order/edit', 'member_token=' . $this->session->data['member_token'] . '&order_id=' . $this->request->get['order_id'], true);
            $dat['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('sale/order/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
        }

        if (isset($this->request->post['order_id'])) {
            $data['order_id'] = $this->request->post['order_id'];
        } elseif (!empty($order_info)) {
            $data['order_id'] = $order_info['order_id'];
        } else {
            $data['order_id'] = '';
        }
        if (isset($this->request->post['order_date'])) {
            $data['order_date'] = $this->request->post['order_date'];
        } elseif (!empty($order_info)) {
            $data['order_date'] = $order_info['order_date'];
        } else {
            $data['order_date'] = '';
        }

        if (isset($this->request->post['customer_name'])) {
            $data['customer_name'] = $this->request->post['customer_name'];
        } elseif (!empty($order_info)) {
            $data['customer_name'] = $order_info['customer_name'];
        } else {
            $data['customer_name'] = '';
        }

        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($order_info)) {
            $data['customer_id'] = $order_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }

        if (isset($this->request->post['product_code'])) {
            $data['product_code'] = $this->request->post['product_code'];
        } elseif (!empty($order_info)) {
            $data['product_code'] = $order_info['product_code'];
        } else {
            $data['product_code'] = '';
        }

        if (isset($this->request->post['thickness'])) {
            $data['thickness'] = $this->request->post['thickness'];
        } elseif (!empty($order_info)) {
            $data['thickness'] = $order_info['thickness'];
        } else {
            $data['thickness'] = '';
        }

        if (isset($this->request->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($order_info)) {
            $data['width'] = $order_info['width'];
        } else {
            $data['width'] = '';
        }

        if (isset($this->request->post['length'])) {
            $data['length'] = $this->request->post['length'];
        } elseif (!empty($order_info)) {
            $data['length'] = $order_info['length'];
        } else {
            $data['length'] = '';
        }

        if (isset($this->request->post['pieces'])) {
            $data['pieces'] = $this->request->post['pieces'];
        } elseif (!empty($order_info)) {
            $data['pieces'] = $order_info['pieces'];
        } else {
            $data['pieces'] = '';
        }

        if (isset($this->request->post['net_weight'])) {
            $data['net_weight'] = $this->request->post['net_weight'];
        } elseif (!empty($order_info)) {
            $data['net_weight'] = $order_info['net_weight'];
        } else {
            $data['net_weight'] = '';
        }

        if (isset($this->request->post['service_type'])) {
            $data['service_type'] = $this->request->post['service_type'];
        } elseif (!empty($order_info)) {
            $data['service_type'] = $order_info['service_type'];
        } else {
            $data['service_type'] = '';
        }
        
       

        $this->load->model('sale/inward');

        $data['coil_nos'] = $this->model_sale_inward->getInwards();
//         print_r($data['coil_nos']);exit;
        if (isset($this->request->post['coil_no'])) {
            $data['coil_no'] = $this->request->post['coil_no'];
        } elseif (!empty($order_info)) {
            $data['coil_no'] = $order_info['coil_no'];
        } else {
            $data['coil_no'] = '';
        }
        
        if (isset($this->request->post['closed'])) {
            $data['closed'] = $this->request->post['closed'];
        } elseif (!empty($order_info)) {
            $data['closed'] = $order_info['closed'];
        } else {
            $data['closed'] = '';
        }
        
        $data['cancel'] = $this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true);

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/order_form', $data));
    }

    public function getOrderDetailsByCoilNo() {
        $json = array();

        if (isset($this->request->post['coil_no'])) {
            $coil_no = $this->request->post['coil_no'];
        } else {
            $coil_no = 0;
        }

        $this->load->model('sale/order');

        $results = $this->model_sale_order->getOrderDetailsByCoilNo($coil_no);
        $json = array(
            'inward_id' => $results['inward_id'],
            'net_weight' => $results['net_weight'],
            'gross_weight' => $results['gross_weight'],
            'inward_weight_id' => $results['inward_weight_id'],
            'customer_id' => $results['customer_id'],
            'customer_name' => $results['customer_name'],
            'product_id' => $results['product_id'],
            'product_code' => $results['product_code'],
            'product_type' => $results['product_type'],
            'thickness' => $results['thickness'],
            'width' => $results['width'],
            'closed' => $results['closed']
        );
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getNetWeight() {
        $json = array();

        if (isset($this->request->post['inward_id'])) {
            $inward_id = $this->request->post['inward_id'];
        } else {
            $inward_id = 0;
        }

        $this->load->model('sale/order');

        $results = $this->model_sale_order->getNetWeight($inward_id);
       
        $json = array(
            'net_weight' => $results['net_weight'],
        );
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function validateForm() {
        if (!$this->member->hasPermission('modify', 'sale/order')) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (($this->request->post['coil_no'] == '')) {
            $this->error['coil_no'] = $this->language->get('error_coil_no');
        }

        if (($this->request->post['length'] == '')) {
            $this->error['length'] = $this->language->get('error_length');
        }

        if (($this->request->post['pieces'] == '')) {
            $this->error['pieces'] = $this->language->get('error_pieces');
        }

        if (($this->request->post['service_type'] == '')) {
            $this->error['service_type'] = $this->language->get('error_service_type');
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }

}
