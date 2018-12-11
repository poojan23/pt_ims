<?php

class Paginator
{
    public $total = 0;
    public $page = 1;
    public $limit = 20;
    public $num_links = 9;
    public $url = '';
    public $text_first = '';
    public $text_last = '';
    public $text_next = '»';
    public $text_prev = '«';
    public $class = '';

    public function render() {
        $total = $this->total;

        if($this->page < 1) {
            $page = 1;
        } else {
            $page = $this->page;
        }

        if(!(int)$this->limit) {
            $limit = 10;
        } else {
            $limit = $this->limit;
        }

        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

        $output = '<ul class="pagination pagination-sm inline">';

        if($page > 1) {
            if($page - 1 === 1) {
                $output .= '<li><a onclick="getresult(\'' . $this->url . ($page-1) . '\', \'' . $this->class . '\')" aria-label="Previous">' . $this->text_prev . '</a></li>';
            } else {
                $output .= '<li><a onclick="getresult(\'' . $this->url . ($page-1) . '\', \'' . $this->class . '\')" aria-label="Previous">' . $this->text_prev . '</a></li>';
            }
        } else {
            $output .= '<li><a onclick="getresult(\'' . $this->url . ($page-1) . '\', \'' . $this->class .  '\')" aria-label="Previous">' . $this->text_prev . '</a></li>';
        }

        if($num_pages > 1) {
            if($num_pages <= $num_links) {
                $start = 1;
                $end = $num_pages;
            } else {
                $start = $page - floor($num_links / 2);
                $end = $page + floor($num_links / 2);

                if($start < 1) {
                    $end += abs($start) + 1;
                    $start = 1;
                }

                if($end > $num_pages) {
                    $start -= ($end - $num_pages);
                    $end = $num_pages;
                }
            }

            for($i = $start; $i <= $end; $i++) {
                if($page == $i) {
                    $output .= '<li class="active"><a>' . $i . '</a></li>';
                } else {
                    if($i === 1) {
                        $output .= '<li><a onclick="getresult(\'' . $this->url . ($i) . '\', \'' . $this->class .  '\')">' . $i . '</a></li>';
                    } else {
                        $output .= '<li><a onclick="getresult(\'' . $this->url . ($i) . '\', \'' . $this->class .  '\')">' . $i . '</a></li>';
                    }
                }
            }
        }

        if($page < $num_pages) {
            $output .= '<li><a onclick="getresult(\'' . $this->url . ($page+1) . '\', \'' . $this->class .  '\')" aria-label="Next">' . $this->text_next . '</a></li>';
        } else {
            $output .= '<li><a onclick="getresult(\'' . $this->url . ($page+1) . '\', \'' . $this->class .  '\')" aria-label="Next">' . $this->text_next . '</a></li>';
        }

        $output .= '</ul>';

        if($num_pages > 1) {
            return $output;
        } else {
            return '';
        }
    }
}
