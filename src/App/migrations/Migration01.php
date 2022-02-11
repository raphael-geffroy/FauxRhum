<?php
declare(strict_types=1);

namespace Migrations;

use Framework\Orm\Migration\MigrationInterface;
use Framework\Orm\Migration\Plan;

class Migration01 implements MigrationInterface
{

    public function execute(Plan $plan): void
    {
        $plan->create('user')
            ->add('id','CHAR(13) PRIMARY KEY')
            ->add('username', 'varchar(255)')
            ->add('password', 'varchar(255)')
            ->add('role', 'varchar(255)');
    }
}