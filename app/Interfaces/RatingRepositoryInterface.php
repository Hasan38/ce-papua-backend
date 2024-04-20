<?php

namespace App\Interfaces;

interface RatingRepositoryInterface
{
    public function store(array $data);
    public function delete($id);
}
