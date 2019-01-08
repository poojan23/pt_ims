<?php

class ControllerReportInwardSummary extends Controller {

    public function index() {
        $this->load->language('report/inward_summary');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getSummary();
    }

    public function getSummary() {
         $data['member_token'] = $this->session->data['member_token'];

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
            'href' => $this->url->link('report/outward_summary', 'member_token=' . $this->session->data['member_token'], true)
        );
        
        $this->load->language('report/inward_summary');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        $inwardSummary = $this->model_sale_inward->getInwardSummary();

        $data = [];
        $InwardGraph = '';
        $OutwardGraph = '';
        $html = '';
        for ($r = 0; $r < count($inwardSummary); $r++) {
            $customers = $inwardSummary[$r]['customer_name'];
            if ($inwardSummary[$r]['totalInward']) {
                $totalInward = $inwardSummary[$r]['totalInward'];
            } else {
                $totalInward = 0;
            }


            $customer_id = $inwardSummary[$r]['customer_id'];

            $this->load->model('sale/outward');

            $outwardSummary = $this->model_sale_outward->getGrossWeight($customer_id, $this->request->post);

            for ($o = 0; $o < count($outwardSummary); $o++) {
                if ($outwardSummary[$o]['totalOutward']) {
                    $totalOutward = $outwardSummary[$o]['totalOutward'];
                } else {
                    $totalOutward = 0;
                }

                $customer_id = $outwardSummary[$o]['customer_id'];
            }

            $InwardGraph .= "{label:'$customers',value:$totalInward},";

            $OutwardGraph .= "{label:'$customers', value:$totalOutward},";
        }

        $data['inwardSummary'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $InwardGraph);

        $data['outwradSummary'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $OutwardGraph);

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/inward_summary', $data));
    }

}
