<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Http\Resources\MachineResource;
use App\Interfaces\MachineRepositoryInterface;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;

class MachineController extends Controller
{
    private MachineRepositoryInterface $machineRepositoryInterface;

    public function __construct(MachineRepositoryInterface $machinesRep){
      $this->machineRepositoryInterface = $machinesRep;
    }

    public function index(Request $request) {
        $data = $this->machineRepositoryInterface->index($request);
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
    public function store(StoreMachineRequest $request)
    {
        $data =$request->validated();
        DB::beginTransaction();
        try{
             $machine = $this->machineRepositoryInterface->store($data);

             DB::commit();
             return ApiResponseClass::sendResponse(new MachineResource($machine),'Machine Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $machine = $this->machineRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new MachineResource($machine),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateMachineRequest $request)
    {
        $updateData = $request->validated();
        $get = Machine::where('id' ,$id)->first();
        if(Auth::user()->hasRole('ce')){

            if(!$get || Auth::user()->area_id != $get->area_id){
                throw new HttpResponseException(response()->json([
                    "errors" => [
                        'message' => ['Anda tidak bisa merubah data mesin yg bukan di area anda, silahkan hubungi admin']
                    ]
                ], 422));
            }
        }
        DB::beginTransaction();
        try{
             $machine= $this->machineRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new MachineResource($machine),'Machine Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $get = Machine::where('id' ,$id)->first();
        if(Auth::user()->hasRole('ce')){

            if(!$get || Auth::user()->area_id != $get->area_id){
                throw new HttpResponseException(response()->json([
                    "errors" => [
                        'message' => ['Anda tidak bisa menghapus data mesin yg bukan di area anda, silahkan hubungi admin']
                    ]
                ], 422));
            }
        }
         $this->machineRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('Machine Delete Successful','',204);
    }

    public function list(){
        $data = $this->machineRepositoryInterface->list();
        return ApiResponseClass::sendResponse($data,'',200);
    }
}
