<?php

namespace app\v1\controller;

use app\v1\model\Column;
use Cassandra\Date;
use think\Controller;

class Index extends Controller
{
  public function index()
  {
    $cols = Column::select();

    return json($cols);
  }

  public function setColumn()
  {
    $name = $this->request->param()["name"];
    if (!empty($name)) {
      $user = Column::where("name", $name)->find();
      if ($user == null) {
        $user = new Column;
        $user->name = $name;
        $user->create_time = date('Y-m-d', time());
        $user->save();
        return json(["data" => "插入成功"]);
      }
      return json(["data" => "栏目已经存在"]);
    }
    return json(["data" => "name不能为空"]);
  }
}