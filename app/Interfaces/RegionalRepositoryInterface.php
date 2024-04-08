<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RegionalRepositoryInterface
{
    public function index(Request $request);
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function list();
}
