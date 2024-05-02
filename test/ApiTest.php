<?php

require_once '../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class APITest extends PHPUnit\Framework\TestCase
{
  
    private static $pdo;
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$pdo = new PDO('mysql:host=localhost;dbname=todo', 'root', '');
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = self::$pdo->query("SELECT COUNT(*) as count FROM tasks");
        $rowCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        if ($rowCount == 0) {
        self::addFixtures();
        }
    }

    public static function addFixtures(): void
    {
        $dateNow = date('Y-m-d');
        $data = [
            ['title' => 'Développement de l\'application gestion des utilisation', 'description' => 'Cette application permettra de gérer les informations des utilisateurs, telles que leurs noms, adresses email, rôles, etc. Elle offrira également des fonctionnalités telles que l\'ajout, la suppression et la modification des utilisateurs, ainsi que la recherche et le filtrage basés sur différents critères. L\'application devra être conviviale, sécurisée et évolutive pour répondre aux besoins futurs de l\'entreprise en matière de gestion des utilisateurs.', 'created_at' => $dateNow, 'priorite' => 'Haute'],
            ['title' => 'Suivre une formation en gestion de projet PMP', 'description' => 'Cette formation fournira une compréhension approfondie des principes et des meilleures pratiques de gestion de projet selon le cadre de référence du PMI (Project Management Institute). Elle couvrira des sujets tels que la gestion de la portée, du temps, des coûts, de la qualité, des ressources, des risques, des communications, des parties prenantes, et de l\'intégration.', 'created_at' => $dateNow, 'priorite' => 'Haute'],
            ['title' => 'Aller au salle de sport', 'description' => 'Chaque dimanche, je me rends à la salle de sport pour compléter mes séances d\'activités sportives.', 'created_at' => $dateNow, 'priorite' => 'Moyenne'],
            ['title' => 'Lire un livre', 'description' => 'Commencer à lire le nouveau livre que j\'ai acheté la semaine dernière.', 'created_at' => $dateNow, 'priorite' => 'Basse']
        ];

        foreach ($data as $task) {
            $stmt = self::$pdo->prepare("INSERT INTO tasks (title, description, created_at, priorite) VALUES (:title, :description, :created_at, :priorite)");
            $stmt->execute($task);
        }
    }

    public function testGetTodos(): void
    {
        $response = file_get_contents('http://localhost/TODO-list/src/api.php');
        $tasks = json_decode($response, true);

        $this->assertNotEmpty($tasks);
    }
    
}
$myTest = new ApiTest();
$result = $myTest->setUpBeforeClass();
?>
