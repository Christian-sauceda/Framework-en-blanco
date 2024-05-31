<?php

class Request {
    public $query;
    public $post;
    public $server;

    public function __construct() {
        $this->query = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }
}
