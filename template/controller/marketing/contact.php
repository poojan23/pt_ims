<?php

class ControllerMarketingContact extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('marketing/contact');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->document->addScript('template/view/dist/plugins/ckeditor/ckeditor.js');
        $this->document->addScript('template/view/dist/plugins/ckeditor/adapters/jquery.js');

        $data['member_token'] = $this->session->data['member_token'];

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('marketing/contact', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['cancel'] = $this->url->link('marketing/contact', 'member_token=' . $this->session->data['member_token'], true);

        $this->load->model('customer/customer_group');

        $this->load->model('marketing/template');

        $data['from'] = $this->config->get('config_email');

        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

        $data['templates'] = $this->model_marketing_template->getTemplates();

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('marketing/contact', $data));
    }

    public function send() {
        $this->load->language('marketing/contact');

        $this->load->model('marketing/contact');

        $json = array();

        if($this->request->server['REQUEST_METHOD'] == 'POST') {
            if(!$this->member->hasPermission('modify', 'marketing/contact')) {
                $json['error']['warning'] = $this->language->get('error_permission');
            }

            if(!$this->request->post['subject']) {
                $json['error']['subject'] = $this->language->get('error_subject');
            }

            if(!$this->request->post['message']) {
                $json['error']['message'] = $this->language->get('error_message');
            }

            if(!$json) {
                $store_name = $this->config->get('config_name');

                $store_email = $this->config->get('config_email');

                $this->load->model('customer/customer');

                $this->load->model('customer/customer_group');

                if(isset($this->request->get['page'])) {
                    $page = $this->request->get['page'];
                } else {
                    $page = 1;
                }

                $email_total = 0;

                $emails = array();

                $files = array();

                $inputs = array();

                switch ($this->request->post['to']) {
                    case 'newsletter':
                        # code...
                        $customer_data = array(
                            'filter_newsletter' => 1,
                            'start'             => ($page - 1) * 10,
                            'limit'             => 10
                        );

                        $email_total = $this->model_customer_customer->getTotalCustomers($customer_data);
                        
                        $results = $this->model_customer_customer->getCustomers($customer_data);
                        
                        foreach($results as $result) {
                            $emails[] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['firstname'] . ' ' . $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['firstname'];
                            $inputs[$result['customer_id']][] = $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['telephone'];
                            $inputs[$result['customer_id']][] = $result['mobile'];
                        }
                        print_r($inputs);exit;
                        break;
                        
                    case 'customer_all':
                        # code...
                        $customer_data = array(
                            'start' => ($page - 1) * 10,
                            'limit' => 10
                        );

                        $email_total = $this->model_customer_customer->getTotalCustomers($customer_data);

                        $results = $this->model_customer_customer->getCustomers($customer_data);

                        foreach($results as $result) {
                            $emails[] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['firstname'] . ' ' . $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['firstname'];
                            $inputs[$result['customer_id']][] = $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['telephone'];
                            $inputs[$result['customer_id']][] = $result['mobile'];
                        }
                        break;

                    case 'customer_group':
                        # code...
                        $customer_data = array(
                            'filter_customer_group_id'  => $this->request->post['customer_group_id'],
                            'start'                     => ($page - 1) * 10,
                            'limit'                     => 10
                        );

                        $email_total = $this->model_customer_customer->getTotalCustomers($customer_data);

                        $results = $this->model_customer_customer->getCustomers($customer_data);

                        foreach($results as $result) {
                            $emails[] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['firstname'] . ' ' . $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['firstname'];
                            $inputs[$result['customer_id']][] = $result['lastname'];
                            $inputs[$result['customer_id']][] = $result['email'];
                            $inputs[$result['customer_id']][] = $result['telephone'];
                            $inputs[$result['customer_id']][] = $result['mobile'];
                        }
                        break;

                    case 'customer':
                        # code...
                        if(!empty($this->request->post['customer'])) {
                            foreach($this->request->post['customer'] as $customer_id) {
                                $customer_info = $this->model_customer_customer->getCustomer($customer_id);

                                if($customer_info) {
                                    $emails[] = $customer_info['email'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['firstname'] . ' ' . $customer_info['lastname'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['firstname'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['lastname'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['email'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['telephone'];
                                    $inputs[$customer_info['customer_id']][] = $customer_info['mobile'];
                                }
                            }

                            $email_total = count($this->request->post['customer']);
                        }
                        break;

                    case 'customer_file':
                        # code...
                        if(!empty($this->request->post['customer_id'])) {
                            $customer_info = $this->model_customer_customer->getCustomer($this->request->post['customer_id']);

                            if($customer_info) {
                                $emails[] = $customer_info['email'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['firstname'] . ' ' . $customer_info['lastname'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['firstname'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['lastname'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['email'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['telephone'];
                                $inputs[$customer_info['customer_id']][] = $customer_info['mobile'];
                            

                                if(!empty($this->request->post['files'])) {
                                    foreach($this->request->post['files'] as $file) {
                                        $results = $this->model_customer_customer->getFilesByCustomerFileId($file, $this->request->post['customer_id']);

                                        foreach($results as $result) {
                                            $files[] = DIR_DOWNLOAD . $result['filename'];
                                        }
                                    }
                                }
                            }

                            $email_total = 1;
                        }
                        break;
                }

                if($emails) {
                    $json['success'] = $this->language->get('text_success');

                    $start = ($page - 1) * 10;
                    $end = $start + 10;

                    $json['success'] = sprintf($this->language->get('text_sent'), $start, $email_total);

                    if($end < $email_total) {
                        $json['next'] = str_replace('&amp;', '&', $this->url->link('marketing/contact/send', 'member_token=' . $this->session->data['member_token'] . '&page=' . ($page + 1)));
                    } else {
                        $json['next'] = '';
                    }

                    $keys = array('name', 'firstname', 'lastname', 'email', 'telephone', 'mobile');
                    
                    $string = html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8');

                    $strings = array();
                    
                    foreach($inputs as $input) {
                        $input = array_combine($keys, $input);

                        $userMessage = $string;

                        foreach($input as $key => $value) {
                            $userMessage = str_replace(array('{{ ' . strtoupper($key) . ' }}', '{{' . strtoupper($key) . '}}', '{{' . strtoupper($key) . ' }}', '{{ ' . strtoupper($key) . '}}'), $value, $userMessage);
                        }

                        $strings[] = $userMessage;
                    }
                    
                    for($i = 0; $i < count($strings); $i++) {
                        $uniq_id = uniqid();

                        $track = $this->url->link('common/track', 'token=' . $uniq_id, true);
                        
                        $message  = '<html dir="ltr" lang="en">' . "\n";
                        $message .= '  <head>' . "\n";
                        $message .= '    <title>' . $this->request->post['subject'] . '</title>' . "\n";
                        $message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
                        $message .= '  </head>' . "\n";
                        $message .= '  <body>' . $strings[$i] . "\n";
                        $message .= '    <img src="<?php echo $track; ?>" width="1" height="1" />';
                        $message .= '  </body>' . "\n";
                        $message .= '</html>' . "\n";
                    
                        if(filter_var($emails[$i], FILTER_VALIDATE_EMAIL)) {
                            $mail = new Mail($this->config->get('config_mail_engine'));
                            $mail->parameter = $this->config->get('config_mail_parameter');
                            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                            $mail->setTo($emails[$i]);
                            $mail->setFrom($store_email);
                            $mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
                            $mail->setSubject(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'));
                            if(!empty($this->request->post['attachment'])) {
                                if(is_file(DIR_DOWNLOAD . $this->request->post['attachment'])) {
                                    $mail->addAttachment(DIR_DOWNLOAD . $this->request->post['attachment']);
                                }
                            }
                            if($files) {
                                foreach($files as $file) {
                                    $mail->addAttachment($file);
                                }
                            }
                            $mail->setHtml($message);
                            $mail->send();

                            $email = $emails[$i];
                            $member_id = $this->member->getId();
                            $subject = $this->request->post['subject'];
                            $body = $strings[$i];
                            $token = $uniq_id;

                            $this->model_marketing_contact->addContact($member_id, $email, $subject, $body, $token);
                        }
                    }
                }

                if($json['success']) {
                    if(is_file(DIR_DOWNLOAD . $this->request->post['attachment'])) {
                        unlink(DIR_DOWNLOAD . $this->request->post['attachment']);
                    }
                }
            }

            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }
    }

    public function template() {
        $json = array();

        $this->load->language('marketing/contact');

        $this->load->model('marketing/template');

        $template_info = $this->model_marketing_template->getTemplate($this->request->post['template_id']);

        $json = array(
            'subject'   => $template_info['subject'],
            'message'   => html_entity_decode($template_info['message'], ENT_QUOTES, 'UTF-8')
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function customerFiles() {
        $json = array();

        $this->load->model('customer/customer');

        $results = $this->model_customer_customer->getFilesByCustomerId($this->request->post['customer_id']);

        foreach($results as $result) {
            if(file_exists(DIR_DOWNLOAD . urldecode($result['filename']))) {
                $size = filesize(DIR_DOWNLOAD . urldecode($result['filename']));

                $i = 0;

                $suffix = array(
                    'B',
                    'KB',
                    'MB',
                    'GB',
                    'TB',
                    'PB',
                    'EB',
                    'ZB',
                    'YB'
                );

                while(($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }

                $json[] = array(
                    'customer_file_id'  => $result['customer_file_id'],
                    'customer_id'       => $result['customer_id'],
                    'name'              => trim(strip_tags(html_entity_decode(urldecode($result['name']), ENT_QUOTES, 'UTF-8'))),
                    'size'              => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function upload() {
        $this->load->language('customer/customer');

        $json = array();

        # Check user has permission
        if(!$this->member->hasPermission('modify', 'customer/customer')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if(!$json) {
            if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				# Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				# Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
                }
                
                # Allowed file extention types
                $allowed = array();

                $extention_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

                $filetypes = explode("\n", $extention_allowed);

                foreach($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if(!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                # Allowed file mime type
                $allowed = array();

                $mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

                $filetypes = explode("\n", $mime_allowed);

                foreach($filetypes as $filetype) {
                    $allowed[] = trim($filetype);
                }

                if(!in_array($this->request->files['file']['type'], $allowed)) {
                    $json['error']  = $this->language->get('error_filetype');
                }

                # Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($this->request->files['file']['tmp_name']);

                if(preg_match('/\<\?php/i', $content)) {
                    $json['error'] = $this->language->get('error_filetype');
                }

                # Return an upload error
                if($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('error_upload');
            }
        }

        if(!$json) {
            //$file = $filename . '.' . token(32);

            move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . 'temp/' . $filename);

            $json['filename'] = $filename;
            $json['path'] = 'temp/' . $filename;

            $json['success'] = $this->language->get('text_upload');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
