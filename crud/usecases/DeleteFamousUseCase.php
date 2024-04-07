<?php

class DeleteFamousUseCase
{
    public function __construct(private readonly FamousRepository $famousRepository) { }

    public function handle(int $id)
    {
        $this->famousRepository->destroy($id);
    }
}