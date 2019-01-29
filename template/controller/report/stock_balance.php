<?php

error_reporting(0);

class ControllerReportStockBalance extends Controller {

    public function index() {
        $this->load->language('report/stock_balance');

        $this->document->setTitle($this->language->get('heading_title'));

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
            'href' => $this->url->link('report/stock_balance', 'member_token=' . $this->session->data['member_token'], true)
        );


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
        $data['view'] = $this->url->link('report/stock_report', 'member_token=' . $this->session->data['member_token'], true);
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/stock_balance', $data));
    }
    
    public function getData() {
        $json = array();

        $this->load->model('report/stock_balance');
        
        $date1 = date('Y-m-01');

        $date2 = date('Y-m-t');
        
        $results = $this->model_report_stock_balance->getStockReport($date1,$date2);
       
        $table = array();

        foreach ($results as $result) {
            $nestedData['customer_id'] = $result['customer_id'];
            $nestedData['opening_gross_weight'] = $result['opening_gross_weight']/1000;
            $nestedData['closing_gross_weight'] = $result['closing_gross_weight'];
            $nestedData['customer_name'] = $result['customer_name'];
            $nestedData['inwardTotal'] = $result['inwardTotal']/1000;
            $nestedData['outwardTotal'] = $result['outwardTotal']/1000;
            $nestedData['closing'] = $result['closing']/1000;

            $table[] = $nestedData;
        }

        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }


}
