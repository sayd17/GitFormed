<?php

namespace App\Interfaces;
use App\Http\Requests\StoreRepositoryRequest;
use App\Http\Requests\UpdateRepositoryRequest;
use App\Models\Repository;
use App\Models\User;
Interface RepositoryRepositoryInterface 
{
    public function index();
    public function sortRepoByLatest();
    public function sortRepoByWatchers();
    public function sortRepoByOwner();
    public function getMyRepo();
    public function store(StoreRepositoryRequest $request);
    public function show(Repository $repository);
    public function update(UpdateRepositoryRequest $request, Repository $repository);
    public function destroy(Repository $repository);
}