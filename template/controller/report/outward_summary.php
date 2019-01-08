<?php
error_reporting(0);
class ControllerReportOutwardSummary extends Controller {

    public function index() {
        $this->load->language('report/outward_summary');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getOutwradSummary();
    }

    public function getOutwradSummary() {
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

        $outwardSummary = $this->model_sale_outward->getOutwardSummary();
//        print_r($outwardSummary);exit;
        $newArr = [];
        $x = 0;
        $bar_chart_ctc = '';
        $bar_chart_ctl = '';
        $bar_chart_sheet = '';
//        usort($outwardSummary, function($a, $b) {
//            return $a['customer_id'] <=> $b['customer_id'];
//        });
        for ($p = 0; $p < count($outwardSummary); $p++) {
            $customers = $outwardSummary[$p]['customer_name'];
            if ($newArr[$x]['customer_id'] == $outwardSummary[$p]['customer_id']) {
                if ($outwardSummary[$p]['service_type'] == 'CTC') {
                    $newArr[$x]['gw_ctc'] += $outwardSummary[$p]['gross_weight'];
                }
                if ($outwardSummary[$p]['service_type'] == 'CTL') {
                    $newArr[$x]['gw_ctl'] += $outwardSummary[$p]['gross_weight'];
                }
                if ($outwardSummary[$p]['service_type'] == 'SHEET') {
                    $newArr[$x]['gw_sheet'] += $outwardSummary[$p]['gross_weight'];
                }
            } else {

                if (!empty($newArr)) {
                    $x++;
                }

                $newArr[$x]['customer_id'] = $outwardSummary[$p]['customer_id'];
                if ($outwardSummary[$p]['service_type'] == 'CTC') {
                    $newArr[$x]['gw_ctc'] = $outwardSummary[$p]['gross_weight'];
                }
                if ($outwardSummary[$p]['service_type'] == 'CTL') {
                    $newArr[$x]['gw_ctl'] = $outwardSummary[$p]['gross_weight'];
                }
                if ($outwardSummary[$p]['service_type'] == 'SHEET') {
                    $newArr[$x]['gw_sheet'] = $outwardSummary[$p]['gross_weight'];
                }
                $newArr[$x]['service_type'] = $outwardSummary[$p]['service_type'];
            }
        }


        for ($p = 0; $p < count($newArr); $p++) {

            if ($newArr[$p]['gw_ctc'] == '') {
                $newArr[$p]['gw_ctc'] = '';
            } else {
                $newArr[$p]['gw_ctc'] = $newArr[$p]['gw_ctc'] / 1000;
            }
            if ($newArr[$p]['gw_ctl'] == '') {
                $newArr[$p]['gw_ctl'] = '';
            } else {
                $newArr[$p]['gw_ctl'] = $newArr[$p]['gw_ctl'] / 1000;
            }
            if ($newArr[$p]['gw_sheet'] == '') {
                $newArr[$p]['gw_sheet'] = '';
            } else {
                $newArr[$p]['gw_sheet'] = $newArr[$p]['gw_sheet'] / 1000;
            }
            $bar_chart_ctc .= "{ label:'" . $customers . "',a:'" . $newArr[$p]['gw_ctc'] . "'},";
            $bar_chart_ctl .= "{ label:'" . $customers . "',b:'" . $newArr[$x]['gw_ctl'] . "'},";
            $bar_chart_sheet .= "{label:'" . $customers . "',c:'" . $newArr[$x]['gw_sheet'] . "'},";
        }
        $data['ctc'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $bar_chart_ctc);

        $data['ctl'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $bar_chart_ctl);
        
        $data['sheet'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $bar_chart_sheet);


        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/outward_summary', $data));
    }

}
