<?php

class ControllerCommonNav extends Controller
{
    public function index() {
        if(isset($this->request->get['user_token']) && isset($this->session->data['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
            $this->load->language('common/nav');

            # Create a 3 level menu array
            # Level 2 can not have children

            # Menu
            # Dashboard
            $data['menus'][] = array(
                'id'        => 'menu-dashboard',
                'icon'      => 'fa-dashboard',
                'name'      => $this->language->get('text_dashboard'),
                'href'      => $this->url->link('home/dashboard', 'user_token=' . $this->session->data['user_token'], true),
                'children'  => array()
            );

            # Members
            $member = array();

            if($this->user->hasPermission('access', 'member/member')) {
                $member[] = array(
                    'name'      => $this->language->get('text_member'),
                    'href'      => $this->url->link('member/member', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'member/member_group')) {
                $member[] = array(
                    'name'      => $this->language->get('text_member_group'),
                    'href'      => $this->url->link('member/member_group', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($member) {
                $data['menus'][] = array(
                    'id'        => 'menu-member',
                    'icon'      => 'fa-user',
                    'name'      => $this->language->get('text_member'),
                    'href'      => '',
                    'children'  => $member
                );
            }

            # Customers
            $customer = array();

            if($this->user->hasPermission('access', 'customer/customer')) {
                $customer[] = array(
                    'name'      => $this->language->get('text_customer'),
                    'href'      => $this->url->link('customer/customer', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'customer/customer_group')) {
                $customer[] = array(
                    'name'      => $this->language->get('text_customer_group'),
                    'href'      => $this->url->link('customer/customer_group', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($customer) {
                $data['menus'][] = array(
                    'id'        => 'menu-customer',
                    'icon'      => 'fa-user-secret',
                    'name'      => $this->language->get('text_customer'),
                    'href'      => '',
                    'children'  => $customer
                );
            }

            # Marketing
            $marketing = array();

            if($this->user->hasPermission('access', 'marketing/contact')) {
                $marketing[] = array(
                    'name'      => $this->language->get('text_mail'),
                    'href'      => $this->url->link('marketing/contact', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'marketing/template')) {
                $marketing[] = array(
                    'name'      => $this->language->get('text_template'),
                    'href'      => $this->url->link('marketing/template', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($marketing) {
                $data['menus'][] = array(
                    'id'        => 'menu-marketing',
                    'icon'      => 'fa-user-secret',
                    'name'      => $this->language->get('text_marketing'),
                    'href'      => '',
                    'children'  => $marketing
                );
            }

            # Settings
            # System
            $system = array();

            if($this->user->hasPermission('access', 'setting/setting')) {
                $system[] = array(
                    'name'      => $this->language->get('text_setting'),
                    'href'      => $this->url->link('setting/setting', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'user/profile')) {
                $system[] = array(
                    'name'      => $this->language->get('text_profile'),
                    'href'      => $this->url->link('user/profile', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            # User
            $user = array();

            if($this->user->hasPermission('access', 'user/user')) {
                $user[] = array(
                    'name'      => $this->language->get('text_user'),
                    'href'      => $this->url->link('user/user', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'user/user_permission')) {
                $user[] = array(
                    'name'      => $this->language->get('text_user_group'),
                    'href'      => $this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($user) {
                $system[] = array(
                    'name'      => $this->language->get('text_user'),
                    'href'      => '',
                    'children'  => $user
                );
            }

            # Localisation
            $localisation = array();

            if($this->user->hasPermission('access', 'localisation/location')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_store_location'),
                    'href'      => $this->url->link('localisation/location', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'localisation/language')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_language'),
                    'href'      => $this->url->link('localisation/language', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'localisation/currency')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_currency'),
                    'href'      => $this->url->link('localisation/currency', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'localisation/country')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_country'),
                    'href'      => $this->url->link('localisation/country', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'localisation/zone')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_zone'),
                    'href'      => $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($localisation) {
                $system[] = array(
                    'name'      => $this->language->get('text_localisation'),
                    'href'      => '',
                    'children'  => $localisation
                );
            }

            # Maintenance
            $maintenance = array();

            if($this->user->hasPermission('access', 'tool/log')) {
                $maintenance[] = array(
                    'name'      => $this->language->get('text_error_log'),
                    'href'      => $this->url->link('tool/log', 'user_token=' . $this->session->data['user_token'], true),
                    'children'  => array()
                );
            }

            if($maintenance) {
                $system[] = array(
                    'name'      => $this->language->get('text_maintenance'),
                    'href'      => '',
                    'children'  => $maintenance
                );
            }

            if($system) {
                $data['settings'][] = array(
                    'id'        => 'menu-system',
                    'icon'      => 'fa-cog',
                    'name'      => $this->language->get('text_system'),
                    'href'      => '',
                    'children'  => $system
                );
            }
            # Reports
            $report = array();

            if($this->user->hasPermission('access', 'report/report')) {
                $report[] = array(
                    'name'      => $this->language->get('text_report'),
                    'href'      => $this->url->link('report/report', 'user_token=' . $this->session_data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'report/online')) {
                $report[] = array(
                    'name'      => $this->language->get('text_whos_online'),
                    'href'      => $this->url->link('report/online', 'user_token=' . $this->session_data['user_token'], true),
                    'children'  => array()
                );
            }

            if($this->user->hasPermission('access', 'report/statistics')) {
                $report[] = array(
                    'name'      => $this->language->get('text_statistic'),
                    'href'      => $this->url->link('report/statistics', 'user_token=' . $this->session_data['user_token'], true),
                    'children'  => array()
                );
            }

            if($report) {
                $data['settings'][] = array(
                    'id'        => 'menu-report',
                    'icon'      => 'fa-bar-chart-o',
                    'name'      => $this->language->get('text_report'),
                    'href'      => '',
                    'children'  => $report
                );
            }

            # Logout
            $data['settings'][] = array(
                'id'        => 'menu-dashboard',
                'icon'      => 'fa-sign-out',
                'name'      => $this->language->get('text_logout'),
                'href'      => $this->url->link('user/logout', 'user_token=' . $this->session->data['user_token'], true),
                'children'  => array()
            );

            return $this->load->view('common/nav', $data);
        }
    }
}
