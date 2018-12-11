<?php

class ControllerHomeDashboard extends Controller
{
    public function index() {
        $this->load->language('home/dashboard');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('home/dashboard', $data));
    }
}
