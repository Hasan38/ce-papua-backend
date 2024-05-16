<?php

namespace App\Repositories;

use App\Interfaces\ErrorCodeCeRepositoryInterface;
use App\Models\ErrorCodeCe;
use Illuminate\Http\Request;

class ErrorCodeCeRepository implements ErrorCodeCeRepositoryInterface
{
    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 10);

        $error = ErrorCodeCe::query()
        ->with('users')->withAvg('ratings', 'nilai')->withCount('ratings')->when($request->input('q'), fn ($query, $search) =>
        $query->where('error_code','like', '%' . $search. '%'))
        ->when($request->input('model'), fn ($query, $search) =>
        $query->where('machine_type','=',  $search))->paginate(perPage: $size, page: $page);
        return $error;
    }

    public function getById($id){
      $error = ErrorCodeCe::query()
      ->with(['users','ratings','ratings.users'])->withAvg('ratings', 'nilai')->withCount('ratings')->where('id',$id)->first();
    
      return $error;
     
    }

    public function store(array $data){
       return ErrorCodeCe::create($data);
    }

    public function update(array $data,$id){
       $get = ErrorCodeCe::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }
    
    public function delete($id){
       ErrorCodeCe::destroy($id);
    }

    
}
