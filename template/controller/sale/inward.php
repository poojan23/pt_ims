<?php

class ControllerSaleInward extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        $this->getList();
    }

    public function add() {
        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            //$this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$this->model_master_client->addCategory($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

//			$url = '';
//
//			if (isset($this->request->get['sort'])) {
//				$url .= '&sort=' . $this->request->get['sort'];
//			}
//
//			if (isset($this->request->get['order'])) {
//				$url .= '&order=' . $this->request->get['order'];
//			}
//
//			if (isset($this->request->get['page'])) {
//				$url .= '&page=' . $this->request->get['page'];
//			}

			$this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'], true));
		}

        $this->getForm();
    }

    public function edit() {
        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            //$this->request->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$this->model_master_client->editCategory($this->request->get['category_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'] . $url, true));
		}

        $this->getForm();
    }

    public function delete() {
        $this->load->language('sale/inward');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/inward');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach($this->request->post['selected'] as $category_id) {
                $this->model_master_client->deleteCategory($category_id);
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
            
            $this->response->redirect($this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'] . $url, true));
        }
        
        $this->getList();
    }

    protected function getList() {
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
			'href' => $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'] . $url, true)
		);

		$data['add'] = $this->url->link('sale/inward/add', 'member_token=' . $this->session->data['member_token'] . $url, true);
		$data['edit'] = $this->url->link('sale/inward/edit', 'member_token=' . $this->session->data['member_token'] . $url, true);
        $data['delete'] = $this->url->link('sale/inward/delete', 'member_token=' . $this->session->data['member_token'] . $url, true);
        
        $data['text_confirm'] = $this->language->get('text_confirm');

        if(isset($this->error['warning'])) {
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

        $this->response->setOutput($this->load->view('sale/inward_list', $data));
    } 

    public function getData() {
        $json = [];

        $data = [
           'sort'        => 'name',
            'order'       => 'ASC',
            'start'       => 0,
            'limit'       => 5000
        ];

        $this->load->model('sale/inward');

        $totalData = $this->model_sale_inward->getTotalInward();

        $totalFiltered = $totalData;

        $results = $this->model_sale_inward->getInward($data);

        $table = [];

        foreach($results as $result) {
           
                $nestedData['createDate']         = $result['createDate'];
                $nestedData['partyName']          = $result['partyName'];
                $nestedData['tructNo']            = $result['tructNo'];
                $nestedData['product_type']       = $result['product_type'];
                $nestedData['grade']              = $result['grade'];
                $nestedData['coilNo']             = $result['coilNo'];
                $nestedData['thickness']          = $result['thickness'];
                $nestedData['width']              = $result['width'];
                $nestedData['length']             = $result['length'];
                $nestedData['pieces']             = $result['pieces'];
                $nestedData['netWeight']          = $result['netWeight'];
                $nestedData['grossWeight']        = $result['grossWeight'];
                $nestedData['packaging']          = $result['packaging'];
                
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
        $data['text_form'] = !isset($this->request->get['category_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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

        if(isset($this->error['meta_title'])) {
            $data['meta_title_err'] = $this->error['meta_title'];
        } else {
            $data['meta_title_err'] = '';
        }

        if(isset($this->error['meta_keyword'])) {
            $data['meta_keyword_err'] = $this->error['meta_keyword'];
        } else {
            $data['meta_keyword_err'] = '';
        }

        if(isset($this->error['parent'])) {
            $data['parent_err'] = $this->error['parent'];
        } else {
            $data['parent_err'] = '';
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

        $data['breadcrumbs'][] = [
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        ];

        $data['breadcrumbs'][] = [
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'] . $url, true)
        ];

        if(!isset($this->request->get['category_id'])) {
            $data['action'] = $this->url->link('sale/inward/add', 'member_token=' . $this->session->data['member_token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('sale/inward/edit', 'member_token=' . $this->session->data['member_token'] . '&category_id=' . $this->request->get['category_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('sale/inward', 'member_token=' . $this->session->data['member_token'] . $url, true);

        if(isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $category_info = $this->model_master_client->getCategory($this->request->get['category_id']);
        }

        $data['member_token'] = $this->session->data['member_token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if(isset($this->request->post['category_description'])) {
            $data['category_description'] = $this->request->post['category_description'];
        } elseif(isset($this->request->get['category_id'])) {
            $data['category_description'] = $this->model_master_client->getCategoryDescriptions($this->request->get['category_id']);
        } else {
            $data['category_description'] = array();
        }

        if(isset($this->request->post['path'])) {
            $data['path'] = $this->request->post['path'];
        } elseif(!empty($category_info)) {
            $data['path'] = $category_info['path'];
        } else {
            $data['path'] = '';
        }

        if(isset($this->request->post['parent_id'])) {
            $data['parent_id'] = $this->request->post['parent_id'];
        } elseif(!empty($category_info)) {
            $data['parent_id'] = $category_info['parent_id'];
        } else {
            $data['parent_id'] = 0;
        }

        if(isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif(!empty($category_info)) {
            $data['image'] = $category_info['image'];
        } else {
            $data['image'] = '';
        }

        $this->load->model('tool/image');

        if(isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resise($this->request->post['image'], 100, 100);
        } elseif(!empty($category_info) && is_file(DIR_IMAGE . $category_info['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($category_info['image'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no-image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no-image.png', 100, 100);

        if(isset($this->request->post['top'])) {
            $data['top'] = $this->request->post['top'];
        } elseif(!empty($category_info['top'])) {
            $data['top'] = $category_info['top'];
        } else {
            $data['top'] = 0;
        }

        if(isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif(!empty($category_info)) {
            $data['sort_order'] = $category_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }

        if(isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif(!empty($category_info)) {
            $data['status'] = $category_info['status'];
        } else {
            $data['status'] = 1;
        }

        if(isset($this->request->post['category_seo_url'])) {
            $data['category_seo_url'] = $this->request->post['category_seo_url'];
        } elseif(isset($this->request->get['category_id'])) {
            $data['category_seo_url'] = $this->model_master_client->getCategorySeoUrls($this->request->get['category_id']);
        } else {
            $data['category_seo_url'] = array();
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('sale/inward_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'sale/inward')) {
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
			$results = $this->model_master_client->getCategoryPath($this->request->post['parent_id']);
			
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
        if(!$this->user->hasPermission('modify', 'sale/inward')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if(isset($this->request->get['filter_name'])) {
            $this->load->model('sale/inward');

            $filter_data = [
                'filter_name'   => $this->request->get['filter_name'],
                'sort'          => 'name',
                'order'         => 'ASC',
                'start'         => 0,
                'limit'         => 5
            ];

            $results = $this->model_master_client->getCategories($filter_data);

            foreach($results as $result) {
                $json[] = [
                    'category_id'   => $result['category_id'],
                    'name'          => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                ];
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
}
