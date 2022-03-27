<?php

namespace App\Repositories;
    
use Illumanate\DataBase\Eloquement\Model;

abstract class BaseRepository
{
    protected $Model;
    
    public function __construct()
    {
        $this -> Model = app($this -> getModelClass());
    }
    
    abstract protected function getModelClass();
        
    protected function startQuery()
    {
        return clone $this -> Model;
    }
}