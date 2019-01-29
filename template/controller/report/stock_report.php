<?php

class ControllerReportStockReport extends Controller {

    public function index() {
        $this->load->language('report/stock_report');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getReport();
    }

    protected function getReport() {
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

        $data['text_confirm'] = $this->language->get('text_confirm');

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['customer_id'] = $this->request->get['customer_id'];

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/stock_report', $data));
    }

    public function getData() {
        $json = array();

        $date1 = date('Y-m-01');

        $date2 = date('Y-m-t');

        $this->load->model('report/stock_report');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        $results = $this->model_report_stock_report->getCustomerWiseCoilNo($customer_id, $date1, $date2);

        $table = array();

        foreach ($results as $result) {
            if ($result['coil_no']) {
                $coil_no = $result['coil_no'];
            } else {
                $coil_no = 0;
            }

            $results = $this->model_report_stock_report->getCustomerWiseReport($coil_no, $date1, $date2);

            foreach ($results as $result) {
                $nestedData['coil_no'] = $coil_no;
                $nestedData['inwardTotal'] = $result['inwardTotal']/1000;
                $nestedData['outwardTotal'] = $result['outwardTotal']/1000;

                $table[] = $nestedData;
            }
        }

        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function getStockBalance() {
        $json = array();

        $date1 = date('Y-m-01');

        $date2 = date('Y-m-t');

        $this->load->model('report/stock_report');

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        $results = $this->model_report_stock_report->getStockBalance($customer_id, $date1, $date2);
      
        $table = array();


            foreach ($results as $result) {
                $nestedData['crtDate'] = $result['crtDate'];
                $nestedData['coil_no'] = $result['coil_no'];
                $nestedData['description'] = "Thickness=".$result['inTh'].",Width=".$result['inWd'].",Length=".$result['inL'].",Pieces=".$result['inP'];
                
                if($result['Debit_Credit'] == 'Credit') {
                    $nestedData['product_type'] = $result['product_type'];
                    $nestedData['purchase_no'] = $result['unique_id'];
                    $nestedData['delivery_no'] = "-";
                    $nestedData['service_type'] = "-";
                    $nestedData['in_gross_weight'] = ($result['gross_weight']/1000)."Cr.";
                    $nestedData['out_gross_weight'] = "-";
                }else {
                    $nestedData['product_type'] = "-";
                    $nestedData['purchase_no'] = "-";
                    $nestedData['delivery_no'] = $result['unique_id'];
                    $nestedData['service_type'] = $result['product_type_id'];
                    $nestedData['in_gross_weight'] = "-";
                    $nestedData['out_gross_weight'] = ($result['gross_weight']/1000)."Dr.";
                }
                $nestedData['product_type_id'] = $result['product_type_id'];
                $nestedData['product_id'] = $result['product_id'];
                $nestedData['Debit_Credit'] = $result['Debit_Credit'];

                $table[] = $nestedData;
            }
       

        $json = array(
            'data' => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

}
