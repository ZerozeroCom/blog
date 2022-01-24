<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;


abstract class Repository{
    protected $model;
    abstract public function model();
    public function __construct()
    {
        $this->model = app($this->model());
    }
    public function create($input){
        $model =$this->model->newInstance($input);
        $model->save();
        return $model;
    }
    public function  update($input,$id){
        $query =$this->model->newQuery();
        $model =$query->findOrFail($id);
        $model->fill($input);
        $model->save();
        return $model;
    }
}
