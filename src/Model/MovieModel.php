<?php
namespace Model;

use Core\Entity;
use Core\ORM;
use Core\Database;

class MovieModel extends Entity
{
    /**
     * @return array of details about one genre
     */
    public function genre()
    {
        return $this->hasOne(GenreModel::class);
    }
}
/**
 *  term to use:
 *  foreign key 
 */

 
/**
 * relations sql query
 * has one:
 * SELECT * FROM users INNER JOIN addresses ON addresses.user_id = users.id;
 * 
 * has many:
 * SELECT * FROM articles;
 * SELECT * FROM comments WHERE article_id IN (SELECT id FROM articles);
 * 
 * Optional:
 * belongs to:
 * SELECT * FROM addresses LEFT JOIN users ON addresses.user_id = users.id; 
 */