<?php

class ControllerUserUserPermission extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

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

            $this->response->redirect($this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_user_user_group->editUserGroup($this->request->get['user_group_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('user/user_group');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('user/user_group');

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $user_group_id) {
                $this->model_user_user_group->deleteUserGroup($user_group_id);
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

            $this->response->redirect($this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getList();
    }

    protected function getList() {
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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );

        $data['add'] = $this->url->link('user/user_permission/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
        $data['edit'] = $this->url->link('user/user_permission/edit', 'user_token=' . $this->session->data['user_token'] . $url, true);
        $data['delete'] = $this->url->link('user/user_permission/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

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
            $nestedData['user_group_id']    = $result['user_group_id'];
            $nestedData['name']             = $result['name'];

            $table[] = $nestedData;
        }

        $json = array(
            'recordsTotal'      => $totalData,
            'recordsFiltered'   => $totalFiltered,
            'data'              => $table
        );

        echo json_encode($json);
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['user_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );

        if(!isset($this->request->get['user_group_id'])) {
            $data['action'] = $this->url->link('user/user_permission/add', 'user_token=' . $this->session->data['user_token'] . $url, true);

            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('user/user_permission/add', 'user_token=' . $this->session->data['user_token'] . $url, true)
            );
        } else {
            $data['action'] = $this->url->link('user/user_permission/edit', 'user_token=' . $this->session->data['user_token'] . $url . '&user_group_id=' . $this->request->get['user_group_id'], true);

            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('user/user_permission/edit', 'user_token=' . $this->session->data['user_token'] . $url, true)
            );
        }

        $data['cancel'] = $this->url->link('user/user_permission', 'user_token=' . $this->session->data['user_token'] . $url, true);

        if(isset($this->request->get['user_group_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
            $user_group_info = $this->model_user_user_group->getUserGroup($this->request->get['user_group_id']);
        }

        if(isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif(!empty($user_group_info)) {
            $data['name'] = $user_group_info['name'];
        } else {
            $data['name'] = '';
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
            'error/permission'
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
        } elseif(isset($user_group_info['permission']['access'])) {
            $data['access'] = $user_group_info['permission']['access'];
        } else {
            $data['access'] = array();
        }

        if(isset($this->request->post['permission']['modify'])) {
            $data['modify'] = $this->request->post['permission']['modify'];
        } elseif(isset($user_group_info['permission']['modify'])) {
            $data['modify'] = $user_group_info['permission']['modify'];
        } else {
            $data['modify'] = array();
        }
        
        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('user/user_group_form', $data));
    }

    protected function validateForm() {
        if(!$this->user->hasPermission('modify', 'user/user_permission')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if(!$this->user->hasPermission('modify', 'user/user_permission')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('user/user');

        foreach($this->request->post['selected'] as $user_group_id) {
            $user_total = $this->model_user_user->getTotatUsersByGroupId($user_group_id);

            if($user_total) {
                $this->error['warning'] = sprintf($this->language->get('error_user'), $user_total);
            }
        }

        return !$this->error;
    }
}
