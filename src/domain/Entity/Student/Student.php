<?php

namespace Domain\Entity\Student;

use Carbon\CarbonImmutable;
use Domain\Entity\Student\ValueObject\Name;
use Domain\Entity\Student\ValueObject\Hobby;
use Domain\Entity\Student\Enum\Grade;

class Student
{
    public function __construct(
        private ?int $id,
        private Name $name,
        private Hobby $hobby,
        private Grade $grade,
        private bool $isDeleted,
        private CarbonImmutable $createdAt,
        private CarbonImmutable $updatedAt,
    ) {}

    public function withId(int $id): self
    {
        return new self(
            id: $id,
            name: $this->name,
            hobby: $this->hobby,
            grade: $this->grade,
            isDeleted: $this->isDeleted,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt
        );
    }

    public function getId(): ?int
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
