<?php

require '../adapters/repositories/FamousRepository.php';

class CreateFamousUseCase
{
    public function __construct(private readonly FamousRepository $famousRepository) { }

    public function handle(string $id, string $name)
    {
        $famous = new Famous($id, $name);
        $this->famousRepository->store($famous);
    }
}