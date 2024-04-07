<?php

class ListFamousUseCase
{
    public function __construct(private readonly FamousRepository $repository) { }

    public function handle(): array
    {
        return $this->repository->getAll();
    }
}