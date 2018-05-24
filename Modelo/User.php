<?php

class User
{
    public static function login($login, $password)
    {
        try {
            $con = new Conexion();

            $id = $con->ejecutar('select * from users where login = :login and password = :password', [
                ':login' => $login,
                ':password' => $password
            ])[0][0];

            if ($id > 0) {
                $_SESSION['user'] = $id;
                return true;
            }

            return false;
        } catch (Exception $e) {
            echo $e->getMessage();

            return false;
        }
    }

    public static function getAuth() {
        try {
            if ($_SESSION['user']) {
                $con = new Conexion();

                return $con->ejecutar('select * from users where id = :id', [
                    ':id' => $_SESSION['user']
                ])[0];
            }

            return [];
        } catch (Exception $e) {
            return [];
        }
    }

    public static function logout() {
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function exist($user)
    {
        $con = new Conexion();

        return $con->ejecutar('select count(*) from users where login = :user', [
                ':user' => $user
            ]) === '1';
    }

    public static function create($user)
    {
        try {
            $con = new Conexion();
            return $con->ejecutar('insert into users values(default, :name, :login, :password)', [
                ':name' => $user['name'],
                ':login' => $user['login'],
                ':password' => $user['pass']
            ]);
        } catch (Exception $e) {
            return false;
        }
    }
}