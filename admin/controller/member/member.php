<?php

class ControllerMemberMember extends Controller
{
    public function index() {
        $this->load->language('member/member');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('member/member');
        
        $data['members'] = $this->model_member_member->getMembers();
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav']    = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');
 
        $this->response->setOutput($this->load->view('member/member', $data));
        
    }
}

