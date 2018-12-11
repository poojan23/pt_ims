<?php

class ControllerUserLogout extends Controller
{
    public function index() {
        $this->member->logout();

        unset($this->session->data['member_token']);

        $this->response->redirect($this->url->link('user/login', '', true));
    }
}
