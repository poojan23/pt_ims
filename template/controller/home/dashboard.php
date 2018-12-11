<?php

class ControllerHomeDashboard extends Controller
{
    public function index() {
        $this->load->language('home/dashboard');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->getScripts("template/view/dist/js/jquery-ui.custom.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.ui.touch-punch.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.easypiechart.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.sparkline.index.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.pie.min.js");
        $this->document->getScripts("template/view/dist/js/jquery.flot.resize.min.js");

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('home/dashboard', $data));
    }
}