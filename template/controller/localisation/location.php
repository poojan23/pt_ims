<?php

class ControllerLocalisationLocation extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('localisation/location');

        $this->load->model('localisation/location');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getList();
    }

    public function add() {
        $this->load->language('localisation/location');

        $this->load->model('localisation/location');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localisation_location->addLocation($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token']), true);
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('localisation/location');

        $this->load->model('localisation/location');

        $this->document->setTitle($this->language->get('heading_title'));

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localisation_location->editLocation($this->request->get['location_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token']), true);
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('localisation/location');

        $this->load->model('localisation/location');

        $this->document->setTitle($this->language->get('heading_title'));

        if(isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $location_id) {
                $this->model_localisation_location->deleteLocation($location_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token']), true);
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
            'href'  => $this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['add'] = $this->url->link('localisation/location/add', 'member_token=' . $this->session->data['member_token'], true);
        $data['edit'] = $this->url->link('localisation/location/edit', 'member_token=' . $this->session->data['member_token'], true);
        $data['delete'] = $this->url->link('localisation/location/delete', 'member_token=' . $this->session->data['member_token'], true);

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

        $this->response->setOutput($this->load->view('localisation/location_list', $data));
    }

    public function getData() {
        $json = array();

        $this->load->model('localisation/location');

        $totalData = $this->model_localisation_location->getTotalLocations();

        $totalFiltered = $totalData;

        $results = $this->model_localisation_location->getLocations();

        $table = array();

        foreach($results as $result) {
            $nestedData['location_id']  = $result['location_id'];
            $nestedData['name']         = $result['name'];
            $nestedData['address']      = $result['address'];

            $table[] = $nestedData;
        }

        $json = array(
            'resultsTotal'      => $totalData,
            'resultsFiltered'   => $totalFiltered,
            'data'              => $table
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function getForm() {
        $data['text_form'] = !isset($this->request->get['location_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $data['member_token'] = $this->session->data['member_token'];

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

        if(isset($this->error['address'])) {
            $data['address_err'] = $this->error['address'];
        } else {
            $data['address_err'] = '';
        }

        if(isset($this->error['telephone'])) {
            $data['telephone_err'] = $this->error['telephone'];
        } else {
            $data['telephone_err'] = '';
        }

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token'], true)
        );

        if(!isset($this->request->get['location_id'])) {
            $data['action'] = $this->url->link('localisation/location/add', 'member_token=' . $this->session->data['member_token'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('localisation/location/add', 'member_token=' . $this->session->data['member_token'], true)
            );
        } else {
            $data['action'] = $this->url->link('localisation/location/edit', 'member_token=' . $this->session->data['member_token'] . '&location_id=' . $this->request->get['location_id'], true);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('localisation/location/edit', 'member_token=' . $this->session->data['member_token'] . '&location_id=' . $this->request->get['location_id'], true)
            );
        }

        $data['cancel'] = $this->url->link('localisation/location', 'member_token=' . $this->session->data['member_token'], true);

        if(isset($this->request->get['location_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $location_info = $this->model_localisation_location->getLocation($this->request->get['location_id']);
        }

        if(isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif(!empty($location_info)) {
            $data['name'] = $location_info['name'];
        } else {
            $data['name'] = '';
        }

        if(isset($this->request->post['address'])) {
            $data['address'] = $this->request->post['address'];
        } elseif(!empty($location_info)) {
            $data['address'] = $location_info['address'];
        } else {
            $data['address'] = '';
        }

        if(isset($this->request->post['geocode'])) {
            $data['geocode'] = $this->request->post['geocode'];
        } elseif(!empty($location_info)) {
            $data['geocode'] = $location_info['geocode'];
        } else {
            $data['geocode'] = '';
        }

        if(isset($this->request->post['telephone'])) {
            $data['telephone'] = $this->request->post['telephone'];
        } elseif(!empty($location_info)) {
            $data['telephone'] = $location_info['telephone'];
        } else {
            $data['telephone'] = '';
        }

        if(isset($this->request->post['fax'])) {
            $data['fax'] = $this->request->post['fax'];
        } elseif(!empty($location_info)) {
            $data['fax'] = $location_info['fax'];
        } else {
            $data['fax'] = '';
        }

        if(isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif(!empty($location_info)) {
            $data['image'] = $location_info['image'];
        } else {
            $data['image'] = '';
        }

        $this->load->model('tool/image');

        $data['placeholder'] = $this->model_tool_image->resize('placeholder.png', 100, 100);

        if(is_file(DIR_IMAGE . html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8'))) {
            $data['thumb'] = $this->model_tool_image->resize(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8'), 100, 100);
        } else {
            $data['thumb'] = $data['placeholder'];
        }

        if(isset($this->request->post['open'])) {
            $data['open'] = $this->request->post['open'];
        } elseif(!empty($location_info)) {
            $data['open'] = $location_info['open'];
        } else {
            $data['open'] = '';
        }

        if(isset($this->request->post['comment'])) {
            $data['comment'] = $this->request->post['comment'];
        } elseif(!empty($location_info)) {
            $data['comment'] = $location_info['comment'];
        } else {
            $data['comment'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/location_form', $data));
    }

    protected function validateForm() {
        if (!$this->member->hasPermission('modify', 'localisation/location')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['address']) < 3) || (utf8_strlen($this->request->post['address']) > 128)) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 8) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->member->hasPermission('modify', 'localisation/location')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
    }
}
