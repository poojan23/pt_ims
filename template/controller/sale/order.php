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

        if (($this->request->server['REQUEST_METHOD']) == 'POST') {
            $this->model_sale_order->addOrder($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true));
        }
        $this->getForm();
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

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['order_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
            $data['action'] = $this->url->link('sale/order/edit', 'member_token=' . $this->session->data['member_token'], true);
            $dat['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('sale/order/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
        }

        if (isset($this->post['order_date'])) {
            $data['order_date'] = $this->request->post['order_date'];
        } elseif (!empty($order_info)) {
            $data['order_date'] = $order_info['order_date'];
        } else {
            $data['order_date'] = '';
        }

        $this->load->model('sale/inward');

        $data['coil_nos'] = $this->model_sale_inward->getInwards();
//         print_r($data['coil_nos']);exit;
        if (isset($this->post['coil_no'])) {
            $data['coil_no'] = $this->request->post['coil_no'];
        } elseif (!empty($order_info)) {
            $data['coil_no'] = $order_info['coil_no'];
        } else {
            $data['coil_no'] = '';
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
            'inward_weight_id' => $results['inward_weight_id'],
            'customer_id' => $results['customer_id'],
            'customer_name' => $results['customer_name'],
            'product_id' => $results['product_id'],
            'product_code' => $results['product_code'],
            'product_type' => $results['product_type'],
            'thickness' => $results['thickness'],
            'width' => $results['width']
        );
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
