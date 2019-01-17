<?php

class ControllerLocalisationZone extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('localisation/zone');

        $this->load->model('localisation/zone');

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
            'href'  => $this->url->link('localisation/zone', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('localisation/zone/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('localisation/zone/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('localisation/zone/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('localisation/zone_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('localisation/zone');

        $totalData = $this->model_localisation_zone->getTotalZones();

        $totalFiltered = $totalData;

        $results = $this->model_localisation_zone->getZones();

        $table = array();

        foreach($results as $result) {
            $nestedData['zone_id']  = $result['zone_id'];
            $nestedData['name']     = $result['name'];
            $nestedData['country']  = $result['country'];
            $nestedData['code']     = $result['code'];

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
