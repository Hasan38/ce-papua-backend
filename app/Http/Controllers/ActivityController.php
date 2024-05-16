<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    private ActivityRepositoryInterface $activityRepositoryInterface;

    
    public function __construct(ActivityRepositoryInterface $activityRepositoryInterface)
    {
        $this->activityRepositoryInterface = $activityRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
      
            $data = $this->activityRepositoryInterface->index($request);
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
    public function store(StoreActivityRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $activity = $this->activityRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new ActivityResource($activity),'Activity Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $activity = $this->activityRepositoryInterface->getById($id);
        if(!$activity){
            return ApiResponseClass::notFound();
        }
        return ApiResponseClass::sendResponse(new ActivityResource($activity),'',200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateActivityRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
            $activity= $this->activityRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new ActivityResource($activity),'Activity Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
         $this->activityRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Activity Delete Successful','',204);
    }

    public function getMachine(Request $request){
        $data = $this->activityRepositoryInterface->getMachine($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

}
