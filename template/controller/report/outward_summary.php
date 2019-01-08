<?php

error_reporting(0);

class ControllerReportOutwardSummary extends Controller {

    public function index() {
        $this->load->language('report/outward_summary');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getOutwardSummary();
    }

    public function getOutwardSummary() {
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

        $this->load->language('report/outward_summary');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/outward');

        $services = array();

        $x = 0;

        $ctc = '';

        $ctl = '';

        $sheet = '';

        $results = $this->model_sale_outward->getOutwardSummary();

        usort($results, function($a, $b) {
            return strcmp($a['customer_id'], $b['customer_id']);
        });

        for ($i = 0; $i < count($results); $i++) {
            if ($services[$x]['customer_id'] == $results[$i]['customer_id']) {
                if ($results[$i]['service_type'] == 'CTC') {
                    $services[$x]['gw_ctc'] += round($results[$i]['gross_weight'] / 1000, 2);
                }

                if ($results[$i]['service_type'] == 'CTL') {
                    $services[$x]['gw_ctl'] += round($results[$i]['gross_weight'] / 1000, 2);
                }

                if ($results[$i]['service_type'] == 'SHEET') {
                    $services[$x]['gw_sheet'] += round($results[$i]['gross_weight'] / 1000, 2);
                }
            } else {
                if (!empty($services)) {
                    $x++;
                }

                $services[$x]['customer_id'] = $results[$i]['customer_id'];

                $services[$x]['name'] = $results[$i]['customer_name'];

                if ($results[$i]['service_type'] == 'CTC') {
                    $services[$x]['gw_ctc'] = round($results[$i]['gross_weight'] / 1000, 2);
                } else {
                    $services[$x]['gw_ctc'] = 0;
                }

                if ($results[$i]['service_type'] == 'CTL') {
                    $services[$x]['gw_ctl'] = round($results[$i]['gross_weight'] / 1000, 2);
                } else {
                    $services[$x]['gw_ctl'] = 0;
                }

                if ($results[$i]['service_type'] == 'SHEET') {
                    $services[$x]['gw_sheet'] = round($results[$i]['gross_weight'] / 1000, 2);
                } else {
                    $services[$x]['gw_sheet'] = 0;
                }
            }
        }

        foreach ($services as $service) {
            $ctc .= "{ label:'" . $service['name'] . "',a:'" . $service['gw_ctc'] . "'},";
            $ctl .= "{ label:'" . $service['name'] . "',b:'" . $service['gw_ctl'] . "'},";
            $sheet .= "{label:'" . $service['name'] . "',c:'" . $service['gw_sheet'] . "'},";
        }

        $data['ctc'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $ctc);

        $data['ctl'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $ctl);

        $data['sheet'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $sheet);

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/outward_summary', $data));
    }

}
