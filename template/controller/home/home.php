<?php

class ControllerHomeHome extends Controller
{
    public function index() {
        $this->load->language('home/home');

        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));

        $this->document->addStyle('template/view/dist/css/owl.carousel.min.css');
        $this->document->addStyle('template/view/dist/css/owl.theme.default.min.css');
        $this->document->addScript('template/view/dist/js/owl.carousel.min.js');

        if(isset($this->request->get['url'])) {
            $this->document->addLink($this->config->get('config_url'), 'canonical');
        }

        #Industries
        $this->load->model('catalog/industry');

        $data['industries'] = array();

        $industry_info = $this->model_catalog_industry->getIndustries();

        foreach($industry_info as $industry) {
            if($industry) {
                $data['industries'][] = array(
                    'name'  => $industry['name'],
                    'href'  => $this->url->link('product/industry', 'industry_id=' . $industry['industry_id'])
                );
            }
        }

        # Banners
        $this->load->model('design/banner');
        $this->load->model('tool/image');

        $data['banners'] = array();

        $results = $this->model_design_banner->getBanner(1);

        foreach($results as $result) {
            if(is_file(DIR_IMAGE . $result['image'])) {
                $data['banners'][] = array(
                    'title' => $result['title'],
                    'link'  => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], 1200, 600)
                );
            }
        }

        $data['ad_banners'] = array();

        $results = $this->model_design_banner->getBanner(2, 0, 2);

        foreach($results as $result) {
            if(is_file(DIR_IMAGE . $result['image'])) {
                $data['ad_banners'][] = array(
                    'title' => $result['title'],
                    'link'  => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], 570, 200)
                );
            }
        }

        $results = $this->model_design_banner->getBanner(3);

        foreach($results as $result) {
            $data['banner_bg'] = $this->model_tool_image->resize($result['image'], 1800, 801);
        }
        

        # Latest Products
        $this->load->model('catalog/product');

        $data['latest_products'] = array();

        $latest_products = $this->model_catalog_product->getLatestProducts(8);

        if($latest_products) {
            foreach($latest_products as $product) {
                if($product['image']) {
                    $image = $this->model_tool_image->resize($product['image'], 261, 261);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 261, 261);
                }

                $data['latest_products'][] = array(
                    'product_id'        => $product['product_id'],
                    'thumb'             => $image,
                    'name'              => $product['name'],
                    'description'       => $product['description'],
                    'price'             => $product['price'],
                    'manufacturer'      => $product['manufacturer'],
                    'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                );
            }
        }

        # Popular Products
        $this->load->model('catalog/product');

        $data['popular_products'] = array();

        $popular_products = $this->model_catalog_product->getPopularProducts(9);

        if($popular_products) {
            foreach($popular_products as $product) {
                if($product['image']) {
                    $image = $this->model_tool_image->resize($product['image'], 264, 264);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 264, 264);
                }

                $data['popular_products'][] = array(
                    'product_id'        => $product['product_id'],
                    'thumb'             => $image,
                    'name'              => $product['name'],
                    'description'       => $product['description'],
                    'price'             => $product['price'],
                    'manufacturer'      => $product['manufacturer'],
                    'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                );
            }
        }

        # Popular Focus Products
        $this->load->model('catalog/product');

        $data['focus_products'] = array();

        $focus_products = $this->model_catalog_product->getFocusProducts(2);

        if($focus_products) {
            foreach($focus_products as $product) {
                if($product['focus'] && (count($product['focus']) <= 2)) {
                    if($product['image']) {
                        $image = $this->model_tool_image->resize($product['image'], 295, 295);
                    } else {
                        $image = $this->model_tool_image->resize('no-image.png', 295, 295);
                    }

                    $data['focus_products'][] = array(
                        'product_id'        => $product['product_id'],
                        'thumb'             => $image,
                        'name'              => $product['name'],
                        'description'       => html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8'),
                        'price'             => $product['price'],
                        'manufacturer'      => $product['manufacturer'],
                        'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                    );
                }
            }
        }
        
        # Categories
        $this->load->model('catalog/category');

        $data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories(0);

        foreach($categories as $category) {
            if($category['top']) {
                if($category['image']) {
                    $image = $this->model_tool_image->resize($category['image'], 216, 216);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 216, 216);
                }

                $data['categories'][] = array(
                    'category_id'   => $category['category_id'],
                    'name'          => $category['name'],
                    'thumb'         => $image,
                    'href'          => $this->url->link('catalog/category', 'path=' . $category['category_id'])
                );
            }
        }

        # New Products
        $this->load->model('catalog/product');

        $data['new_products'] = array();

        $new_products = $this->model_catalog_product->getLatestProducts(4);

        if($new_products) {
            foreach($new_products as $product) {
                if($product['image']) {
                    $image = $this->model_tool_image->resize($product['image'], 60, 60);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 60, 60);
                }

                $data['new_products'][] = array(
                    'product_id'        => $product['product_id'],
                    'thumb'             => $image,
                    'name'              => $product['name'],
                    'description'       => $product['description'],
                    'price'             => $product['price'],
                    'manufacturer'      => $product['manufacturer'],
                    'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                );
            }
        }

        # Industries
        $data['markets'] = array();

        $markets = $this->model_catalog_industry->getIndustriesByLimit(4);

        if($markets) {
            foreach($markets as $market) {
                if($market['image']) {
                    $image = $this->model_tool_image->resize($market['image'], 60, 60);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 60, 60);
                }

                $data['markets'][] = array(
                    'industry_id'   => $market['industry_id'],
                    'name'          => $market['name'],
                    'thumb'         => $image,
                    'href'          => $this->url->link('product/industry', 'industry_id=' . $market['industry_id'])
                );
            }
        }

        # Most Viewed Products
        $this->load->model('catalog/product');

        $data['most_viewed_products'] = array();

        $most_viewed_products = $this->model_catalog_product->getPopularProducts(4);

        if($most_viewed_products) {
            foreach($most_viewed_products as $product) {
                if($product['image']) {
                    $image = $this->model_tool_image->resize($product['image'], 60, 60);
                } else {
                    $image = $this->model_tool_image->resize('no-image.png', 60, 60);
                }

                $data['most_viewed_products'][] = array(
                    'product_id'        => $product['product_id'],
                    'thumb'             => $image,
                    'name'              => $product['name'],
                    'description'       => $product['description'],
                    'price'             => $product['price'],
                    'manufacturer'      => $product['manufacturer'],
                    'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                );
            }
        }

        $data['dealers'] = $this->url->link('information/dealer');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('home/home', $data));
    }
}
 