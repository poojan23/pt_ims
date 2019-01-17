<?php

class ControllerLocalisationCountry extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('localisation/country');

        $this->load->model('localisation/country');

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
            'href'  => $this->url->link('localisation/country', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('localisation/country/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('localisation/country/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('localisation/country/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('localisation/country_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('localisation/country');

        $totalData = $this->model_localisation_country->getTotalCountries();

        $totalFiltered = $totalData;

        $results = $this->model_localisation_country->getCountries();

        $table = array();

        foreach($results as $result) {
            $nestedData['country_id']   = $result['country_id'];
            $nestedData['name']         = $result['name'];
            $nestedData['iso_code_2']   = $result['iso_code_2'];
            $nestedData['iso_code_3']   = $result['iso_code_3'];

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

    public function country() {
        $json = array();

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

        if($country_info) {
            $this->load->model('localisation/zone');

            $json = array(
                'country_id'        => $country_info['country_id'],
                'name'              => $country_info['name'],
                'iso_code_2'        => $country_info['iso_code_2'],
                'iso_code_3'        => $country_info['iso_code_3'],
                'address_format'    => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                'status'            => $country_info['status']
            );
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
