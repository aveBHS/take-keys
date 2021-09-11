<?php

namespace Site\Core;

class HttpRequest
{
    protected $url;
    protected $get;
    protected $post;


    public function __construct(string $url = null)
    {
        $this->url = $url ?? $_GET['route'];
        $this->get = $_GET;
        $this->post = $_POST;
    }
    public function fetchRoute(string $regex)
    {
        preg_match($regex, $this->url, $match);
        if(!empty($match)){
            return array_slice($match, 1);
        }
        return null;
    }

    public function show(string $html)
    {
        echo $html;
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