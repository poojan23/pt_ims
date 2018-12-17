<?php

class ControllerProductProduct extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        $this->getList();
    }

    public function add() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            //$this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->model_product_product->addProduct($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            //$this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->model_product_product->editCategory($this->request->get['category_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('product/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $category_id) {
                $this->model_product_product->deleteCategory($category_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('product/product', 'member_token=' . $this->session->data['member_token'] . $url, true));
        }

        $this->getList();
    }

    protected function getList() {

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('product/product/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('product/product/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('product/product/delete', 'member_token=' . $this->session->data['member_token'], true);

        $data['text_confirm'] = $this->language->get('text_confirm');

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_list', $data));
    }

    public function getData() {
        $json = [];

        $this->load->model('product/product');

        $totalData = $this->model_product_product->getTotalProducts();

        $totalFiltered = $totalData;

        $results = $this->model_product_product->getProduct();

        $table = [];

        foreach ($results as $result) {

            $nestedData['product_id'] = $result['product_id'];
            $nestedData['product_name'] = $result['product_name'];
            $nestedData['product_code'] = $result['product_code'];

            $table[] = $nestedData;
        }

        $json = array(
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $table
        );

        echo json_encode($json);
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = '';
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true)
        ];

        if (!isset($this->request->get['product_id'])) {
            $data['action'] = $this->url->link('product/product/add', 'member_token=' . $this->session->data['member_token'], true);
        } else {
            $data['action'] = $this->url->link('product/product/edit', 'member_token=' . $this->session->data['member_token'] . '&product_id=' . $this->request->get['product_id'], true);
        }

        $data['cancel'] = $this->url->link('product/product', 'member_token=' . $this->session->data['member_token'], true);

        if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $product_info = $this->model_product_product->getProductByID($this->request->get['product_id']);
        }

        $data['member_token'] = $this->session->data['member_token'];

//        $this->load->model('localisation/language');
//
//        $data['languages'] = $this->model_localisation_language->getLanguages();




        if (isset($this->request->post['product_name'])) {
            $data['product_name'] = $this->request->post['product_name'];
        } elseif (!empty($product_info)) {
            $data['product_name'] = $product_info['product_name'];
        } else {
            $data['product_name'] = '';
        }
        
        if (isset($this->request->post['product_code'])) {
            $data['product_code'] = $this->request->post['product_code'];
        } elseif (!empty($product_info)) {
            $data['product_code'] = $product_info['product_code'];
        } else {
            $data['product_code'] = '';
        }
        
        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($product_info)) {
            $data['sort_order'] = $product_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'product/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['category_description'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }

            if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
                $this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
            }
        }

        if (isset($this->request->get['category_id']) && $this->request->post['parent_id']) {
            $results = $this->model_product_product->getCategoryPath($this->request->post['parent_id']);

            foreach ($results as $result) {
                if ($result['path_id'] == $this->request->get['category_id']) {
                    $this->error['parent'] = $this->language->get('error_parent');

                    break;
                }
            }
        }

        if ($this->request->post['category_seo_url']) {
            $this->load->model('design/seo_url');

            foreach ($this->request->post['category_seo_url'] as $language_id => $keyword) {
                if (!empty($keyword)) {
                    if (count($keyword) > 1) {
                        $this->error['keyword'][$language_id] = $this->language->get('error_unique');
                    }

                    $seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);

                    foreach ($seo_urls as $seo_url) {
                        if (($seo_url['language_id'] == $language_id) && (!isset($this->request->get['category_id']) || ($seo_url['query'] != 'category_id=' . $this->request->get['category_id']))) {
                            $this->error['keyword'][$language_id] = $this->language->get('error_keyword');

                            break;
                        }
                    }
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'product/product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('product/product');

            $filter_data = [
                'filter_name' => $this->request->get['filter_name'],
                'sort' => 'name',
                'order' => 'ASC',
                'start' => 0,
                'limit' => 5
            ];

            $results = $this->model_product_product->getCategories($filter_data);

            foreach ($results as $result) {
                $json[] = [
                    'category_id' => $result['category_id'],
                    'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                ];
            }

            $sort_order = array();

            foreach ($json as $key => $value) {
                $sort_order[$key] = $value['name'];
            }

            array_multisort($sort_order, SORT_ASC, $json);

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
    }

}
