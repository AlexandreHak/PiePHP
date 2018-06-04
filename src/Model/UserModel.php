<?php
namespace Model;

use Core\Entity;
use Core\ORM;
use Core\Database;

class UserModel extends Entity
{
    private static $relations = [
        'has many' => 'history',
    ];
}