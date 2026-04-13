<?php

namespace Api\Config;
// >> use PDO, use PDOException bec, we use namespaces, to read pdo class, pdoexception class
use PDO;
use PDOException;

// static = مش مربوط بـ object
// متخزن على مستوى الكلاس كله
// كل الكود بيشوف نفس القيمة

/*
 ال connection بيحصل مرة واحدة بس
 لو جيت تعمل Two Object من ال class 
 ساعتها يرجع نفس الـ connection --- ميعملش connection من اول و جديد
 */
class DatabaseConnection
{
    private static $connection = null;

    public static function connect()
    {
        // "معناها لو لسه معملتش connection قبل كده"
        if (self::$connection === null) {

            try {
                self::$connection = new PDO(
                    "mysql:host=localhost;dbname=e_commerce;charset=utf8mb4",
                    "root", // username
                    "", // password
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        }

        return self::$connection;
    }
}