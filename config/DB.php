<?php

/**
 * Class DB
 */
class DB {

    /**
     * @param string $query
     * @return array|void
     */
    public function pdo_return_fetch_assoc_all (string $query)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=infuse", 'root', 'root');
            $res = [];
            $send = $dbh->prepare($query);
            $send->execute();
            while ($result = $send->fetchAll(PDO::FETCH_ASSOC)) {
                $res = $result;
            }
            $dbh = null;
            return $res;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @param string $query
     * @return mixed|void
     */
    public function pdo_return_fetch_column (string $query)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=infuse", 'root', 'root');
            $send = $dbh->prepare($query);
            $send->execute();
            $result = $send->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
            return $result;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @param string $query
     * @return bool|void
     */
    public function pdo_return_insert (string $query)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=infuse", 'root', 'root');
            $send = $dbh->prepare($query);
            $res = $send->execute();
            $dbh = null;
            return $res;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @param string $query
     * @return bool|void
     */
    public function pdo_return_update (string $query)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=infuse", 'root', 'root');
            $send = $dbh->prepare($query);
            $res = $send->execute();
            $dbh = null;
            return $res;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @param string $query
     * @return bool|void
     */
    public function pdo_return_delete (string $query)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=infuse", 'root', 'root');
            $send = $dbh->prepare($query);
            $res = $send->execute();
            $dbh = null;
            return $res;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>