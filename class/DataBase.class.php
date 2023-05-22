<?php
abstract class DataBase 
{
    const ORACLE = 1;
    const SQL_SERVER = 2;
    const SQL_SERVER_USUARIO = 3;

    public static function getDatabaseObject($_type)
    {
        switch($_type)
        {
                case DataBase::ORACLE:
                        require_once('OracleDatabase.class.php');
                        return new OracleDatabase();
                break;
                case DataBase::SQL_SERVER:
                        require_once('SQLServerDatabase.class.php');
                        return new SQLServerDatabase();
                break;
                case DataBase::SQL_SERVER_USUARIO:
                        require_once('UsuarioDatabase.class.php');
                        return new UsuarioDatabase();
                break;
                default:
                        require_once('SQLServerDatabase.class.php');
                        return new SQLServerDatabase();
                break;
        }
    }
}
?>