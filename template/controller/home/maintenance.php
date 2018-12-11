<?php

class ControllerHomeMaintenance extends Controller
{
    public function index() {
        $this->load->language('home/maintenance');

        if($this->request->server['HTTPS']) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        $this->document->setTitle($this->language->get('heading_title'));
        $this->document->addScript('template/view/dist/js/jquery.downCount.js');

        if($this->request->server['SERVER_PROTOCOL'] == 'HTTP/1.1') {
            $this->response->addHeader('HTTP/1.1 503 Service Unavailable');
        } else {
            $this->response->addHeader('HTTP/1.0 503 Service Unavailable');
        }

        $this->response->addHeader('Retry-After: 3600');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_maintenance'),
            'href'  => $this->language->get('home/maintenance')
        );

        if(is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
            $data['logo'] = $server . 'image/' . $this->config->get('config_logo');
        } else {
            $data['logo'] = '';
        }

        $data['message'] = $this->language->get('text_message');

        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('home/maintenance', $data));
    }
}
