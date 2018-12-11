<?php

class ControllerCommonHeader extends Controller
{
    public function index() {
        $data['title'] = $this->document->getTitle();

        if($this->request->server['HTTPS']) {
            $data['base'] = HTTPS_SERVER;
        } else {
            $data['base'] = HTTP_SERVER;
        }

        $data['description'] = $this->document->getDescription();
        $data['keywords'] = $this->document->getKeywords();
        $data['links'] = $this->document->getLinks();
        $data['styles'] = $this->document->getStyles();
        $data['scripts'] = $this->document->getScripts('header');
        $data['lang'] = $this->language->get('code');
        $data['dir'] = $this->language->get('direction');

        $this->load->language('common/header');

        $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->member->getFirstName());

        if(!isset($this->request->get['member_token']) || !isset($this->session->data['member_token']) || ($this->request->get['member_token'] != $this->session->data['member_token'])) {
            $data['logged'] = '';

            $data['home'] = $this->url->link('home/dashboard', '', true);
        } else {
            $data['logged'] = true;

            $data['home'] = $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true);
            $data['logout'] = $this->url->link('user/logout', 'member_token=' . $this->session->data['member_token'], true);
            $data['profile'] = $this->url->link('user/profile', 'member_token=' . $this->session->data['member_token'], true);

            $this->load->model('user/user');

            $this->load->model('tool/image');

            $member_info = $this->model_user_user->getUser($this->member->getId());

            if($member_info) {
                $data['firstname'] = $member_info['firstname'];
                $data['lastname'] = $member_info['lastname'];
                $data['email'] = $member_info['email'];
                $data['member_group'] = $member_info['member_group'];

//                if(is_file(DIR_IMAGE . $member_info['image'])) {
//                    $data['image'] = $this->model_tool_image->resize($member_info['image'], 40, 40);
//                } else {
//                    $data['image'] = $this->model_tool_image->resize('profile.png', 40, 40);
//                }
            } else {
                $data['firstname'] = '';
                $data['lastname'] = '';
                $data['email'] = '';
                $data['member_group'] = '';
                $data['image'] = '';
            }
        }

        return $this->load->view('common/header', $data);
    }
}
