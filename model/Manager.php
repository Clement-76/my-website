<?php

namespace App\Model;

abstract class Manager {

    protected $db = null;

    /**
     * @return \PDO
     * @throws \Exception if the connection to the db failed
     */
    protected function getDb() {
        if ($this->db == null) {
            try {
                $this->db = new \PDO('mysql:host=' . DB_HOST . ';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
            } catch (\PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }

        return $this->db;
    }
}

