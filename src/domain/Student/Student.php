<?php

namespace Domain\Student;

use Carbon\CarbonImmutable;
use Domain\Student\ValueObject\Name;
use Domain\Student\ValueObject\Hobby;
use Domain\Student\Enum\Grade;

class Student
{
    public function __construct(
        private string $id,
        private Name $name,
        private Hobby $hobby,
        private Grade $grade,
        private bool $isDeleted,
        private CarbonImmutable $createdAt,
        private CarbonImmutable $updatedAt,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getHobby(): Hobby
    {
        return $this->hobby;
    }

    public function getGrade(): Grade
    {
        return $this->grade;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function getCreatedAt(): ?CarbonImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?CarbonImmutable
    {
        return $this->updatedAt;
    }
}
