<?php

namespace App\Repositories;

use App\Interfaces\TutorialRepositoryInterface;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialRepository implements TutorialRepositoryInterface
{
    
    public function index(Request $request){
        $page = $request->input('page', 1);
        $size = $request->input('limit', 12);
        $type = $request->input('type');
        $tutor = Tutorial::with('users')->when($request->input('q'), fn ($query, $search) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
        )->where('type', $type)->paginate(perPage: $size, page: $page);
        return $tutor;
    }

    public function store(array $data){
       return Tutorial::create($data);
    }

    public function getById($id){
        return Tutorial::with('users')->findOrFail($id);
     }

    public function update(array $data, $id){
       $get = Tutorial::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }

    public function delete($id){
       Tutorial::destroy($id);
    }
}
