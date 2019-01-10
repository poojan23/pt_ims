<?php

class ControllerUserUser extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('user/user');

        $this->load->model('user/user');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function add() {
        $this->load->language('user/user');

        $this->load->model('user/user');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_user_user->addUser($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('user/user');

        $this->load->model('user/user');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_user_user->editUser($this->request->get['member_id'] ,$this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('user/user');

        $this->load->model('user/user');

        $this->document->setTitle($this->language->get('heading_title'));

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $member_id) {
                //print_r($member_id); exit;
                $this->model_user_user->deleteUser($member_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('user/user/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('user/user/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('user/user/delete', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('user/user_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('user/user');

        $totalData = $this->model_user_user->getTotalUsers();

        $totalFiltered = $totalData;

        $results = $this->model_user_user->getUsers();

        $table = array();

        foreach($results as $result) {
            $nestedData['member_id']    = $result['member_id'];
            $nestedData['name']         = $result['name'];
            $nestedData['email']        = $result['email'];
            $nestedData['member_group_id'] = $result['member_group_id'];
            $nestedData['status']       = $result['status'];
            $nestedData['ip']           = $result['ip'];
            $nestedData['date_added']   = ($result['date_added'] != 0000-00-00) ? date('d/m/Y', strtotime($result['date_added'])) : '00/00/0000';

            $table[] = $nestedData;
        }
        $json = array(
            'recordsTotal'      => intval($totalData),
            'recordsFiltered'   => intval($totalFiltered),
            'data'              => $table
        );
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['member_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['member_token'] = $this->session->data['member_token'];

        if(isset($this->request->get['member_id'])) {
            $data['member_id'] = $this->request->get['member_id'];
        } else {
            $data['member_id'] = 0;
        }

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }
        
        if(isset($this->error['firstname'])) {
            $data['firstname_err'] = $this->error['firstname'];
        } else {
            $data['firstname_err'] = '';
        }

        if(isset($this->error['lastname'])) {
            $data['lastname_err'] = $this->error['lastname'];
        } else {
            $data['lastname_err'] = '';
        }

        if(isset($this->error['email'])) {
            $data['email_err'] = $this->error['email'];
        } else {
            $data['email_err'] = '';
        }

        if(isset($this->error['telephone'])) {
            $data['telephone_err'] = $this->error['telephone'];
        } else {
            $data['telephone_err'] = '';
        }

        if(isset($this->error['mobile'])) {
            $data['mobile_err'] = $this->error['mobile'];
        } else {
            $data['mobile_err'] = '';
        }

        if(isset($this->error['password'])) {
            $data['password_err'] = $this->error['password'];
        } else {
            $data['password_err'] = '';
        }

        if(isset($this->error['confirm'])) {
            $data['confirm_err'] = $this->error['confirm'];
        } else {
            $data['confirm_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true)
        );

        if(!isset($this->request->get['member_id'])) {
            $data['action'] = $this->url->link('user/user/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('user/user/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('user/user/edit', 'member_token=' . $this->session->data['member_token'] . '&member_id=' . $this->request->get['member_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('user/user/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('user/user', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->request->get['member_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $member_info = $this->model_user_user->getUser($this->request->get['member_id']);
        }

        $this->load->model('user/user_role');

        $data['user_roles'] = $this->model_user_user_role->getUserRoles();
        if(isset($this->request->post['member_role_id'])) {
            $data['member_role_id'] = $this->request->post['member_role_id'];
        } elseif(!empty($member_info)) {
            $data['member_role_id'] = $member_info['member_role_id'];
        } else {
            $data['member_role_id'] = '';
        }
        
        $this->load->model('user/user_group');

        $data['user_groups'] = $this->model_user_user_group->getUserGroups();
        
        if(isset($this->request->post['member_group_id'])) {
            $data['member_group_id'] = $this->request->post['member_group_id'];
        } elseif(!empty($member_info)) {
            $data['member_group_id'] = $member_info['member_group_id'];
        } else {
            $data['member_group_id'] = '';
        }

        if(isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif(!empty($member_info)) {
            $data['firstname'] = $member_info['firstname'];
        } else {
            $data['firstname'] = '';
        }

        if(isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif(!empty($member_info)) {
            $data['lastname'] = $member_info['lastname'];
        } else {
            $data['lastname'] = '';
        }

        if(isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif(!empty($member_info)) {
            $data['email'] = $member_info['email'];
        } else {
            $data['email'] = '';
        }

        if(isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif(!empty($member_info)) {
            $data['telephone'] = $member_info['telephone'];
        } else {
            $data['telephone'] = '';
        }

        if(isset($this->request->post['mobile'])) {
            $data['mobile'] = $this->request->post['mobile'];
        } elseif(!empty($member_info)) {
            $data['mobile'] = $member_info['mobile'];
        } else {
            $data['mobile'] = '';
        }

        if(isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif(!empty($member_info)) {
            $data['status'] = $member_info['status'];
        } else {
            $data['status'] = true;
        }

        if(isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if(isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('user/register', $data));
    }

    protected function validateForm() {
        if(!$this->member->hasPermission('modify', 'user/user')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $member_info = $this->model_user_user->getUserByEmail($this->request->post['email']);

        if(!isset($this->request->get['member_id'])){
            if($member_info) {
                $this->error['warning'] = $this->language->get('error_exists');
                $this->error['email'] = $this->language->get('error_exists');
            }
        } else {
            if($member_info && ($this->request->get['member_id'] != $member_info['member_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
                $this->error['email'] = $this->language->get('error_exists');
            }
        }

        if((utf8_strlen($this->request->post['telephone']) < 8) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if((utf8_strlen($this->request->post['mobile']) < 10) || (utf8_strlen($this->request->post['mobile']) > 11)) {
            $this->error['mobile'] = $this->language->get('error_mobile');
        }

        if($this->request->post['password'] || (!isset($this->request->get['member_id']))) {
            if((utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
                $this->error['password'] = $this->language->get('error_password');
            }

            if($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
        }

        if($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if(!$this->member->hasPermission('modify', 'user/user')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if(isset($this->request->get['filter_name'])) {
            $this->load->model('user/user');

            $filter_data = array(
                'filter_name'   => $this->request->get['filter_name'],
                'sort'          => 'name',
                'order'         => 'ASC',
                'start'         => 0,
                'limit'         => 5
            );

            $results = $this->model_user_user->getUsers($filter_data);

            foreach($results as $result) {
                $json[] = array(
                    'member_id' => $result['member_id'],
                    'name' => trim(strip_tags(html_entity_decode($result['firstname'], ENT_QUOTES, 'UTF-8'))) . ' ' . trim(strip_tags(html_entity_decode($result['lastname'], ENT_QUOTES, 'UTF-8')))
                );
            }
        }

        $sort_order = array();

        foreach($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
