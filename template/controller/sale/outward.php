<?php

class ControllerSaleOutward extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('sale/outward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/outward');

        $this->getList();
    }

    public function add() {
        $this->load->model('sale/outward');

        $this->load->language('sale/outward');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD']) == 'POST') {
            $this->model_sale_outward->addOutward($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true));
        }
        $this->getForm();
    }

    public function edit() {
        $this->load->model('sale/outward');

        $this->load->language('sale/outward');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_sale_outward->editOutward($this->request->get['delivery_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get['text_success'];

            $this->response->redirect($this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->model('sale/outward');

        $this->load->language('sale/outward');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->post['selected']) {
            foreach ($this->request->post['selected'] as $delivery_id) {
                $this->model_sale_outward->deleteOutward($delivery_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true));
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
            'href' => $this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('sale/outward/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('sale/outward/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('sale/outward/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('sale/outward_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('sale/outward');

        $results = $this->model_sale_outward->getOutwards();

        $table = array();

        foreach ($results as $result) {
            $nestedData['delivery_id'] = $result['delivery_id'];
            $nestedData['order_weight_id'] = $result['order_weight_id'];
            $nestedData['delivery_date'] = $result['delivery_date'];
            $nestedData['order_no'] = $result['order_no'];
            $nestedData['truck_no'] = $result['truck_no'];
            $nestedData['challan_no'] = $result['challan_no'];
            $nestedData['customer_name'] = $result['customer_name'];
            $nestedData['coil_no'] = $result['coil_no'];
            $nestedData['customer_id'] = $result['customer_id'];
            $nestedData['order_weight_id'] = $result['order_weight_id'];
            $nestedData['product_id'] = $result['product_id'];
            $nestedData['product_code'] = $result['product_code'];
            $nestedData['thickness'] = $result['thickness'];
            $nestedData['width'] = $result['width'];
            $nestedData['length'] = $result['length'];
            $nestedData['pieces'] = $result['pieces'];
            $nestedData['gross_weight'] = $result['gross_weight'];
            $nestedData['service_type'] = $result['service_type'];
            $nestedData['aging'] = $result['aging'];
            $nestedData['packaging'] = $result['packaging'];

            $table[] = $nestedData;
        }
        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type : application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['delivery_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->request->get['delivery_id'])) {
            $data['delivery_id'] = (int) $this->request->get['delivery_id'];
        } else {
            $data['delivery_id'] = 0;
        }

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
            'href' => $this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['delivery_id'])) {
            $data['action'] = $this->url->link('sale/outward/add', 'member_token=' . $this->session->data['member_token'], true);
            $dat['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('sale/outward/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('sale/outward/edit', 'member_token=' . $this->session->data['member_token'] . '&delivery_id=' . $this->request->get['delivery_id'], true);
            $dat['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('sale/outward/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        if (isset($this->request->get['delivery_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $outward_info = $this->model_sale_outward->getOutward($this->request->get['delivery_id']);
        }

        if (isset($this->post['delivery_date'])) {
            $data['delivery_date'] = $this->request->post['delivery_date'];
        } elseif (!empty($outward_info)) {
            $data['delivery_date'] = $outward_info['delivery_date'];
        } else {
            $data['delivery_date'] = '';
        }

        if (isset($this->post['customer_name'])) {
            $data['customer_name'] = $this->request->post['customer_name'];
        } elseif (!empty($outward_info)) {
            $data['customer_name'] = $outward_info['customer_name'];
        } else {
            $data['customer_name'] = '';
        }

        if (isset($this->post['order_no'])) {
            $data['order_no'] = $this->request->post['order_no'];
        } elseif (!empty($outward_info)) {
            $data['order_no'] = $outward_info['order_no'];
        } else {
            $data['order_no'] = '';
        }

        if (isset($this->post['truck_no'])) {
            $data['truck_no'] = $this->request->post['truck_no'];
        } elseif (!empty($outward_info)) {
            $data['truck_no'] = $outward_info['truck_no'];
        } else {
            $data['truck_no'] = '';
        }

        if (isset($this->post['challan_no'])) {
            $data['challan_no'] = $this->request->post['customer_name'];
        } elseif (!empty($outward_info)) {
            $data['challan_no'] = $outward_info['challan_no'];
        } else {
            $data['challan_no'] = '';
        }

        if (isset($this->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($outward_info)) {
            $data['customer_id'] = $outward_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }

        if (isset($this->post['product_code'])) {
            $data['product_code'] = $this->request->post['product_code'];
        } elseif (!empty($outward_info)) {
            $data['product_code'] = $outward_info['product_code'];
        } else {
            $data['product_code'] = '';
        }

        if (isset($this->post['thickness'])) {
            $data['thickness'] = $this->request->post['thickness'];
        } elseif (!empty($outward_info)) {
            $data['thickness'] = $outward_info['thickness'];
        } else {
            $data['thickness'] = '';
        }

        if (isset($this->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($outward_info)) {
            $data['width'] = $outward_info['width'];
        } else {
            $data['width'] = '';
        }

        if (isset($this->post['length'])) {
            $data['width'] = $this->request->post['length'];
        } elseif (!empty($outward_info)) {
            $data['length'] = $outward_info['length'];
        } else {
            $data['length'] = '';
        }

        if (isset($this->post['pieces'])) {
            $data['pieces'] = $this->request->post['pieces'];
        } elseif (!empty($outward_info)) {
            $data['pieces'] = $outward_info['pieces'];
        } else {
            $data['pieces'] = '';
        }

        if (isset($this->post['service_type'])) {
            $data['service_type'] = $this->request->post['service_type'];
        } elseif (!empty($outward_info)) {
            $data['service_type'] = $outward_info['service_type'];
        } else {
            $data['service_type'] = '';
        }

        if (isset($this->post['gross_weight'])) {
            $data['gross_weight'] = $this->request->post['gross_weight'];
        } elseif (!empty($outward_info)) {
            $data['gross_weight'] = $outward_info['gross_weight'];
        } else {
            $data['gross_weight'] = '';
        }

        if (isset($this->post['coil_no'])) {
            $data['coil_no'] = $this->request->post['coil_no'];
        } elseif (!empty($outward_info)) {
            $data['coil_no'] = $outward_info['coil_no'];
        } else {
            $data['coil_no'] = '';
        }

        if (isset($this->post['packaging'])) {
            $data['packaging'] = $this->request->post['packaging'];
        } elseif (!empty($outward_info)) {
            $data['packaging'] = $outward_info['packaging'];
        } else {
            $data['packaging'] = '';
        }

//        $this->load->model('sale/order');
//
//        $data['coil_nos'] = $this->model_sale_order->getCoilNo();
////         print_r($data['coil_nos']);exit;
//        if (isset($this->post['coil_no'])) {
//            $data['coil_no'] = $this->request->post['coil_no'];
//        } elseif (!empty($outward_info)) {
//            $data['coil_no'] = $outward_info['coil_no'];
//        } else {
//            $data['coil_no'] = '';
//        }


        $data['cancel'] = $this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true);

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/outward_form', $data));
    }

    public function getOrderNosByCoilNo() {
        $json = array();

        if (isset($this->request->post['coil_no'])) {
            $coil_no = $this->request->post['coil_no'];
        } else {
            $coil_no = 0;
        }

        $this->load->model('sale/outward');

        $results = $this->model_sale_outward->getOrderNosByCoilNo($coil_no);

        foreach ($results as $result) {
            $json[] = array(
                'order_no' => $result['order_no']
            );
        }

        $this->response->addHeader('Content-Type : application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getOutwardDetailsByOrderNo() {
        $json = array();

        if (isset($this->request->post['order_no'])) {
            $order_no = $this->request->post['order_no'];
        } else {
            $order_no = 0;
        }

        $this->load->model('sale/outward');

        $results = $this->model_sale_outward->getOutwardDetailsByOrderNo($order_no);


        $json = array(
            'order_id' => $results['order_id'],
            'customer_id' => $results['customer_id'],
            'customer_name' => $results['customer_name'],
            'product_id' => $results['product_id'],
            'product_code' => $results['product_code'],
            'thickness' => $results['thickness'],
            'width' => $results['width'],
            'length' => $results['length'],
            'service_type' => $results['service_type'],
        );



        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
