<?php

namespace Site\Core;

use Site\Controllers\Controller;

class HttpRequest
{
    protected $url;
    protected $get;
    protected $post;
    protected $method;


    public function __construct(string $url = null)
    {
        $this->url = $url ?? $_GET['route'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->get = $_GET;
        $this->post = $_POST;
    }
    public function fetchRoute(string $regex)
    {
        $method = explode("::", $regex);
        if(count($method) > 1) {
            $method = $method[0];
            $regex = substr($regex, strlen($method) + 2);
        } else {
            $method = "GET";
        }
        if($method == "MIXED" || $method == $this->method){
            preg_match($regex, $this->url, $match);
            if(!empty($match)){
                return array_slice($match, 1);
            }
        }
        return null;
    }

    public function show(string $html)
    {
        echo $html;
    }

    public function getUrl()
    {
        return $this->url;
    }
    public function post(string $param = null)
    {
        if(is_null($param)) return $this->post;
        return $this->post[$param];
    }
    public function get(string $param)
    {
        return $this->get[$param];
    }

    public function setHeader(string $name, string $value)
    {
        header("$name: $value");
    }
    public function setFlash(string $name, string $value)
    {
        $_SESSION["flash_".$name] = $value;
    }
    public function getFlash(string $name = null)
    {
        if(is_null($name)){
            $flashes = [];
            foreach($_SESSION as $key => $value){
                if(substr($key, 0, 6) == "flash_"){
                    $flashes[mb_substr($key, 0, -6)] = $value;
                    unset($_SESSION[$key]);
                }
            }
            return $flashes;
        } else {
            $flash = $_SESSION["flash_".$name];
            if (!is_null($flash)) {
                unset($_SESSION["flash_".$name]);
            }
            return $flash;
        }
    }

    public function returnException(Controller $exception, int $code)
    {
        header("HTTP/1.1 $code", true, $code);
        $exception->view($this, []);
        die();
    }
    public function redirect(string $url)
    {
        header("Location: $url");
        die();
    }
    public function redirect_back()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}