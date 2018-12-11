<?php

class ControllerReportStatistics extends Controller
{
    public function index() {
        $this->load->language('report/statistics');

        $this->load->model('report/statistics');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function customers() {
        $this->load->language('report/statistics');

        $this->load->model('report/statistics');

        $this->document->setTitle($this->language->get('heading_title'));

        if($this->validate()) {
            $this->load->model('customer/customer');

            $this->model_report_statistics->editValue('customers', $this->model_customer_customer->getTotalCustomers());

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('report/statistics', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    public function mail() {
        $this->load->language('report/statistics');

        $this->load->model('report/statistics');

        $this->document->setTitle($this->language->get('heading_title'));

        if($this->validate()) {
            $this->load->model('customer/customer');

            $this->model_report_statistics->editValue('mail', $this->model_customer_customer->getTotalMails());

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('report/statistics', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    public function files() {
        $this->load->language('report/statistics');

        $this->load->model('report/statistics');

        $this->document->setTitle($this->language->get('heading_title'));

        if($this->validate()) {
            $this->load->model('customer/customer');

            $this->model_report_statistics->editValue('files', $this->model_customer_customer->getTotalFiles());

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('report/statistics', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    public function communication() {
        $this->load->language('report/statistics');

        $this->load->model('report/statistics');

        $this->document->setTitle($this->language->get('heading_title'));

        if($this->validate()) {
            $this->load->model('customer/customer');

            $this->model_report_statistics->editValue('communication', $this->model_customer_customer->getTotalHistories());

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('report/statistics', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('report/statistics', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['statistics'] = array();

        $this->load->model('report/statistics');

        $results = $this->model_report_statistics->getStatistics();

        foreach($results as $result) {
            $data['statistics'][] = array(
                'name'  => $this->language->get('text_' . $result['code']),
                'value' => $result['value'],
                'href'  => $this->url->link('report/statistics/' . str_replace('_', '', $result['code']), 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('report/statistics', $data));
    }

    protected function validate() {
        if(!$this->member->hasPermission('modify', 'report/statistics')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}
