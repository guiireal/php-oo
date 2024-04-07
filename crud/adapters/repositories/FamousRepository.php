<?php

interface FamousRepository
{
    public function store(Famous $famous): void;
    public function update(Famous $famous): void;
    public function destroy(string $id): void;
    public function getById(string $id): Famous;
    public function getAll(): array;
    public function nextIdentity(): string;
}