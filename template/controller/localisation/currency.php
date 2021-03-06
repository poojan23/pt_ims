<?php

class ControllerLocalisationCurrency extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('localisation/currency');

        $this->load->model('localisation/currency');

        $this->document->setTitle($this->language->get('heading_title'));

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
            'href'  => $this->url->link('localisation/currency', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('localisation/currency/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('localisation/currency/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('localisation/currency/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('localisation/currency_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('localisation/currency');

        $totalData = $this->model_localisation_currency->getTotalCurrencies();

        $totalFiltered = $totalData;

        $results = $this->model_localisation_currency->getCurrencies();

        $table = array();

        foreach($results as $result) {
            $nestedData['currency_id']  = $result['currency_id'];
            $nestedData['title']     = $result['title'];
            $nestedData['code']  = $result['code'];
            $nestedData['symbol']     = $result['symbol'];

            $table[] = $nestedData;
        }

        $json = array(
            'resultsTotal'      => intval($totalData),
            'resultFiltered'    => intval($totalFiltered),
            'data'              => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
