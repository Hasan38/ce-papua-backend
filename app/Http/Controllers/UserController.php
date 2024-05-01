<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $usersRepositoryInterface){
        $this->userRepositoryInterface = $usersRepositoryInterface;
    }

    public function index(Request $request) {
        $data = $this->userRepositoryInterface->index($request);
        return ApiResponseClass::sendResponse($data,'',200);
    }

    public function store(StoreUserRequest $request){

        $data = $request->validated();

        try{
            $user = $this->userRepositoryInterface->store($data);

            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user),'User Create Successful',201);
        }
        catch (Exception $e){
            dd($e);
        }

    }

    public function login(LoginUserRequest $request){
        $data = $request->validated();
        $auth = $this->userRepositoryInterface->login($data);
        if(!$auth || !Hash::check($data['password'], $auth->password)){
            return ApiResponseClass::Unauthorized('email or password wrong');
        }       
        $token = $auth->createToken('ce-app')->plainTextToken;
        
        $datas = [
            'id' => $auth->id,
            'name' => $auth->name,
            'email' => $auth->email,
            'nip' =>$auth->nip,
            'address' => $auth->address,
            'phone' => $auth->phone,
            'token' => $token,
            'area_id' => $auth->area_groups->id,
            'area_name' => $auth->area_groups->name,
            'avatar' => $auth->avatar,
            'status' => $auth->status,
            'roles' => $auth->roles
        ];
           
        return ApiResponseClass::sendResponse($datas, 'Login Successful',201);
    }

    public function show($id)
    {
        $auth = $this->userRepositoryInterface->getById($id);
        if(!$auth){
            return ApiResponseClass::Unauthorized('Unauthorize');
        }

        $datas = [
            'name' => $auth->name,
            'email' => $auth->email,
            'nip' =>$auth->nip,
            'address' => $auth->address,
            'phone' => $auth->phone,
            'area_id' => $auth->area_groups->id,
            'area_name' => $auth->area_groups->name
        ];
        return ApiResponseClass::sendResponse(new UserResource($datas),'',201);
        
    }

    public function update($id, UpdateUserRequest $request)
    {
        $updateData = $request->validated();
        DB::beginTransaction();
        try{
             $region= $this->userRepositoryInterface->update($updateData,$id);

             DB::commit();
             return ApiResponseClass::sendResponse(new UserResource($region),'User Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->userRepositoryInterface->delete($id);
         return ApiResponseClass::sendResponse('User Delete Successful','',204);
    }

    public function logout(){
        $this->userRepositoryInterface->logout();
        return ApiResponseClass::sendResponse('Logout','',200);
    }
    
}
