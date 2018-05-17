<?php

class Conexion
{
    private $con;
    private $dns = 'mysql:host=localhost;dbname=red_social';
    private $user = 'root';
    private $pass = '12345';
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function getConnection()
    {
        return new PDO(
            $this->dns,
            $this->user,
            $this->pass,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true,
            )
        );
    }

    public function test()
    {
        try {
            $con = $this->getConnection();
            if ($con->query('select count(*) from users')) {
                return true;
            }

            $con = null;
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    private function select($sql, $params = [])
    {
        $sentence = $this->getConnection()->prepare($sql);

        if ($sentence->execute($params)) {
            return $sentence->fetchAll();
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $sql);
        }
    }

    private function alter($sql, $params = [])
    {
        $sentence = $this->getConnection()->prepare($sql);

        if ($sentence->execute($params)) {
            return $sentence->rowCount();
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $sql);
        }
    }

    private function insert($sql, $params = [])
    {
        $con = $this->getConnection();
        $sentence = $con->prepare($sql);

        if ($sentence->execute($params)) {
            return $con->lastInsertId();
        } else {
            throw new Exception('Error al ejecutar la consulta: ' . $sql);
        }
    }

    public function ejecutar($sql, $params = [])
    {
        if (strpos($sql, 'select ') === 0) {
            return $this->select($sql, $params);
        } else if (strpos($sql, 'update ') === 0 || strpos($sql, 'delete ') === 0) {
            return $this->alter($sql, $params);
        } else if (strpos($sql, 'insert ') === 0) {
            return $this->insert($sql, $params);
        }

        throw new Exception('Error de consulta ' . $sql);
    }
}
