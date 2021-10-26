<?php

namespace Site\Core;

use Site\Controllers\Controller;

class HttpRequest
{
    protected $url;
    protected $get;
    protected $post;
    protected $body;
    protected $method;


    public function __construct(string $url = null)
    {
        $this->url = $url ?? $_GET['route'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->get = $_GET;
        $this->post = $_POST;
        $this->body = file_get_contents("php://input");
    }
    public function __get(string $param)
    {
        switch ($param){
            case "body":
                return $this->body;
            case "method":
                return $this->method;
            case "url":
                return $this->url;
            default:
                return null;
        }
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

    public function getMethod()
    {
        return $this->method;
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
    public function get(string $param = null)
    {
        if(is_null($param)) return $this->get;
        return $this->get[$param];
    }
    public function json(string $param = null)
    {
        $json = json_decode($this->body, true);
        if(!is_null($json)){
            if(!is_null($param)){
                return $json[$param] ?? null;
            } else {
                return $json;
            }
        } else {
            return null;
        }
    }

    public function getCookie(string $param = null, bool $decode = false)
    {
        if(is_null($param)) return $_COOKIE;
        if(empty($_COOKIE[md5("cookie_".$param)])) return null;
        if($decode) return base64_decode($_COOKIE[md5("cookie_".$param)], true);
        return $_COOKIE[md5("cookie_".$param)];
    }
    public function setCookie(string $name, $value, bool $encode = false, int $timeout = 0): bool
    {
        if(gettype($value) != "string" && gettype($value) != "integer")
            $value = json_encode($value);
        if($encode)
            $value = base64_encode($value);
        $name = md5("cookie_".$name);
        return setcookie($name, strval($value), $timeout, "/");
    }

    public function setHeader(string $name, string $value)
    {
        header("$name: $value");
    }
    public function getHeader(string $name)
    {
        $name = strtoupper(str_replace("-", "_", $name));
        return $_SERVER["HTTP_{$name}"];
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
        $this->redirect($_SERVER['HTTP_REFERER'] ?? "/");
    }
}