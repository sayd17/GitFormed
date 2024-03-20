<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
// use App\Http\Resources\UserResorce;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    // private $userRepository;

    // public function __construct(UserRepositoryInterface $userRepository){
    //     $this->$userRepository = $userRepository;
    // }

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {   
        
        $this->userRepository = $userRepository;
        
    }

    public function index()
    {
        return $this->userRepository->index();
    }

    public function softDelete(){
        return $this->userRepository->softDelete();
    }

    // soft-delete', function(){
    //     $user = User::onlyTrashed()->get();
    
    //     return $user;
    // });

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return $this->userRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->userRepository->show($user);
   }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       return $this->userRepository->update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $this->userRepository->destroy($user);
    }
}
