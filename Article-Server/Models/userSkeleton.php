<?php

class SkeletonUser {
    protected string $full_name;
    protected string $email;
    protected string $password;

    public function __construct(string $full_name, string $email, string $password) {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getFullName(): string {
        return $this->full_name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setFullName(string $full_name): void {
        $this->full_name = $full_name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}
