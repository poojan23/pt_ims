<?php

class ControllerSaleTransferInward extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('sale/transfer_inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/transfer_inward');

        $this->getList();
    }

    public function add() {
        $this->load->language('sale/transfer_inward');

        $this->load->model('sale/transfer_inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD']) == 'POST') {
            $this->model_sale_transfer_inward->addTransferInward($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true));
        }
        $this->getForm();
    }

    public function edit() {
        $this->load->model('sale/transfer_inward');

        $this->load->language('sale/transfer_inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_sale_transfer_inward->editTransferInward($this->request->get['transfer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get['text_success'];

            $this->response->redirect($this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->model('sale/transfer_inward');

        $this->load->language('sale/transfer_inward');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->post['selected']) {
            foreach ($this->request->post['selected'] as $transfer_id) {
                $this->model_sale_transfer_inward->deleteTransferInward($transfer_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true));
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
            'href' => $this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('sale/transfer_inward/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('sale/transfer_inward/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('sale/transfer_inward/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('sale/transfer_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('sale/transfer_inward');

        $results = $this->model_sale_transfer_inward->getTransferInwards();

        $table = array();

        foreach ($results as $result) {
            $nestedData['transfer_id'] = $result['transfer_id'];
            $nestedData['customer_name'] = $result['customer_name'];
            $nestedData['product_type'] = $result['product_type'];
            $nestedData['product_code'] = $result['product_code'];
            $nestedData['transfer_Date'] = $result['transfer_Date'];
            $nestedData['truck_no'] = $result['truck_no'];
            $nestedData['trans_coil_no'] = $result['trans_coil_no'];
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
        $data['text_form'] = !isset($this->request->get['transfer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->request->get['transfer_id'])) {
            $data['transfer_id'] = (int) $this->request->get['transfer_id'];
        } else {
            $data['transfer_id'] = 0;
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

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true)
        );

        if (!isset($this->request->get['transfer_inward_id'])) {
            $data['action'] = $this->url->link('sale/transfer_inward/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_add'),
                'href' => $this->url->link('sale/transfer_inward/add', 'member_token' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('sale/transfer_inward/edit', 'member_token=' . $this->session->data['member_token'] . '&transfer_id=' . $this->request->get['transfer_id'], true);
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('sale/transfer_inward/edit', 'member_token' . $this->session->data['member_token'], true)
            );
        }

        $data['member_token'] = $this->session->data['member_token'];

        $data['cancel'] = $this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['transfer_inward_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $transfer_inward_info = $this->model_sale_transfer_inward->getTransferInward($this->request->get['transfer_id']);
        }

        if (isset($this->request->post['transfer_inward_date'])) {
            $data['transfer_date'] = $this->request->post['transfer_date'];
        } elseif (!empty($transfer_inward_info)) {
            $data['transfer_date'] = $transfer_inward_info['transfer_date'];
        } else {
            $data['transfer_date'] = '';
        }


        $this->load->model('customer/customer');

        $data['customers'] = $this->model_customer_customer->getCustomers();

        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($transfer_inward_info)) {
            $data['customer_id'] = $transfer_inward_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }

        $this->load->model('product/product_type');

        $data['product_types'] = $this->model_product_product_type->getProductType();

        if (isset($this->post['product_type_id'])) {
            $data['product_type_id'] = $this->request->post['product_type_id'];
        } elseif (!empty($transfer_inward_info)) {
            $data['product_type_id'] = $transfer_inward_info['product_type_id'];
        } else {
            $data['product_type_id'] = '';
        }

        if (isset($this->post['product_type'])) {
            $data['product_type_name'] = $this->request->post['product_type'];
        } elseif (!empty($transfer_inward_info)) {
            $data['product_type_name'] = $transfer_inward_info['product_type'];
        } else {
            $data['product_type_name'] = '';
        }

        $this->load->model('product/product');

        $data['products'] = $this->model_product_product->getProduct();

        if (isset($this->post['product_id'])) {
            $data['product_id'] = $this->request->post['product_id'];
        } elseif (!empty($transfer_inward_info)) {
            $data['product_id'] = $transfer_inward_info['product_id'];
        } else {
            $data['product_id'] = '';
        }


        if (isset($this->post['truck_no'])) {
            $data['truck_no'] = $this->request->post['truck_no'];
        } elseif (!empty($transfer_inward_info)) {
            $data['truck_no'] = $transfer_inward_info['truck_no'];
        } else {
            $data['truck_no'] = '';
        }

        if (isset($this->post['coil_no'])) {
            $data['coil_no'] = $this->request->post['coil_no'];
        } elseif (!empty($transfer_inward_info)) {
            $data['coil_no'] = $transfer_inward_info['coil_no'];
        } else {
            $data['coil_no'] = '';
        }

        if (isset($this->post['gross_weight'])) {
            $data['gross_weight'] = $this->request->post['gross_weight'];
        } elseif (!empty($transfer_inward_info)) {
            $data['gross_weight'] = $transfer_inward_info['gross_weight'];
        } else {
            $data['gross_weight'] = '';
        }

        if (isset($this->post['net_weight'])) {
            $data['net_weight'] = $this->request->post['net_weight'];
        } elseif (!empty($transfer_inward_info)) {
            $data['net_weight'] = $transfer_inward_info['net_weight'];
        } else {
            $data['net_weight'] = '';
        }

        if (isset($this->post['thickness'])) {
            $data['thickness'] = $this->request->post['thickness'];
        } elseif (!empty($transfer_inward_info)) {
            $data['thickness'] = $transfer_inward_info['thickness'];
        } else {
            $data['thickness'] = '';
        }

        if (isset($this->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($transfer_inward_info)) {
            $data['width'] = $transfer_inward_info['width'];
        } else {
            $data['width'] = '';
        }

        if (isset($this->post['length'])) {
            $data['length'] = $this->request->post['length'];
        } elseif (!empty($transfer_inward_info)) {
            $data['length'] = $transfer_inward_info['length'];
        } else {
            $data['length'] = '';
        }

        if (isset($this->post['pieces'])) {
            $data['pieces'] = $this->request->post['pieces'];
        } elseif (!empty($transfer_inward_info)) {
            $data['pieces'] = $transfer_inward_info['pieces'];
        } else {
            $data['pieces'] = '';
        }

        if (isset($this->post['packaging'])) {
            $data['packaging'] = $this->request->post['packaging'];
        } elseif (!empty($transfer_inward_info)) {
            $data['packaging'] = $transfer_inward_info['packaging'];
        } else {
            $data['packaging'] = '';
        }

        $this->load->model('sale/inward');

        $data['customers'] = $this->model_sale_inward->getInwards();

        if (isset($this->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($outward_info)) {
            $data['customer_id'] = $outward_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }
        print_r($data['customer_id']);
        if (isset($this->post['customer_name'])) {
            $data['customer_name'] = $this->request->post['customer_name'];
        } elseif (!empty($transfer_inward_info)) {
            $data['customer_name'] = $transfer_inward_info['customer_name'];
        } else {
            $data['customer_name'] = '';
        }
        
        $this->load->model('customer/customer');

        $data['transfersTo'] = $this->model_customer_customer->getCustomers();
//        print_r( $data['transferTo']);exit;
        if (isset($this->request->post['customer_id'])) {
            $data['customer_id'] = $this->request->post['customer_id'];
        } elseif (!empty($transfer_inward_info)) {
            $data['customer_id'] = $transfer_inward_info['customer_id'];
        } else {
            $data['customer_id'] = '';
        }
        
        if (isset($this->request->post['customer'])) {
            $data['customer'] = $this->request->post['customer'];
        } elseif (!empty($transfer_inward_info)) {
            $data['customer'] = $transfer_inward_info['customer'];
        } else {
            $data['customer'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/transfer_form', $data));
    }

    public function getCoilNosByCustomerId() {
        $json = array();

        if (isset($this->request->post['customer_id'])) {
            $customer_id = $this->request->post['customer_id'];
        } else {
            $customer_id = 0;
        }

        $this->load->model('sale/inward');

        $results = $this->model_sale_inward->getCoilNosByCustomerId($customer_id);

        foreach ($results as $result) {
            $json[] = array(
                'coil_no' => $result['coil_no']
            );
        }

        $this->response->addHeader('Content-Type : application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function getInwardDetailsByCoilNo() {
        $json = array();

        if (isset($this->request->post['coil_no'])) {
            $coil_no = $this->request->post['coil_no'];
        } else {
            $coil_no = 0;
        }

        $this->load->model('sale/inward');

        $results = $this->model_sale_inward->getInwardDetailsByCoilNo($coil_no);

        $json = array(
            'inward_id' => $results['inward_id'],
            'customer_id' => $results['customer_id'],
            'customer_name' => $results['customer_name'],
            'product_id' => $results['product_id'],
            'product_code' => $results['product_code'],
            'product_type' => $results['product_type'],
            'product_type_id' => $results['product_type_id'],
            'thickness' => $results['thickness'],
            'width' => $results['width'],
            'length' => $results['length'],
            'pieces' => $results['pieces'],
            'net_weight' => $results['net_weight'],
            'gross_weight' => $results['gross_weight']
 
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
