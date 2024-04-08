<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreAreaGroupRequest;
use App\Http\Requests\UpdateAreaGroupRequest;
use App\Http\Resources\AreaGroupResource;
use App\Interfaces\AreaGroupRepositoryInterface;
use App\Models\AreaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AreaGroupController extends Controller
{
    private AreaGroupRepositoryInterface $areaGroupRepositoryInterface;

    
    public function __construct(AreaGroupRepositoryInterface $areasGroupRepositoryInterface)
    {
        $this->areaGroupRepositoryInterface = $areasGroupRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $data = $this->areaGroupRepositoryInterface->index($request);
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
    public function store(StoreAreaGroupRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $area = $this->areaGroupRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new AreaGroupResource($area),'Area Group Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $area = $this->areaGroupRepositoryInterface->getById($id);
        if(!$area){
            return ApiResponseClass::notFound();
        }
        return ApiResponseClass::sendResponse(new AreaGroupResource($area),'',200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AreaGroup $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateAreaGroupRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $area= $this->areaGroupRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new AreaGroupResource($area),'Area Group Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
         $this->areaGroupRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Area Group Delete Successful','',204);
    }

    public function list(){
        $data = $this->areaGroupRepositoryInterface->list();
        return ApiResponseClass::sendResponse($data,'',200);
    }
}
