<?php

namespace Beejee\App\Models;

use Beejee\App\Core\Model;

class TodoModel extends Model
{
    protected $tableName = "todo_list";

    public function getData($limit = 0, $offset = 0, $sort = "")
    {
        $todos = parent::getData($limit, $offset, $sort);

        return $todos;
    }



}