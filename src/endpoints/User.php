<?php

namespace PH7\Api;

class User
{
    public function __construct(
        public readonly string $name,
        private string $email,
        private string $phoneNumber
    ) {
        // ...
    }

    public function create(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber
        ];
    }

    public function retrieveAll(): array
    {
        return [];
    }

    public function retrieve(int $userId): self
    {
        return $this;
    }

    public function update(): self
    {
        return $this;
    }

    public function remove(): bool
    {
        return true; // default value
    }
}