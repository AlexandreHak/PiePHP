<?php
namespace Model;

use Core\entity;

class genreModel extends entity
{
    public function movies()
    {
        return $this->hasMany(MovieModel::class);
    }
    
}