<?php
declare(strict_types=1);

namespace Framework\Http;

use App\Domain\User\User;

final class Session
{
    private array $messageBag = [];

    public function __construct(){}

    public function start(): bool
    {
        return session_start();
    }

    public function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    public function get(string $name, $default = null): mixed
    {
        return $_SESSION[$name] ?? null;
    }

    public function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function all(): array
    {
        return $_SESSION;
    }

    public function remove(string $name)
    {
        unset($_SESSION[$name]);
    }

    public function addMessage(string $message): self {
        $this->messageBag[] = $message;
        return $this;
    }

    public function consumeMessages(): iterable {
        while (count($this->messageBag) > 0){
            yield array_pop($this->messageBag);
        }
    }

}