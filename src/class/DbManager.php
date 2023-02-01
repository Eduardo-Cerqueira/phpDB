<?php

require_once __DIR__ . '/DbObject.php';

/**
 * La classe DbManager doit pouvoir gérer n'importe quelle table de votre base de donnée
 * 
 * Complétez les fonctions suivantes pour les faires fonctionner
 */

class DbManager
{
    private $db;

    function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // return l'id inseré
    function insert(string $sql, array $data)
    {
        $sth = $this->db->prepare($sql);
        $sth->execute($data);
        return $this->db->lastInsertId();
    }

    function insert_advanced(DbObject $dbObj)
    {
    }

    function select(string $sql, string $className, array $data = [])
    {
        $sth = $this->db->prepare($sql);
        $sth->execute($data);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $entry_data = $sth->fetchAll();

        $users = [];

        foreach ($entry_data as $user) {
            $user_db = new $className();
            foreach ($user as $key => $value) {
                $user_db->$key = $value;
            }

            array_push($users, $user_db);
        }
        return $users;
    }

    function getById(string $tableName, $id, string $className)
    {
        $sth = $this->db->prepare('SELECT * FROM ' . $tableName . ' WHERE id = :userid');
        $sth->execute([
            'userid' => $id
        ]);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $user = $sth->fetch();

        $userReturn = new $className;

        foreach ($user as $key => $value) {
            $userReturn->$key = $value;
        }
        return $userReturn;
    }

    function getBy(string $tableName, string $column, $value, string $className)
    {
        $sth = $this->db->prepare('SELECT * FROM ' . $tableName . ' WHERE ' . $column . ' = :value');
        $sth->execute([
            'value' => $value
        ]);

        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $user = $sth->fetch();

        $user_return = new $className;

        foreach ($user as $key => $value) {
            $user_return->$key = $value;
        }
        return $user_return;
    }

    function getById_advanced($id, string $className)
    {
        $tableName = '';
        switch ($className) {
            case 'ContactForm':
                $tableName = 'contact_forms';
                $sql = 'SELECT * from ' . $tableName . ' WHERE id = ?';
                break;
            case 'User':
                $tableName = 'user';
                $sql = 'SELECT * from ' . $tableName . ' WHERE id = ?';
                break;
            default:
                break;
        }

        $sth = $this->db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute([$id]);
        $data = $sth->fetch();

        $dataReturn = new $className;

        foreach ($data as $key => $value) {
            $dataReturn->$key = $value;
        }
        return $dataReturn;
    }

    function getBy_advanced(string $column, $value, string $className)
    {
        switch ($className) {
            case 'Account':
                $tableName = 'account';
                $sql = 'SELECT * from ' . $tableName . ' WHERE ' . $column . ' = :value';
                break;
            case 'Currency':
                $tableName = 'currency';
                $sql = 'SELECT * from ' . $tableName . ' WHERE ' . $column . ' = :value';
                break;
            case 'Transaction':
                $tableName = 'transaction';
                $sql = 'SELECT * from ' . $tableName . ' WHERE ' . $column . ' = :value';
                break;
            default:
                break;
        }

        var_dump($sql);
        $sth = $this->db->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute([
            'value' => $value
        ]);
        $data = $sth->fetch();

        $dataReturn = new $className;
        var_dump($data);
        foreach ($data as $key => $value) {
            $dataReturn->$key = $value;
        }
        return $dataReturn;
    }

    function removeById(string $tableName, $id)
    {
        $sth = $this->db->prepare('DELETE FROM ' . $tableName . ' WHERE id = :userid');
        $sth->execute([
            'userid' => $id
        ]);
    }

    function update(string $tableName, array $data, $id)
    {
        $sql = 'UPDATE ' . $tableName . ' SET';
        $limit = 0;
        foreach ($data as $key => $value) {
            $sql .= " $key = '$value'";

            if ($limit != count($data) - 1) {
                $sql .= ",";
            }
            $limit++;
        }

        $sql .= " WHERE id = $id ";
        try {
            $sth = $this->db->prepare($sql);
            $sth->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }

    function update_advanced(DbObject $dbObj)
    {
        $objClass = get_class($dbObj);
        $objVar = get_object_vars($dbObj);
        switch ($objClass) {
            case 'Account':
                $sql = 'UPDATE account SET';
                break;
            case 'Currency':
                $sql = 'UPDATE currency SET';
                break;
            case 'Transaction':
                $sql = 'UPDATE transaction SET';
                break;
            default:
                break;
        }

        $limit = 0;
        foreach ($objVar as $key => $value) {
            $sql .= ' ' . $key . " = '" . $value . "'";

            if ($limit != count($objVar) - 1) {
                $sql .= ",";
            }
            $limit++;
        }

        $sql .= " WHERE id = ? ";
        try {
            $sth = $this->db->prepare($sql);
            $sth->execute([$objVar["id"]]);
        } catch (Exception $e) {
            echo $e;
        }
    }
}
