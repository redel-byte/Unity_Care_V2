<?php
class Database
{
    private static ?\PDO $conn = null;

    public static function connect(): \PDO
    {
        if (self::$conn === null) {
            $dsn = "mysql:host=localhost;dbname=unity_care_clinic;charset=utf8mb4";
            try {
                self::$conn = new \PDO($dsn, 'root', '', [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (\PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}


Database::connect();


// try {
//     // Connect and fetch data
//     $db = Database::connect();
//     $stmt = $db->query("SELECT * FROM departments;");
//     $departments = $stmt->fetchAll();
    
//     // Display results
//     echo "Departments:\n";
//     echo str_repeat("-", 50) . "\n";
    
//     if (empty($departments)) {
//         echo "No departments found.\n";
//     } else {
//         foreach ($departments as $dept) {
//             print_r($dept);
//             echo str_repeat("-", 30) . "\n";
//         }
//     }
    
// } catch (\PDOException $e) {
//     echo "Database Error: " . $e->getMessage() . "\n";
// } catch (\Exception $e) {
//     echo "Error: " . $e->getMessage() . "\n";
// }
