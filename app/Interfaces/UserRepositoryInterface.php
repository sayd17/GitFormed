<?php

namespace App\Interfaces;

Interface RepositoryRepositoryInterface 
{
    public function index();
    public function store(StoreRepositoryRequest $request);
    public function show(Repository $repository);
    public function update(UpdateRepositoryRequest $request, Repository $repository);
    public function destroy(Repository $repository);
}