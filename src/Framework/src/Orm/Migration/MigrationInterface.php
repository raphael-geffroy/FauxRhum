<?php
declare(strict_types=1);

namespace Framework\Orm\Migration;

interface MigrationInterface
{
    public function execute(Plan $plan);
}