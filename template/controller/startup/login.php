<?php

class ControllerStartupLogin extends Controller
{
    public function index() {
        $route = isset($this->request->get['url']) ? $this->request->get['url'] : '';

        $ignore = array(
            'user/login',
            'user/forgotten',
            'user/reset',
            'common/track'
        );

        # Member
        $this->registry->set('member', new Account\Member($this->registry));

        if(!$this->member->isLogged() && !in_array($route, $ignore)) {
            return new Action('user/login');
        }

        if(isset($this->request->get['url'])) {
            $ignore = array(
                'user/login',
                'user/logout',
                'user/forgotten',
                'user/reset',
                'error/not_found',
                'error/permission',
                'common/track'
            );

            if(!in_array($route, $ignore) && (!isset($this->request->get['member_token']) || !isset($this->session->data['member_token']) || ($this->request->get['member_token'] != $this->session->data['member_token']))) {
                return new Action('user/login');
            }
        } else {
            if(!isset($this->request->get['member_token']) || !isset($this->session->data['member_token']) || ($this->request->get['member_token'] != $this->session->data['member_token'])) {
                return new Action('user/login');
            }
        }
    }
}
