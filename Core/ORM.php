<?php
namespace Core;

use PDO;

class ORM
{
    /**
     * @var object
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    } 

    /**
     * @param array $fields mustn't be empty
     * 
     * @return int lastInsertId
     */
    public function create($table, $fields)
    {
        $sql = "INSERT INTO $table";

        $columnsPart = '(' . implode(', ', array_keys($fields)) . ')';
        $fieldsMark = array_map(function ($key) {
            return ':' . $key;
        }, array_keys($fields));
        $valuesPart = 'VALUES (' . implode(', ', $fieldsMark) . ')';
        
        $sql = "$sql $columnsPart $valuesPart";
        $stmt = $this->pdo->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * [ ] pagination
     */
    public function read($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE {$id['col']} = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id['val'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($table, $id, $fields)
    {
        $sql = "UPDATE $table SET ";
        $updatedFields = [];

        foreach ($fields as $key => $value) {
            $updatedFields[] = "{$key} = :{$key}";
        }

        $sql .= implode(', ', $updatedFields) . " WHERE {$id['col']} = :id";
        
       
        $stmt = $this->pdo->prepare($sql);
        
        foreach ($fields as $key => $value) {
            $stmt->bindValue(':' . $key, $value, ctype_digit($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $stmt->bindValue(':id', $id['val'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE {$id['col']} = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id['val'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function find($table, $params = [
        'WHERE' => 1,
        // 'IN' => (SELECT * FROM movies)
        //'ORDER BY' => 'ASC', // e.g. id ASC
        // 'LIMIT' => '1, 20'
    ])
    {
        /**
         * params with where key must exist if order by and limit key exist
         */
        $sql =  "SELECT * FROM {$table}";
        // change here for where clause
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                $sql .= " $key $value";
            }
        }
        
        $stmt = $this->pdo->prepare($sql);
        
        // bind values|params here later ?
        $stmt->execute();
        // come back here later
        return $stmt->rowCount() >= 1 ? $stmt->fetchAll(PDO::FETCH_OBJ) : false;
    }
}

/** EXAMPLES
if (!empty($params)) {
    foreach ($params as $key => $value) {
        if (!empty($value)) {
        $whereConditions[] = "{$key} = :{$key}";
        }
    }
    $whereClause = " WHERE " . implode(' AND ', $whereConditions);
}
 
if (!empty($params)) {
    foreach ($params as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
}
 */