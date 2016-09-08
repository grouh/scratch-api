<?php

/**
 * Class DBQuery
 * Initiate DB connection through PDO
 *
 * @author Sypam <sypam@smile.fr>
 */
class DBQuery
{

    private $_DSN = null;

    private static $_instance = null;

    /**
     * DBQuery constructor.
     */
    private function __construct()
    {
        $this->_DSN = new PDO(
            'mysql:dbname=' .DB_NAME.';host=' .DB_HOST, DB_USER, DB_PASSWORD
        );
    }

    /**
     * Initiate instance and or return it
     * @return DBQuery|null
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DBQuery();
        }
        return self::$_instance;
    }

    /**
     * Return  Data Source Name to perform query
     * @return null|PDO
     */
    public function getDSN()
    {
        return $this->_DSN;
    }


}