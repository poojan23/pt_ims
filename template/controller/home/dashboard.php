<?php

class ControllerHomeDashboard extends Controller {

    public function index() {
        $this->load->language('home/dashboard');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->getScripts("template/view/dist/js/jquery-ui.custom.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.ui.touch-punch.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.easypiechart.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.sparkline.index.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.pie.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.resize.min.js");

        $this->getReports();
    }

    public function getReports() {
        $this->load->language('home/dashboard');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('sale/inward');

        $inwards = $this->model_sale_inward->getInwardReport();

        $data = [];
        $j = 0;
        $html = '';
        for ($r = 0; $r < count($inwards); $r++) {
            $customers = $inwards[$r]['customer_name'];
            $totalinward = $inwards[$r]['net_weight'];
            $data[$j]['label'] = $customers;
            $data[$j]['value'] = $totalinward;
            $html .= $data[$j]['label'] . ' : ' . $data[$j]['value'];
            $j++;
        }

        $data1 = json_encode($data);
        
        $data['report'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $data1);
        
        $this->load->model('customer/customer');

        $data['total_customers'] = $this->model_customer_customer->getTotalCustomers();

        $data['total_inwards'] = $this->model_sale_inward->getTotalInwards();

        $data['inwards'] = $this->model_sale_inward->getInwards();

        $this->load->model('sale/outward');

        $data['total_outwards'] = $this->model_sale_outward->getTotalOutwards();
        
        $outwards = $this->model_sale_outward->getOutwardReport();

        $outward_data = [];
        $j = 0;
        $html = '';
        for ($r = 0; $r < count($outwards); $r++) {
            $customers = $outwards[$r]['customer_name'];
            $totaloutward = $outwards[$r]['total_gross_weight'];
            $outward_data[$j]['label'] = $customers;
            $outward_data[$j]['value'] = $totaloutward;
            $html .= $outward_data[$j]['label'] . ' : ' . $outward_data[$j]['value'];
            $j++;
        }
        
        $outwardData = json_encode($outward_data);
        
        $data['outwardreport'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $outwardData);
        
        
        $this->load->model('product/product');
        
        $data['total_products'] = $this->model_product_product->getTotalProducts();
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('home/dashboard', $data));
    }

}
