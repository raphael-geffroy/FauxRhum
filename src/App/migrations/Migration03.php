<?php
declare(strict_types=1);

namespace Migrations;

use Framework\Orm\Migration\MigrationInterface;
use Framework\Orm\Migration\Plan;

class Migration03 implements MigrationInterface
{
    public function execute(Plan $plan): void
    {
        $plan->create('category')
            ->add('id','CHAR(13) PRIMARY KEY')
            ->add('name','CHAR(13)')
            ->add('articles_ids', 'VARCHAR(255)')
        ;
    }
}