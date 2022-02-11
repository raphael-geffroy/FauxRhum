<?php
declare(strict_types=1);

namespace Migrations;

use Framework\Orm\Migration\MigrationInterface;
use Framework\Orm\Migration\Plan;

class Migration02 implements MigrationInterface
{
    public function execute(Plan $plan): void
    {
        $plan->create('article')
            ->add('id','CHAR(13) PRIMARY KEY')
            ->add('author_id','CHAR(13)')
            ->add('category_id','CHAR(13)', true)
            ->add('title', 'varchar(255)')
            ->add('content', 'text')
        ;
    }
}