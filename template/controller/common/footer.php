<?php

class ControllerCommonFooter extends Controller
{
    public function index() {
        $this->load->language('common/footer');

        $data['scripts'] = $this->document->getScripts('footer');

        if($this->member->isLogged() && isset($this->request->get['member_token']) && ($this->request->get['member_token'] == $this->session->data['member_token'])) {
            $data['logged'] = true;
            $data['version'] = sprintf($this->language->get('text_version'), VERSION);
        } else {
            $data['logged'] = '';
            $data['version'] = '';
        }

        return $this->load->view('common/footer', $data);
    }
}
