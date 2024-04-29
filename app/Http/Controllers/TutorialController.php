<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreTutorialRequest;
use App\Http\Requests\UpdateTutorialRequest;
use App\Http\Resources\TutorialResource;
use App\Interfaces\TutorialRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    private TutorialRepositoryInterface $tutorialRepositoryInterface;

    public function __construct(TutorialRepositoryInterface $tutorialsRep){
      $this->tutorialRepositoryInterface = $tutorialsRep;
    }

    public function index(Request $request) {
        $data = $this->tutorialRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTutorialRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $tutor = $this->tutorialRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new TutorialResource($tutor),'Tutor Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tutor = $this->tutorialRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new TutorialResource($tutor),'',200);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateTutorialRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $tutor= $this->tutorialRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new TutorialResource($tutor),'Tutorial Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->tutorialRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Tutor Delete Successful','',204);
    }

   
}