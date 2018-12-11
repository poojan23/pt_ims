<?php

class ControllerStartupPermission extends Controller
{
    public function index() {
        if(isset($this->request->get['url'])) {
            $route = '';

            $part = explode('/', $this->request->get['url']);

            if(isset($part[0])) {
                $route .= $part[0];
            }

            if(isset($part[1])) {
                $route .= '/' . $part[1];
            }

            $ignore = array(
                'home/dashboard',
                'user/login',
                'user/logout',
                'user/forgotten',
                'user/reset',
                'error/not_found',
                'error/permission'
            );

            if(!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
                return new Action('error/permission');
            }
        }
    }
}
