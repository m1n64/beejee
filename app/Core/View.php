<?php

namespace Beejee\App\Core;

class View
{
    public function generateJson($data, $message = "", $success = true, $code = 200)
    {
        header("Content-Type: application/json");
        http_response_code($code);

        echo json_encode(["status"=>$success, "message"=>$message, "data"=>$data]);
    }

    public function generate($content_view, $data = null, $template_view = "template_view")
    {
        if(is_array($data)) {
            extract($data);
        }
        /*header("Content-Type: text/html; charset=utf-8");*/
        include 'app/Views/'.$template_view.".php";
    }
}