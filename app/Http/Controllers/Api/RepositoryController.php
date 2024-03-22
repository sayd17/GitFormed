<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepositoryRequest;
use App\Http\Requests\UpdateRepositoryRequest;
use App\Models\Repository;
use App\Http\Resources\RepositoryResource;
use App\Interfaces\RepositoryRepositoryInterface;
use App\Models\User;

class RepositoryController extends Controller
{
    private $repositoryRepository;

    public function __construct(RepositoryRepositoryInterface $repositoryRepository){
        $this->repositoryRepository = $repositoryRepository;
    }

    public function index()
    {
        return $this->repositoryRepository->index();
    }



    public function getMyRepo(){
        // dd('alsdfkj');
        // $owner = request('username');
        
        return $this->repositoryRepository->getMyRepo();
    }


    public function guest(){
        return $this->repositoryRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepositoryRequest $request)
    {
        return $this->repositoryRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Repository $repository)
    {
        return $this->repositoryRepository->show($repository);
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(UpdateRepositoryRequest $request, Repository $repository)
    {
        return $this->repositoryRepository->update($request, $repository);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repository $repository)
    {
        return $this->repositoryRepository->destroy($repository);
    }
}
