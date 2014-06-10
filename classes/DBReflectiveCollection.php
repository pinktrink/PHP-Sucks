<?php
abstract class DBReflectiveCollection extends Collection implements DBReflection{
    protected $table;
    protected $primary;
    protected $query;
    protected $db;

    public function getData(array $data = []){
        $this->query = $this->query ?: "SELECT * FROM {$this->table}";

        if(empty($data)){

        }else{

        }
    }
}
