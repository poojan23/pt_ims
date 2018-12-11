<?php

class Document
{
    private $title;
    private $description;
    private $keywords;
    private $links = array();
    private $styles = array();
    private $scripts = array();

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function addLink($href, $rel) {
        $this->links[$href] = [
            'href'  => $href,
            'rel'   => $rel
        ];
    }

    public function getLinks() {
        return $this->links;
    }

    public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
        $this->styles[$href] = [
            'href'  => $href,
            'rel'   => $rel,
            'media' => $media
        ];
    }

    public function getStyles() {
        return $this->styles;
    }

    public function addScript($href, $position = 'footer') {
        $this->scripts[$position][$href] = $href;
    }

    public function getScripts($position = 'footer') {
        if(isset($this->scripts[$position])) {
            return $this->scripts[$position];
        } else {
            return array();
        }
    }
}
