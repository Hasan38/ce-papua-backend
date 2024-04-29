<?php

namespace App\Repositories;

use App\Interfaces\NoteRepositoryInterface;
use App\Models\Machine;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteRepository implements NoteRepositoryInterface
{
    public function index(Request $request){


        $note = Machine::with('notes.users')->when($request->input('q'), fn ($query, $search) =>
        $query ->whereHas('notes', function($q) use ($search) {
         $q->where('title', 'like', '%' . $search . '%');
         })
        )->find($request->input('id'));
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
