<?php
namespace Beejee\App\Controllers;

use Beejee\App\Core\Classes\Auth;
use Beejee\App\Core\Classes\Redirects;
use Beejee\App\Core\Classes\Str;
use Beejee\App\Core\Controller;
use Beejee\App\Models\TodoModel;
use Rakit\Validation\Validator;

class MainController extends Controller
{
    static protected int $elementsPerPage = 3;
    protected ?Validator $validator = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = new TodoModel();
        $this->validator = new Validator();
    }

    public function actionIndex()
    {
        $page = $_GET["page"] ?? 1;
        $page = intval($page);

        $sort = $_GET["sort"] ?? "";
        $sortUrl = !empty($sort) ? "&sort=" . $sort : "";

        $countTasks= $this->model->getCount();
        $pageFirst = ($page-1) * self::$elementsPerPage;

        $numbersOfPage = ceil($countTasks/self::$elementsPerPage);

        $todos = $this->model->getData($pageFirst, self::$elementsPerPage, $sort);

        $this->view->generate("main_view", [
            "tasks"=>$todos,
            "errors"=>[],
            "paginator"=>[
                "total"=>$numbersOfPage,
                "currentPage"=>$page
            ],
            "sorting"=>[
                "sortType"=>$sort,
                "sortUrlParam"=>$sortUrl
            ],
        ]);
    }

    public function actionStore()
    {
        $validation = $this->validator->make($_POST, [
            "name"=>"required",
            "email"=>"required|email",
            "text"=>"required",
        ]);

        $validation->validate();

        if (!$validation->fails()) {
            $task = $validation->getValidData();
            $this->model->storeData($task);
        }

        Redirects::redirect("/");
    }

    public function actionUpdateStatus()
    {
        if ($this->checkAuth()) return;

        $validation = $this->validator->make($_POST, [
            "is_done"=>"required"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $this->view->generateJson([], "Value must be numeric!", false);
            return;
        }

        $data = $validation->getValidData();

        $this->updateData($data);
        $this->view->generateJson([], "Task status was updated!");
    }

    public function actionUpdateTask()
    {
        if ($this->checkAuth()) return;

        $validation = $this->validator->make($_POST, [
            "text"=>"required"
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $this->view->generateJson([], "Value must be string type!", false);
            return;
        }

        $data = $validation->getValidData();

        $this->updateData($data);

        $this->view->generateJson([], "Task text was updated!");
    }

    protected function checkAuth(): bool
    {
        if (!Auth::check()) {
            $this->view->generateJson([], "You don't have permission!", false);

            return true;
        }

        return false;
    }

    protected function updateData($data)
    {
        $this->model->updateData($data, Str::clear($_GET["id"]));
    }
}