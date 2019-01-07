<?php

class ControllerReportDirectorReport extends Controller {

    public function index() {
        $this->load->language('report/director_report');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getReports();
    }

    public function getReports() {
        $this->load->language('report/director_report');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        $inwards = $this->model_sale_inward->getInwardReport();

        $data = [];
        $j = 0;
        $html = '';
        for ($r = 0; $r < count($inwards); $r++) {
            $customers = $inwards[$r]['customer_name'];
            $totalinward = $inwards[$r]['totalInward'];
            $data[$j]['label'] = $customers;
            $data[$j]['value'] = $totalinward;
            $html .= $data[$j]['label'] . ' : ' . $data[$j]['value'];
            $j++;
        }

        $data1 = json_encode($data);

        $data['report'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $data1);

        $this->load->model('customer/customer');

        $data['inwards'] = $this->model_sale_inward->getInwards();

        $this->load->model('sale/outward');

        $data['total_outwards'] = $this->model_sale_outward->getTotalOutwards();

        $outwards = $this->model_sale_outward->getOutwardReport();

        $outward_data = [];
        $s = 0;
        $html1 = '';
        for ($p = 0; $p < count($outwards); $p++) {
            $customers = $outwards[$p]['customer_name'];
            $totaloutward = $outwards[$p]['total_gross_weight'];
            $outward_data[$s]['label'] = $customers;
            $outward_data[$s]['value'] = $totaloutward;
            $html1 .= $outward_data[$s]['label'] . ' : ' . $outward_data[$s]['value'];
            $s++;
        }

        $outwardData = json_encode($outward_data);

        $data['outwardreport'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $outwardData);

        $thickness = $this->model_sale_inward->getInwards();

        $total_th = 0;
        $thU = 0;
        $j = 0;
        $ThReport = [];
        for ($r = 0; $r < count($thickness); $r++) {
            $total_th += $thickness[$r]['thickness'];
            if ($thickness[$r]['thickness'] > 1.5 && $thickness[$r]['thickness'] < 5) {
                $thU += $thickness[$r]['thickness'];
            }
            $avgthU = (($thU * 100) / $total_th );
            $avgthL = 100 - $avgthU;
            $ThReport[$j]['label'] = 'Above 1.5';
            $ThReport[$j]['value'] = round($avgthU, 2);
            $ThReport[$j + 1]['label'] = '0.3-1.5';
            $ThReport[$j + 1]['value'] = round($avgthL, 2);
        }

        $Thdata = json_encode($ThReport);
        $data['thickness'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $Thdata);

        $grade = $this->model_sale_inward->getGrade();
//        print_r($grade);exit;
        $GradeReport = [];
        for ($d = 0; $d < count($grade); $d++) {
            $style = '';
            $Grade = round($grade[$d]['gd'], 2);
            $Gd = $grade[$d]['product_code'];
            if ($Gd == 'ALU') {
                $style = 'text-blue';
            }
            if ($Gd == 'GLU') {
                $style = 'text-green';
            }
            if ($Gd == 'GP') {
                $style = 'text-opera';
            }
            if ($Gd == 'GPSP') {
                $style = 'text-grey';
            }
            if ($Gd == 'HRPO') {
                $style = 'text-light-green';
            }
            if ($Gd == 'SS') {
                $style = 'text-dark-red';
            }
            if ($Gd == 'CR') {
                $style = 'text-yellow';
            }
            if ($Gd == 'HR') {
                $style = 'text-red';
            }
            
            $GradeReport[$d]['label'] = $Gd;
            $GradeReport[$d]['value'] = $Grade;
        }

        $gradeData = json_encode($GradeReport);

        $data['grade'] = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $gradeData);
//        print_r($data['thickness']);exit;
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/director_report', $data));
    }

}
