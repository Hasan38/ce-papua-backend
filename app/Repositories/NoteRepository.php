<?php

namespace App\Repositories;

use App\Interfaces\NoteRepositoryInterface;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteRepository implements NoteRepositoryInterface
{
    public function index(Request $request){


        $note = Note::when($request->input('q'), fn ($query, $search) =>
        $query->where('name','like', '%' . $search. '%')
        )->where('id',$request->input('id'))->get();
        return $note;
    }


    public function store(array $data){
       return Note::create($data);
    }

    public function update(array $data,$id){
       $get = Note::where('id' ,$id)->first();
       $get->update($data);
       return $get;
    }

    public function delete($id){
       Note::destroy($id);
    }
}
