<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
   
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
      $user = User::where('id',$id)->first();
      
      $data['password'] = Hash::make($data['password']);
      $user->update($data);
      return $user;
    }
    
    public function delete($id){
       User::destroy($id);
    }
}
