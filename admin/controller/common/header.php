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

        $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());

        if(!isset($this->request->get['user_token']) || !isset($this->session->data['user_token']) || ($this->request->get['user_token'] != $this->session->data['user_token'])) {
            $data['logged'] = '';

            $data['home'] = $this->url->link('home/dashboard', '', true);
        } else {
            $data['logged'] = true;

            $data['home'] = $this->url->link('home/dashboard', 'user_token=' . $this->session->data['user_token'], true);
            $data['logout'] = $this->url->link('user/logout', 'user_token=' . $this->session->data['user_token'], true);
            $data['profile'] = $this->url->link('user/profile', 'user_token=' . $this->session->data['user_token'], true);

            $this->load->model('user/user');

            $this->load->model('tool/image');

            $user_info = $this->model_user_user->getUser($this->user->getId());

            if($user_info) {
                $data['name'] = $user_info['name'];
                $data['email'] = $user_info['email'];
                $data['login_id'] = $user_info['login_id'];
                $data['user_group'] = $user_info['user_group'];
                $data['joined'] = date('M. Y', strtotime($user_info['date_added']));

                if(is_file(DIR_IMAGE . $user_info['image'])) {
                    $data['image'] = $this->model_tool_image->resize($user_info['image'], 25, 25);
                    $data['thumb'] = $this->model_tool_image->resize($user_info['image'], 90, 90);
                } else {
                    $data['image'] = $this->model_tool_image->resize('profile.png', 25, 25);
                    $data['thumb'] = $this->model_tool_image->resize('profile.png', 90, 90);
                }
            } else {
                $data['name'] = '';
                $data['email'] = '';
                $data['login_id'] = '';
                $data['user_group'] = '';
                $data['joined'] = '';
                $data['image'] = '';
            }
        }

        return $this->load->view('common/header', $data);
    }
}
