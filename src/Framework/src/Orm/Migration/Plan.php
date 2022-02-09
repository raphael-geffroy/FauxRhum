<?php
declare(strict_types=1);

namespace Framework\Orm\Migration;

final class Plan
{
    private const MODE_CREATE = 1;
    private const MODE_ALTER = 2;
    private const MODE_DROP = 3;
    private const templates = [
        self::MODE_CREATE => "CREATE TABLE %s (%s)",
        self::MODE_ALTER => "ALTER TABLE %s %s",
        self::MODE_DROP => "DROP TABLE %s%s",
    ];

    private string $name = "";
    private int $action = self::MODE_CREATE;
    private array $fields = [];

    public function create(string $table): self {
        return $this->do($table, self::MODE_CREATE);
    }

    public function add(string $fieldName, string $type): self {
        $fieldName = $this->action === self::MODE_ALTER ? "ADD $fieldName" : $fieldName;
        $this->fields[$fieldName] = $type . ' NOT NULL';
        return $this;
    }

    public function id(): self {
        $this->fields['id'] = 'INT PRIMARY KEY AUTO_INCREMENT';
        return $this;
    }

    public function getSQL(): string {
        $template = self::templates[$this->action];
        $instructions = array_map(
            fn($name, $type): string => "$name $type",
            array_keys($this->fields),
            $this->fields
        );
        return sprintf(
            $template,
            $this->name,
            implode(", ", $instructions)
        );
    }

    public function alter(string $table): self {
        return $this->do($table, self::MODE_ALTER);
    }

    public function change(string $fieldName, string $type): self {
        $this->fields["MODIFY $fieldName"] = $type . ' NOT NULL';
        return $this;
    }

    public function rename(string $old, string $new, string $type): self {
        $this->fields["CHANGE $old $new"] = $type . ' NOT NULL';
        return $this;
    }

    public function drop(string $table): self {
        return $this->do($table, self::MODE_DROP);
    }

    private function do(string $table, int $action): self {
        $this->action = $action;
        $this->name = $table;
        return $this;
    }
}