<?php

error_reporting(0);

class ControllerReportMonthlyReport extends Controller {

    public function index() {
        $this->load->language('report/monthly_report');

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
            'href' => $this->url->link('report/monthly_report', 'member_token=' . $this->session->data['member_token'], true)
        );

        $this->load->language('report/monthly_report');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        $inwardList = $this->model_sale_inward->getWeeklyInward();

        if ($inwardList) {
            $this->load->model('sale/outward');

            $inwardList2 = $this->model_sale_outward->getWeeklyOutward();


            if (count($inwardList) > count($inwardList2)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardList); $i++) {
                    for ($k = 0; $k < count($inwardList2); $k++) {
                        $flag = 0;
                        if ($inwardList2[$k]['delivery_date'] == $inwardList[$i]['inward_date']) {
                            $flag = 1;
                            break;
                        } else {
                            $array3[$j]['commonDate'] = $inwardList[$i]['inward_date'];
                            $array3[$j]['inwardTotal'] = $inwardList[$i]['totalInward'];
                            $array3[$j]['outwardTotal'] = 0;


                            //$flag=0;
                        }
                    }
                    if ($flag == 1) {
                        $array3[$j]['commonDate'] = $inwardList[$i]['inward_date'];
                        $array3[$j]['inwardTotal'] = $inwardList[$i]['totalInward'];
                        if (count($inwardList2) <= 1) {
                            $array3[$j]['outwardTotal'] = $inwardList2[$i]['totalOutward'];
                        } else {
                            $array3[$j]['outwardTotal'] = $inwardList2[$k]['totalOutward'];
                        }
                    }

                    $j++;
                }

                $s = count($array3);
                $x = count($array3);
                $s++;
                $z = $x - count($inwardList2);
                for ($p = 0; $p < $x; $p++) {
                    for ($v = 0; $v < count($inwardList2); $v++) {
                        if ($array3[$p]['commonDate'] == $inwardList2[$v]['delivery_date']) {
                            
                        } else {
                            if ($p < $z) {
                                $array3[$s]['commonDate'] = $inwardList2[$v]['delivery_date'];
                                $array3[$s]['outwardTotal'] = $inwardList2[$v]['totalOutward'];
                                $array3[$s]['inwardTotal'] = 0;
                            }
                        }
                    }

                    $s++;
                }
            }

            if (count($inwardList) == count($inwardList2)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardList); $i++) {
                    for ($k = 0; $k < count($inwardList2); $k++) {
                        $flag = 0;
                        if ($inwardList2[$k]['delivery_date'] == $inwardList[$i]['inward_date']) {
                            $flag = 1;
                            break;
                        } else {
                            $array3[$j]['commonDate'] = $inwardList[$i]['inward_date'];
                            $array3[$j]['inwardTotal'] = $inwardList[$i]['totalInward'];
                            $array3[$j]['outwardTotal'] = 0;


                            //$flag=0;
                        }
                    }
                    if ($flag == 1) {
                        $array3[$j]['commonDate'] = $inwardList[$i]['inward_date'];
                        $array3[$j]['inwardTotal'] = $inwardList[$i]['totalInward'];

                        $array3[$j]['outwardTotal'] = $inwardList2[$i]['totalOutward'];
                    }

                    $j++;
                }
                $s = count($array3);
                $x = count($array3);
                $s++;
                $z = $x - count($inwardList2);
                for ($p = 0; $p < $x; $p++) {
                    for ($v = 0; $v < count($inwardList2); $v++) {
                        if ($array3[$p]['commonDate'] == $inwardList2[$v]['delivery_date']) {
                            
                        } else {
                            if ($p >= $z) {
                                $array3[$s]['commonDate'] = $inwardList2[$p]['delivery_date'];
                                $array3[$s]['outwardTotal'] = $inwardList2[$p]['totalOutward'];
                                $array3[$s]['inwardTotal'] = 0;
                            }
                        }
                    }

                    $s++;
                }
            }

            if (count($inwardList) < count($inwardList2)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardList2); $i++) {
                    for ($k = 0; $k < count($inwardList); $k++) {
                        $flag = 0;
                        if ($inwardList[$k]['inward_date'] == $inwardList2[$i]['delivery_date']) {
                            $flag = 1;
                            break;
                        } else {
                            $array3[$j]['commonDate'] = $inwardList2[$i]['ct'];
                            $array3[$j]['inwardTotal'] = 0;
                            $array3[$j]['outwardTotal'] = $inwardList2[$i]['totalOutward'];


                            //$flag=0;
                        }
                    }
                    if ($flag == 1) {
//                   $array3[$j]['inwardTotal']=$inwardList[$i]['totalInward'];
                        $array3[$j]['commonDate'] = $inwardList[$k]['inward_date'];
                        $array3[$j]['outwardTotal'] = $inwardList2[$i]['totalOutward'];
                        if (count($inwardList) <= 1) {


                            $array3[$j]['inwardTotal'] = $inwardList2[$i]['totalInward'];
                        } else {

                            $array3[$j]['inwardTotal'] = $inwardList[$k]['totalInward'];
                        }
                    }

                    $j++;
                }
                $s = count($array3);
                $x = count($array3);
                $s++;
                $z = $x - count($inwardList2);
                for ($p = 0; $p < $x; $p++) {
                    for ($v = 0; $v < count($inwardList); $v++) {
                        if ($array3[$p]['commonDate'] == $inwardList[$v]['inward_date']) {
                            
                        } else {
                            if ($p >= $z) {
                                $array3[$s]['commonDate'] = $inwardList[$v]['inward_date'];
                                $array3[$s]['inwardTotal'] = $inwardList[$v]['totalInward'];
                                $array3[$s]['outwardTotal'] = 0;
                            }
                        }
                    }

                    $s++;
                }
            }

            function super_unique($array, $key) {
                $temp_array = [];
                foreach ($array as &$v) {
                    if (!isset($temp_array[$v[$key]]))
                        $temp_array[$v[$key]] = & $v;
                }
                $array = array_values($temp_array);
                return $array;
            }

            $array3 = super_unique($array3, 'commonDate');

//        return $array3;
            $weekly_report = '';
            for ($f = 0; $f < count($array3); $f++) {
                $flag = 0;

                if ($array3[$f]['commonDate'] != '') {
                    $inwardTotal = $array3[$f]['inwardTotal'];
                    $inwardTotal = $inwardTotal / 1000;
                    $outwardTotal = $array3[$f]['outwardTotal'];
                    $outwardTotal = $outwardTotal / 1000;
                    $commonDate = $array3[$f]['commonDate'];
                    $flag = 1;
                } else {
                    $flag = 0;
                }


                if ($flag) {
                    $weekly_report .= "{inwardTotal:'$inwardTotal',outwardTotal:'$outwardTotal', commonDate:'$commonDate'},";
                }
            }
            $data['weekly_report'] = substr($weekly_report, 0, -1);
        }

        $inwardListMonthly = $this->model_sale_inward->getMonthlyInward();

        if ($inwardListMonthly) {
            $this->load->model('sale/outward');

            $outwardListMonthly = $this->model_sale_outward->getMonthlyOutward();

            if (count($inwardListMonthly) > count($outwardListMonthly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardListMonthly); $i++) {
                    $array3[$j]['inward_Total'] = $inwardListMonthly[$i]['totalInward'];
                    if ($outwardListMonthly[$i]['totalOutward'] == "" || empty($outwardListMonthly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $outwardListMonthly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $inwardListMonthly[$i]['crt'];
                    $j++;
                }
            }
            if (count($inwardListMonthly) == count($outwardListMonthly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardListMonthly); $i++) {
                    $array3[$j]['inward_Total'] = $inwardListMonthly[$i]['totalInward'];
                    if ($outwardListMonthly[$i]['totalOutward'] == "" || empty($outwardListMonthly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $outwardListMonthly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $inwardListMonthly[$i]['crt'];
                    $j++;
                }
            }

            if (count($inwardListMonthly) < count($outwardListMonthly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($outwardListMonthly); $i++) {
                    $array3[$j]['inward_Total'] = $outwardListMonthly[$i]['totalInward'];
                    if ($inwardListMonthly[$i]['totalOutward'] == "" || empty($inwardListMonthly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $inwardListMonthly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $outwardListMonthly[$i]['crt'];
                    $j++;
                }
            }

            $monthly_summary = '';

            for ($b = 0; $b < count($array3); $b++) {
                $inward_Total = $array3[$b]['inward_Total'];
                $inward_Total = $inward_Total / 1000;
                $outward_Total = $array3[$b]['outward_Total'];
                $outward_Total = $outward_Total / 1000;
                $common_Date = $array3[$b]['common_Date'];

                $monthly_summary .= "{inward_Total:'$inward_Total',outward_Total:'$outward_Total', common_Date:'$common_Date'},";
            }
            $data['monthly_report'] = substr($monthly_summary, 0, -1);
        }


        $dateArray = [];
        $data['quarter_summary'] = array();
        $x = 0;
        $s = 0;
        for ($r = 1; $r < 5; $r++) {
            $s++;
            if ($r == 1) {
                //$current_month
                $dateArray[$x]['date_1'] = date('Y-m-01');
                $dateArray[$x]['date_2'] = date('Y-m-t', strtotime($dateArray[$x]['date_1']));
                $x++;
                $s--;
            } else {
                $dateArray[$x]['date_1'] = date('Y-m-01', strtotime($dateArray[0]['date_1'] . '-' . $s . 'months'));
                $dateArray[$x]['date_2'] = date('Y-m-t', strtotime($dateArray[$x]['date_1']));
                $x++;
            }
        }

        foreach ($dateArray as $date) {
            $inwardListQuarterly = $this->model_sale_inward->getQuarterlyInward($date['date_1'], $date['date_2']);

            if ($inwardListQuarterly) {
                $this->load->model('sale/outward');

                $outwardListQuarterly = $this->model_sale_outward->getQuarterlyOutward($date['date_1'], $date['date_2']);

                if (count($inwardListQuarterly) > count($outwardListQuarterly)) {
                    for ($i = 0; $i < count($inwardListQuarterly); $i++) {
                        $data['quarter_summary'][] = array(
                            'inward_total' => $inwardListQuarterly[$i]['totalInward'],
                            'outward_total' => (!empty($outwardListQuarterly[$i]['totalOutward'])) ? $outwardListQuarterly[$i]['totalOutward'] : 0,
                            'common_date' => $inwardListQuarterly[$i]['crt']
                        );
                    }
                }

                if (count($inwardListQuarterly) == count($outwardListQuarterly)) {
                    for ($i = 0; $i < count($inwardListQuarterly); $i++) {
                        $data['quarter_summary'][] = array(
                            'inward_total' => $inwardListQuarterly[$i]['totalInward'],
                            'outward_total' => (!empty($outwardListQuarterly[$i]['totalOutward'])) ? $outwardListQuarterly[$i]['totalOutward'] : 0,
                            'common_date' => $inwardListQuarterly[$i]['crt']
                        );
                    }
                }

                if (count($inwardListQuarterly) < count($outwardListQuarterly)) {
                    for ($i = 0; $i < count($outwardListQuarterly); $i++) {
                        $data['quarter_summary'][] = array(
                            'inward_total' => $inwardListQuarterly[$i]['totalInward'],
                            'outward_total' => (!empty($outwardListQuarterly[$i]['totalOutward'])) ? $outwardListQuarterly[$i]['totalOutward'] : 0,
                            'common_date' => $inwardListQuarterly[$i]['crt']
                        );
                    }
                }
            }
        }


        $data['quarterly_report'] = json_encode($data['quarter_summary']);

        $current_year = date('Y-01-01');

        $nxt_year = date('Y-12-31');

        $inwardListYearly = $this->model_sale_inward->getYearlyInward($current_year, $nxt_year);

        if ($inwardListYearly) {
            $this->load->model('sale/outward');

            $outwardListYearly = $this->model_sale_outward->getYearlyOutward($current_year, $nxt_year);

            if (count($inwardListYearly) > count($outwardListYearly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardListYearly); $i++) {
                    $array3[$j]['inward_Total'] = $inwardListYearly[$i]['totalInward'];
                    if ($outwardListYearly[$i]['totalOutward'] == "" || empty($outwardListYearly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $outwardListYearly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $inwardListYearly[$i]['crt'];
                    $j++;
                }
            }
            if (count($inwardListYearly) == count($outwardListYearly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($inwardListYearly); $i++) {
                    $array3[$j]['inward_Total'] = $inwardListYearly[$i]['totalInward'];
                    if ($outwardListYearly[$i]['totalOutward'] == "" || empty($outwardListYearly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $outwardListYearly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $inwardListYearly[$i]['crt'];
                    $j++;
                }
            }

            if (count($inwardListYearly) < count($outwardListYearly)) {
                $array3 = [];
                $j = 0;
                for ($i = 0; $i < count($outwardListYearly); $i++) {
                    $array3[$j]['inward_Total'] = $outwardListYearly[$i]['totalInward'];
                    if ($inwardListYearly[$i]['totalOutward'] == "" || empty($inwardListYearly)) {
                        $array3[$j]['outward_Total'] = 0;
                    } else {
                        $array3[$j]['outward_Total'] = $inwardListYearly[$i]['totalOutward'];
                    }
                    $array3[$j]['common_Date'] = $outwardListYearly[$i]['crt'];
                    $j++;
                }
            }

            $yearly_summary = '';

            for ($b = 0; $b < count($array3); $b++) {
                $inward_Total = $array3[$b]['inward_Total'];
                $inward_Total = $inward_Total / 1000;
                $outward_Total = $array3[$b]['outward_Total'];
                $outward_Total = $outward_Total / 1000;
                $common_Date = $array3[$b]['common_Date'];

                $yearly_summary .= "{inward_Total:'$inward_Total',outward_Total:'$outward_Total', common_Date:'$common_Date'},";
            }
            $data['yearly_report'] = substr($yearly_summary, 0, -1);
        }


        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('reports/monthly_report', $data));
    }

}
