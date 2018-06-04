<?php
namespace Core;

class Entity
{
    /**
     * @var bool
     */
    public $ORM;

    /**
     * @var string
     */
    public $table;

    /**
     * @var array
     */
    public $id;

    /**
     * @var array
     */
    public $params;

    /**
     * Needed for find() ...
     * @var array
     */
    public $args = [];

    // instance of ORM and use ->save()
    public function __construct( $params = [])
    {
        $this->ORM = new ORM();
        $this->params = $params;
        $this->table = strtolower(str_replace('Model', '', basename(get_class($this))));
    }

    /**
     * @return mixed
     */
    public function save()
    {
        // [ ] check if value exist first ?
        if (!empty($this->id)) {
            return $this->ORM->update($this->table, $this->id, $this->params);
        }
        return $this->ORM->create($this->table, $this->params);
    }

    /**
     * @return mixed
     */
    public function read()
    {
        if (empty($this->id)) {
            return $this->ORM->find($this->table, $this->params);
        }
        return $this->ORM->read($this->table, $this->id);
    }

    /*-----------------------------------------------------------
    * 
    *------------------------------------------------------------/
    
    /**
     * @return mixed
     */
    public function find()
    {
        return $this->ORM->find($this->table, $this->args);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->ORM->delete($this->table, $this->id);
    }

    /**
     * DELETE this one later
     * 
     * @return bool
     */
    public function update()
    {
        return $this->ORM->update($this->table, $this->id, $this->params);
    }

    /**
     * Model Relation
     * 
     * e.g. Move has one genre
     * 
     * @return array of results
     */
    public function hasOne(string $class, $id = null)
    {
        // get table name, e.g. Model\GenreModel => genre   
        $class = strtolower(str_replace('Model', '', basename($class)));
        // assign foreign_key col name, e.g. id_genre
        $this->id['col'] = 'id_' . $class;
        
        if (!is_null($id)) {
            $this->id['val'] = $id;
        }

        return $this->ORM->read($class, $this->id);
    }

    /**
     * COME BACK HERE LATER
     * 
     * e.g. Post has many comments
     * 
     * @return array
     */
    public function hasMany($class)
    {
        // get table name, e.g. Model\GenreModel => genre   
        $class = strtolower(str_replace('Model', '', basename($class)));
        // assign foreign_key col name, e.g. id_genre
        $this->id['col'] = 'id_' . $class;

        // get class name and get {foreign key col}
        // modify orm->read() ?
        ddgps($this->id);
        // return $this->ORM->find($class, );
    }
    
}