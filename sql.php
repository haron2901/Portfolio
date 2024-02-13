<?php


class sql
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public function __construct()
    {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'test';
    }
    public function insert($text)
    {
        if (strlen($text) == 0){
           echo 'нельзя создать пустое имя';
           return('zxc');
        }

        $link = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO products (name) VALUES ('$text')";

        $result = $link->query($sql);

        echo ('Пользователь успешно создан');
        return $result;
    }


    public function getAll()
    {
        $link = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        $sql = "SELECT * FROM `products`";

        $result = $link->query($sql);

        return $result;

    }

    public function delete($id)
    {
        $link = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        $sql = "DELETE FROM `products` WHERE `products`.`id` = $id;";

        $result = $link->query($sql);

        return $result;
    }



}