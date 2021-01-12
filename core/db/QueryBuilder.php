<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        return $this->sqlSelect("select * from {$table}");
    }

    public function selectOne($table, $id)
    {
        return $this->sqlSelect("select * from {$table} where id={$id}");
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s);',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $this->sqlModify($sql, $parameters);
    }

    public function update ($table, $id, $parameters)
    {
        $setString = implode(', ', 
            array_map(function($key){
                return "$key = :$key";
            }, array_keys($parameters))
        );

        $sql = sprintf('UPDATE %s SET %s WHERE id=%s;', $table, $setString, $id);

        $this->sqlModify($sql, $parameters);
    }


    private function sqlSelect($sql) {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    private function sqlModify($sql, $parameters) {
        try
        {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } 
        catch (Exception $e)
        {
            die('Oops, something went wrong!');
        }
    }
}
