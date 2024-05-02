<?php
include "../test/ApiTest.php";
include "../BD/connexion.php";
class TodoApi
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTodos()
    {
        $stmt = $this->pdo->query("SELECT * FROM tasks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
     
    }
}

// Initialize API
$todoApi = new TodoApi($pdo);

// Output todos as JSON
header('Content-Type: application/json');
$data = $todoApi->getTodos();
echo json_encode($data);
exit();
?>
