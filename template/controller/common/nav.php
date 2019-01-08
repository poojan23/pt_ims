<?php

class ControllerCommonNav extends Controller
{
    public function index() {
        if(isset($this->request->get['member_token']) && isset($this->session->data['member_token']) && ($this->request->get['member_token'] == $this->session->data['member_token'])) {
            $this->load->language('common/nav');
            
            $this->load->model('user/user');
            
            $this->load->model('tool/image');
            
            $member_info = $this->model_user_user->getUser($this->member->getId());
            
            if($member_info) {
                $data['firstname'] = $member_info['firstname'];
                $data['lastname'] = $member_info['lastname'];
                $data['email'] = $member_info['email'];
                $data['member_group'] = $member_info['member_group'];
                
                if(is_file(DIR_IMAGE . $member_info['image'])) {
                    $data['image'] = $this->model_tool_image->resize($member_info['image'], 48, 48);
                } else {
                    $data['image'] = $this->model_tool_image->resize('profile.png', 48, 48);
                }
            } else {
                $data['firstname'] = '';
                $data['lastname'] = '';
                $data['email'] = '';
                $data['member_group'] = '';
                $data['image'] = '';
            }
            
            $data['logout'] = $this->url->link('user/logout', '', true);

            # Create a 3 level menu array
            # Level 2 can not have children

            # Menu
            # Dashboard
            $data['menus'][] = [
                'id' => 'menu-dashboard',
                'icon' => 'fa-dashboard',
                'name' => 'Dashboard',
                'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true),
                'children' => array()
            ];

            # Master
            $master = array();
            
            # Customer
            $customer = array();

            if($this->member->hasPermission('access', 'customer/customer')) {
                $customer[] = array(
                    'name'      => $this->language->get('text_customer'),
                    'href'      => $this->url->link('customer/customer', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'customer/customer_group')) {
                $customer[] = array(
                    'name'      => $this->language->get('text_customer_group'),
                    'href'      => $this->url->link('customer/customer_group', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($customer) {
                $master[] = array(
                    'name'      => $this->language->get('text_customer'),
                    'href'      => '',
                    'children'  => $customer
                );
            }
            
            # Products
            $product = array();

            if($this->member->hasPermission('access', 'product/product')) {
                $product[] = array(
                    'name'      => $this->language->get('text_product'),
                    'href'      => $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }
            
            if($this->member->hasPermission('access', 'product/product_type')) {
                $product[] = array(
                    'name'      => $this->language->get('text_product_type'),
                    'href'      => $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($product) {
                $master[] = array(
                    'name'      => $this->language->get('text_product'),
                    'href'      => '',
                    'children'  => $product
                );
            }

            if($master) {
                $data['menus'][] = [
                   'id' => 'menu-master',
                   'icon' => 'fa-bookmark',
                   'name' => 'Master',
                   'href' => '',
                   'children' => $master
               ];
            }
            
            # Inventory
            $sale = array();
            
            # Inward
            if($this->member->hasPermission('access', 'sale/inward')) {
                $sale[] = array(
                    'name'      => $this->language->get('text_inward'),
                    'href'      => $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }
            
            # Sale
            if($this->member->hasPermission('access', 'sale/order')) {
                $sale[] = array(
                    'name'      => $this->language->get('text_order'),
                    'href'      => $this->url->link('sale/order', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }
            
            # Outward
            if($this->member->hasPermission('access', 'sale/outward')) {
                $sale[] = array(
                    'name'      => $this->language->get('text_outward'),
                    'href'      => $this->url->link('sale/outward', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }
            
            # Transfer Inward
            if($this->member->hasPermission('access', 'sale/transfer_inward')) {
                $sale[] = array(
                    'name'      => $this->language->get('text_transfer_inward'),
                    'href'      => $this->url->link('sale/transfer_inward', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($sale) {
                $data['menus'][] = [
                   'id' => 'menu-master',
                   'icon' => 'fa-shopping-cart',
                   'name' => 'Sales',
                   'href' => '',
                   'children' => $sale
               ];
            }

            # Marketing
            $marketing = array();

            if($this->member->hasPermission('access', 'marketing/contact')) {
                $marketing[] = array(
                    'name'      => $this->language->get('text_mail'),
                    'href'      => $this->url->link('marketing/contact', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'marketing/template')) {
                $marketing[] = array(
                    'name'      => $this->language->get('text_template'),
                    'href'      => $this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true),
                    'children'  => array()
                );
            }

            if($marketing) {
                $data['menus'][] = array(
                    'id'        => 'menu-marketing',
                    'icon'      => 'fa-share-alt',
                    'name'      => $this->language->get('text_marketing'),
                    'href'      => '',
                    'children'  => $marketing
                );
            }
            # System
            $system = array();

            # Users
            $user = array();

            if($this->member->hasPermission('access', 'user/user')) {
                $user[] = array(
                    'name'      => $this->language->get('text_user'),
                    'href'      => $this->url->link('user/user', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'user/user_permission')) {
                $user[] = array(
                    'name'      => $this->language->get('text_user_group'),
                    'href'      => $this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token']),
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

            if($this->member->hasPermission('access', 'localisation/location')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_location'),
                    'href'      => $this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if(!$this->member->hasPermission('access', 'localisation/currency')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_currency'),
                    'href'      => $this->url->link('localisation/currency', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'localisation/country')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_country'),
                    'href'      => $this->url->link('localisation/country', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'localisation/zone')) {
                $localisation[] = array(
                    'name'      => $this->language->get('text_zone'),
                    'href'      => $this->url->link('localisation/zone', 'member_token=' . $this->session->data['member_token']),
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

            if($this->member->hasPermission('access', 'tool/log')) {
                $maintenance[] = array(
                    'name'      => $this->language->get('text_error_log'),
                    'href'      => $this->url->link('tool/log', 'member_token=' . $this->session->data['member_token']),
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
                $data['menus'][] = array(
                    'id'        => 'menu-system',
                    'icon'      => 'fa-gear',
                    'name'      => $this->language->get('text_system'),
                    'href'      => '',
                    'children'  => $system
                );
            }

            # Reports
            $report = array();

            if($this->member->hasPermission('access', 'report/report')) {
                $report[] = array(
                    'name'      => $this->language->get('text_report'),
                    'href'      => $this->url->link('report/report', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'report/director_report')) {
                $report[] = array(
                    'name'      => $this->language->get('text_director_report'),
                    'href'      => $this->url->link('report/director_report', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'report/inward_summary')) {
                $report[] = array(
                    'name'      => $this->language->get('text_inward_summary'),
                    'href'      => $this->url->link('report/inward_summary', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($this->member->hasPermission('access', 'report/outward_summary')) {
                $report[] = array(
                    'name'      => $this->language->get('text_outward_summary'),
                    'href'      => $this->url->link('report/outward_summary', 'member_token=' . $this->session->data['member_token']),
                    'children'  => array()
                );
            }

            if($report) {
                $data['menus'][] = array(
                    'id'        => 'menu-report',
                    'icon'      => 'fa-bar-chart',
                    'name'      => $this->language->get('text_report'),
                    'href'      => '',
                    'children'  => $report
                );
            }

            return $this->load->view('common/nav', $data);
        }
    }
}