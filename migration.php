<?php
declare(strict_types=1);

use Framework\Orm\Migration\History;
use Framework\Orm\Migration\Logger;
use Framework\Orm\Migration\MigrationFinder;
use Framework\Orm\Migration\MigrationRunner;
use Framework\Orm\Migration\PlanRunner;

require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO("mysql:host=localhost;dbname=ubouffe;charset=utf8", "superuser", "superpassword");

$logger = new Logger;

$runner = new MigrationRunner(
    new MigrationFinder(new History($pdo), "Migrations\\"),
    new PlanRunner($pdo, $logger),
    __DIR__ . '/migrations/'
);

$runner->migrate();