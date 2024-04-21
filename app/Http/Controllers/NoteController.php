<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Interfaces\NoteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    private NoteRepositoryInterface $noteRepositoryInterface;

    public function __construct(NoteRepositoryInterface $noteRep){
        $this->noteRepositoryInterface = $noteRep;
    }

    public function index(Request $request) {
        $data = $this->noteRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $note = $this->noteRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new NoteResource($note),'Note Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateNoteRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $note= $this->noteRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new NoteResource($note),'Note Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->noteRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Machine Delete Successful','',204);
    }



}
