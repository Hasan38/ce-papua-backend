<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface TutorialRepositoryInterface
{
    public function index(Request $request);
    public function store(array $data);
    public function getById($id);
    public function update(array $data,$id);
    public function delete($id);
}
