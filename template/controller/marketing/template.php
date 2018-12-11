<?php

class ControllerMarketingTemplate extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('marketing/template');

        $this->load->model('marketing/template');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('template/view/dist/plugins/ckeditor/ckeditor.js');
        $this->document->addScript('template/view/dist/plugins/ckeditor/adapters/jquery.js');

        $this->getList();
    }

    public function add() {
        $this->load->language('marketing/template');

        $this->load->model('marketing/template');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('template/view/dist/plugins/ckeditor/ckeditor.js');
        $this->document->addScript('template/view/dist/plugins/ckeditor/adapters/jquery.js');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_marketing_template->addTemplate($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('marketing/template');

        $this->load->model('marketing/template');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('template/view/dist/plugins/ckeditor/ckeditor.js');
        $this->document->addScript('template/view/dist/plugins/ckeditor/adapters/jquery.js');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_marketing_template->editTemplate($this->request->get['template_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('marketing/template');

        $this->load->model('marketing/template');

        $this->document->setTitle($this->language->get('heading_title'));

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $template_id) {
                $this->model_marketing_template->deleteTemplate($template_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getList();
    }

    protected function getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dasboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('marketing/template/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('marketing/template/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('marketing/template/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('marketing/template_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('marketing/template');

        $totalData = $this->model_marketing_template->getTotalTemplates();

        $totalFiltered = $totalData;

        $results = $this->model_marketing_template->getTemplates();

        $table = array();

        foreach($results as $result) {
            $nestedData['template_id']  = $result['template_id'];
            $nestedData['title']  = $result['title'];
            $nestedData['status']  = $result['status'];
            $nestedData['date_added']  = $result['date_added'];

            $table[] = $nestedData;
        }

        $json = array(
            'recordsTotal'      => $totalData,
            'recordsFiltered'   => $totalFiltered,
            'data'              => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['template_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if(isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if(isset($this->error['title'])) {
            $data['title_err'] = $this->error['title'];
        } else {
            $data['title_err'] = '';
        }

        if(isset($this->error['subject'])) {
            $data['subject_err'] = $this->error['subject'];
        } else {
            $data['subject_err'] = '';
        }

        if(isset($this->error['message'])) {
            $data['message_err'] = $this->error['message'];
        } else {
            $data['message_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true)
        );

        if(!isset($this->request->get['template_id'])) {
            $data['action'] = $this->url->link('marketing/template/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('marketing/template/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('marketing/template/edit', 'member_token=' . $this->session->data['member_token'] . '&template_id=' . $this->request->get['template_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('marketing/template/edit', 'member_token=' . $this->session->data['member_token'], true)
            );
        }

        $data['cancel'] = $this->url->link('marketing/template', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->request->get['template_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $template_info = $this->model_marketing_template->getTemplate($this->request->get['template_id']);
        }

        if(isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif(!empty($template_info)) {
            $data['title'] = $template_info['title'];
        } else {
            $data['title'] = '';
        }

        if(isset($this->request->post['subject'])) {
            $data['subject'] = $this->request->post['subject'];
        } elseif(!empty($template_info)) {
            $data['subject'] = $template_info['subject'];
        } else {
            $data['subject'] = '';
        }

        if(isset($this->request->post['message'])) {
            $data['message'] = $this->request->post['message'];
        } elseif(!empty($template_info)) {
            $data['message'] = $template_info['message'];
        } else {
            $data['message'] = '';
        }

        if(isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif(!empty($template_info)) {
            $data['status'] = $template_info['status'];
        } else {
            $data['status'] = true;
        }

        $data['legends'] = array(
            '{{ NAME }}'        => $this->language->get('legend_name'),
            '{{ FIRSTNAME }}'   => $this->language->get('legend_firstname'),
            '{{ LASTNAME }}'    => $this->language->get('legend_lastname'),
            '{{ EMAIL }}'       => $this->language->get('legend_email'),
            '{{ TELEPHONE }}'   => $this->language->get('legend_telephone'),
            '{{ MOBILE }}'      => $this->language->get('legend_fax'),
        );

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('marketing/template_form', $data));
    }

    protected function validateForm() {
        if(!$this->member->hasPermission('modify', 'marketing/template')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if((utf8_strlen($this->request->post['title']) < 1) || (utf8_strlen($this->request->post['title']) > 64)) {
            $this->error['title'] = $this->language->get('error_title');
        }

        if((utf8_strlen($this->request->post['subject']) < 1) || (utf8_strlen($this->request->post['subject']) > 125)) {
            $this->error['subject'] = $this->language->get('error_subject');
        }

        if(empty($this->request->post['message'])) {
            $this->error['message'] = $this->language->get('error_message');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if(!$this->member->hasPermission('modify', 'marketing/template')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}
