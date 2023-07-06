<?php
class DB
{
    private static $mysqli;
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $host = "localhost";
        $user = "root";
        $pwd  = "";
        $db   = "addressBook";

        DB::$mysqli = new mysqli($host, $user, $pwd, $db);
    }

    private static function getTypes($params)
    {
        $types = '';
        foreach ($params as $params) {
            switch (gettype($params)) {
                case 'string':
                    $types .= 's';
                    break;
                case 'integer':
                    $types .= 'i';
                    break;
                case 'double':
                    $types .= 'd';
                    break;
                case 'array':
                    $types .= 'b';
                    break;
                case 'NULL':
                    $types .= 's';
                    break;
            }
        }
        return $types;
    }

    private static function query($sql, ?array $params = null)
    {
        if ($params == null) {
            $stmt = DB::$mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } else {
            $types = DB::getTypes($params);
            // die($types);
            $stmt = DB::$mysqli->prepare($sql);

            $arr = [];
            for($i = 0; $i < strlen($types); $i++){
                if (substr($types, $i, 1) != 'b'){
                    $arr[] = $params[$i];
                } else {
                    $arr[] = $params[$i][0];
                }
            }

            $stmt->bind_param($types, ...$arr);

            for($i = 0; $i < strlen($types); $i++){
                if (substr($types, $i, 1) == 'b') {
                    $stmt->send_long_data($i, $arr[$i]);
                }
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        }
        return $result;
    }

    static function select($sql, $complete, ?array $params = null)
    {
        $result = DB::query($sql, $params);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $complete($rows);
    }

    static function insert($sql, ?array $params = null)
    {
        return DB::query($sql, $params);
    }

    static function delete($sql, ?array $params = null)
    {
        return DB::query($sql, $params);
    }

    static function update($sql, ?array $params = null)
    {
        // die($sql);
        return DB::query($sql, $params);
    }

    static function call($sql, ?array $params = null)
    {
        return DB::query($sql, $params);
    }
}

$db = new DB();
