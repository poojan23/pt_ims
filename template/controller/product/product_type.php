<?php

class ControllerProductProductType extends Controller
{
    private $error;

    public function index() {
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'member_token=' . $this->session->data['member_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'] . $url, true)
		);

		if(isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

		$data['add'] = $this->url->link('product/product_type/add', 'member_token=' . $this->session->data['member_token'] . $url, true);
		$data['edit'] = $this->url->link('product/product_type/edit', 'member_token=' . $this->session->data['member_token'] . $url, true);
        $data['delete'] = $this->url->link('product/product_type/delete', 'member_token=' . $this->session->data['member_token'] . $url, true);
        
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('product/product_type_list', $data));
    }

    public function add() {
        $this->load->language('product/product_type');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('product/product_type');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$this->model_product_product_type->addUserGroup($this->request->post);

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

			$this->response->redirect($this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'] . $url, true));
		}

		$this->getForm();
    }

    public function edit() {
        $this->load->language('product/product_type');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('product/product_type');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->model_product_product_type->editUserGroup($this->request->get['user_group_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_edit_success');
            
            # Url
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

            $this->response->redirect($this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() {

    }

    public function getList() {
        $json = [];

        $data = [
            'sort'        => 'name',
            'order'       => 'ASC',
            'start'       => 0,
            'limit'       => 5
        ];

        $this->load->model('product/product_type');

        $totalData = $this->model_product_product_type->getTotalUserGroups();

        $totalFiltered = $totalData;

        $results = $this->model_product_product_type->showUserGroups($data);

        $table = [];

        foreach($results as $result) {
           
                $nestedData['user_group_id']    = $result['user_group_id'];
                $nestedData['name']             = $result['name'];

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
        $data['text_form'] = !isset($this->request->get['user_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'] . $url, true)
		);

		if (!isset($this->request->get['user_group_id'])) {
			$data['action'] = $this->url->link('product/product_type/add', 'member_token=' . $this->session->data['member_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('product/product_type/edit', 'member_token=' . $this->session->data['member_token'] . '&user_group_id=' . $this->request->get['user_group_id'] . $url, true);
		}

        $data['cancel'] = $this->url->link('product/product_type', 'member_token=' . $this->session->data['member_token'] . $url, true);

		if (isset($this->request->get['user_group_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$user_group_info = $this->model_product_product_type->getUserGroup($this->request->get['user_group_id']);
		}
		//print_r($user_group_info); exit;

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($user_group_info)) {
			$data['name'] = $user_group_info['name'];
		} else {
			$data['name'] = '';
		}

		$ignore = array(
			'home/dashboard',
			'common/startup',
			'user/login',
			'user/logout',
			'user/forgotten',
			'user/reset',			
			'common/footer',
			'common/header',
			'error/not_found',
			'error/permission'
		);

		$data['permissions'] = array();

		$files = array();

		// Make path into an array
		$path = array(DIR_APPLICATION . 'controller/*');

		// While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);
					
		foreach ($files as $file) {
			$controller = substr($file, strlen(DIR_APPLICATION . 'controller/'));

			$permission = substr($controller, 0, strrpos($controller, '.'));

			if (!in_array($permission, $ignore)) {
				$data['permissions'][] = $permission;
			}
		}

		if (isset($this->request->post['permission']['access'])) {
			$data['access'] = $this->request->post['permission']['access'];
		} elseif (isset($user_group_info['permission']['access'])) {
			$data['access'] = $user_group_info['permission']['access'];
		} else {
			$data['access'] = array();
		}

		if (isset($this->request->post['permission']['modify'])) {
			$data['modify'] = $this->request->post['permission']['modify'];
		} elseif (isset($user_group_info['permission']['modify'])) {
			$data['modify'] = $user_group_info['permission']['modify'];
		} else {
			$data['modify'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['nav'] = $this->load->controller('common/nav');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('product/product_type_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'user/user_permission')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
    }

    protected function validateDelete() {

    }
}