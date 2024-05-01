<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
   
    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);

        $user = User::with('area_groups','area_groups.regionals','roles')->when($request->input('q'), fn ($query, $search) =>
        $query->where([
            ['name','like', '%' . $search. '%'],
            ['nip','like', '%' . $search. '%'],
            ['email','like', '%' . $search. '%']])
        )->paginate(perPage: $size, page: $page);
        return $user;
    }

    public function getById($id){
       $user = User::with('area_groups')->where('id',$id)->first();
       return $user;
    }

    public function store(array $data){
       return User::create($data);
    }

    public function update(array $data,$id){
      $user = User::where('id',$id)->first();
      $user->update($data);
      return $user;
    }
    
    public function delete($id){
       User::destroy($id);
    }

    public function login(array $data){
        $user = User::with(['area_groups','roles'])->where('email',$data['email'])->first();
        return $user;
    }

    public function logout() {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return $user;
    }

}
