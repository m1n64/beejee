<?php
namespace Beejee\App\Controllers;

use Beejee\App\Core\Controller;

class Nf404Controller extends Controller
{
    public function actionIndex()
    {
        $this->view->generate("404_view");
    }
}