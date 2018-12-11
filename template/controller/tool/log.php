<?php

class ControllerToolLog extends Controller
{
    private $error = array();

    public function index() {
        $this->load->language('tool/log');

        $this->document->setTitle($this->language->get('heading_title'));

        if(isset($this->session->data['error'])) {
            $data['warning_err'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } elseif(isset($this->error['warning'])) {
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

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('home/dashboard', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('tool/log', 'member_token=' . $this->session->data['member_token'], true)
        );

        $data['download'] = $this->url->link('tool/log/download', 'member_token=' . $this->session->data['member_token'], true);
        $data['clear'] = $this->url->link('tool/log/clear', 'member_token=' . $this->session->data['member_token'], true);

        $data['log'] = array();

        $file = DIR_LOGS . $this->config->get('config_error_filename');

        if(is_file($file)) {
            $size = filesize($file);

            if($size >= 3145728) {
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

                $i = 0;

                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }

                $data['warning_err'] = sprintf($this->language->get('error_warning'), basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
            }

            $handle = fopen($file, 'r+');

            $data['log'] = fread($handle, 3145728);

            fclose($handle);
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('tool/log', $data));
    }

    public function download() {
        $this->load->language('tool/log');

        $file = DIR_LOGS . $this->config->get('config_error_filename');

        if(file_exists($file) && filesize($file) > 0)  {
            $this->response->addHeader('Pragma: public');
            $this->response->addHeader('Expires: 0');
            $this->response->addHeader('Content-Description: File Transfer');
            $this->response->addHeader('Content-Type: application/octet-stream');
            $this->response->addHeader('Content-Disposition: attachment; filename="' . $this->config->get('config_name') . '_' . date('Y-m-d_H:i:s', time()) . '_error.log"');
            $this->response->addHeader('Content-Transfer-Encoding: binary');

            $this->response->setOutput(file_get_contents($file, FILE_USE_INCLUDE_PATH, null));
        } else {
            $this->session->data['error'] = sprintf($this->language->get('error_warning'), basename($file), '0B');

            $this->response->redirect($this->url->link('tool/log', 'member_token=' . $this->session->data['member_token'], true));
        }
    }

    public function clear() {
        $this->load->language('tool/log');

        if(!$this->member->hasPermission('modify', 'tool/log')) {
            $this->error['warning'] = $this->language->get('error_permission');
        } else {
            $file = DIR_LOGS . $this->config->get('config_error_filename');

            $handle = fopen($file, 'w+');

            fclose($handle);

            $this->session->data['success'] = $this->language->get('text_success');
        }

        $this->response->redirect($this->url->link('tool/log', 'member_token=' . $this->session->data['member_token'], true));
    }
}
