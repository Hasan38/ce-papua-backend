<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){
        $page = $request->input('_page', 1);
        $size = $request->input('_limit', 10);
        return User::paginate(perPage: $size, page: $page);
    }

    public function getById($id){
       return User::findOrFail($id);
    }

    public function store(array $data){
       return User::create($data);
    }

    public function update(array $data,$id){
       return User::whereId($id)->update($data);
    }
    
    public function delete($id){
       User::destroy($id);
    }
}
