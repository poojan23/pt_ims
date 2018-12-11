<?php

class ControllerUserUserPermission extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('user/user_group');

        $this->load->model('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function add() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_user_user_group->addUserGroup($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if(isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if(isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if(isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_user_user_group->editUserGroup($this->request->get['member_group_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if(isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if(isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if(isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $member_group_id) {
                $this->model_user_user_group->deleteUserGroup($member_group_id);
            }
            
            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if(isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if(isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if(isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'] . $url, true));
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
            'href'  => $this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('user/user_permission/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('user/user_permission/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('user/user_permission/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('user/user_group_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('user/user_group');

        $totalData = $this->model_user_user_group->getTotalUserGroups();

        $totalFiltered = $totalData;

        $results = $this->model_user_user_group->getUserGroups();

        $table = array();

        foreach($results as $result) {
            $nestedData['member_group_id']  = $result['member_group_id'];
            $nestedData['name']             = $result['name'];
            $nestedData['sort_order']       = $result['sort_order'];

            $table[] = $nestedData;
        }

        $json = array(
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $table
        );

        echo json_encode($json);
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['member_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'], true)
        );

        if(!isset($this->request->get['member_group_id'])) {
            $data['action'] = $this->url->link('user/user_permission/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('user/user_permission/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('user/user_permission/edit', 'member_token=' . $this->session->data['member_token'] . '&member_group_id=' . $this->request->get['member_group_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('user/user_permission/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('user/user_permission', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->request->get['member_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $member_group_info = $this->model_user_user_group->getUserGroup($this->request->get['member_group_id']);
        }

        $this->load->language('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if(isset($this->request->post['user_group_description'])) {
            $data['user_group_description'] = $this->request->post['user_group_description'];
        } elseif(isset($this->request->get['member_group_id'])) {
            $data['user_group_description'] = $this->model_user_user_group->getUserGroupDescriptions($this->request->get['member_group_id']);
        } else {
            $data['member_group_description'] = array();
        }

        $ignore = array(
            'home/dashboard',
            'startup/router',
            'user/login',
            'user/logout',
            'user/forgotten',
            'user/reset',
            'common/header',
            'common/footer',
            'error/not_found',
            'error/permission',
            'common/track'
        );

        $data['permissions'] = array();

        $files = array();

        # Make path into an array
        $path = array(DIR_APPLICATION . 'controller/*');

        # While the path array is still populated keep looping through
        while(count($path) != 0) {
            $next = array_shift($path);

            foreach(glob($next) as $file) {
                # If directory add to path array
                if(is_dir($file)) {
                    $path[] = $file . '/*';
                }

                # Add the file to the files to be deleted array
                if(is_file($file)) {
                    $files[] = $file;
                }
            }
        }

        # Sort the file array
        sort($files);

        foreach($files as $file) {
            $controller = substr($file, strlen(DIR_APPLICATION . 'controller/'));

            $permission = substr($controller, 0, strrpos($controller, '.'));

            if(!in_array($permission, $ignore)) {
                $data['permissions'][] = $permission;
            }
        }

        if(isset($this->request->post['permission']['access'])) {
            $data['access'] = $this->request->post['permission']['access'];
        } elseif(isset($member_group_info['permission']['access'])) {
            $data['access'] = $member_group_info['permission']['access'];
        } else {
            $data['access'] = array();
        }

        if(isset($this->request->post['permission']['modify'])) {
            $data['modify'] = $this->request->post['permission']['modify'];
        } elseif(isset($member_group_info['permission']['modify'])) {
            $data['modify'] = $member_group_info['permission']['modify'];
        } else {
            $data['modify'] = array();
        }

        if(isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif(!empty($member_group_info)) {
            $data['sort_order'] = $member_group_info['sort_order'];
        } else {
            $data['sort_order'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('user/user_group_form', $data));
    }

    protected function validateForm() {
        if(!$this->member->hasPermission('modify', 'user/user_permission')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach($this->request->post['user_group_description'] as $language_id => $value) {
            if((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if(!$this->member->hasPermission('modify', 'user/user_permission')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('user/user');

        foreach($this->request->post['selected'] as $member_group_id) {
            $member_total = $this->model_user_user->getTotalUsersByUserGroupId($member_group_id);

            if($member_total) {
                $this->error['warning'] = sprintf($this->language->get('error_user'), $member_total);
            }
        }

        return !$this->error;
    }
}
