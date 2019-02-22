<?php
class DB
{
    protected $connection;
    protected $DB_user = "root";
    protected $DB_pass = null;
    protected $DB_port = "3306";
    //Database name
    protected $DB_schema = "projectsupermarkt";
    protected $DB_host = "127.0.0.1";

    public function __construct()
    {
        $connection_String = "mysql:host={$this->DB_host};port={$this->DB_port};dbname={$this->DB_schema}";
        $this->connection = new PDO(
            $connection_String, $this->DB_user, $this->DB_pass,
            array
            (
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='nl_NL',NAMES utf8"
            )
        );
    }
public function Query($SQL, $params = array())
    {
        $DB = $this->connection;
        $DB->beginTransaction();
        try
        {
            if ($params === array())
            {
                $Query = $DB->query($SQL);
            }
            else
            {
                $Query = $DB->prepare($SQL);
                if($Query->execute($params)){
                }
                else
                {
                    return null;
                }
            }
            $result = array();
            foreach ($Query as $record)
            {
                array_push($result, $record);
            }
            $DB->commit();
            $Query->closeCursor();
            return $result;
        }
        catch (PDOException $e)
        {
            $DB->rollBack();
            return $e->getMessage();
        }
    }
    public function QueryPut($SQL, $params = array())
    {
        $DB = $this->connection;
        $DB->beginTransaction();
        try
        {
            if ($params === array())
            {
                $Query = $DB->query($SQL);
            }
            else
            {
                $Query = $DB->prepare($SQL);
                if($Query->execute($params)){
                }
                else
                {
                    return null;
                }
            }
            $DB->commit();
            $Query->closeCursor();
        }
        catch (PDOException $e)
        {
            $DB->rollBack();
            return $e->getMessage();
        }
    }
}