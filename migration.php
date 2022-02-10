<?php
declare(strict_types=1);

use Framework\Orm\Migration\History;
use Framework\Orm\Migration\Logger;
use Framework\Orm\Migration\MigrationFinder;
use Framework\Orm\Migration\MigrationRunner;
use Framework\Orm\Migration\Plan;
use Framework\Orm\Migration\PlanRunner;

require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('sqlite:'.__DIR__.'/data.db');

$logger = new Logger;
try {
    $pdo->query("select * from migration_status")
        ->execute();
}catch (PDOException) {
    $sql = (new Plan)->create('migration_status')
        ->add('migration_version','VARCHAR(255)')->getSQL();
    $pdo->query($sql);
}
$runner = new MigrationRunner(
    new MigrationFinder(new History($pdo), "Migrations\\"),
    new PlanRunner($pdo, $logger),
    __DIR__ . '/src/App/migrations/'
);

$runner->migrate();