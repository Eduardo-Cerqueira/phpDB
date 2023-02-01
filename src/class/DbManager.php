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
        $objClass = get_class($dbObj);
        $objVar = get_object_vars($dbObj);
        $sql = 'INSERT INTO ' . strtolower($objClass) . ' (';
        $limit = 0;
        foreach ($objVar as $key => $value) {
            if (!empty($dbObj->$key)) {
                $sql .= $key ;

                if ($limit != count($objVar) - 1) {
                    $sql .= ",";
                }
                $limit++;
            }
        }

        $limit = 0;

        $sql .= ') VALUES (';

        $limit = 0;
        foreach ($objVar as $key => $value) {
            $sql .= " ' " . $value . " ' ";
            if (!empty($dbObj->$key)) {
                if ($limit != count($objVar) - 1) {
                    $sql .= ",";
                }
                $limit++;
            }
        }

        $sql .= ' )';

        try {
            $sth = $this->db->prepare($sql);
            $sth->execute();
        } catch (Exception $e) {
            echo $e;
        }
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
        $sql = 'SELECT * from ' . strtolower($className) . ' WHERE id = ?';

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
        $sql = 'SELECT * from ' . strtolower($className) . ' WHERE ' . $column . ' = :value';

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
        $sql = 'SELECT * from ' . strtolower($objClass) . ' SET';

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
