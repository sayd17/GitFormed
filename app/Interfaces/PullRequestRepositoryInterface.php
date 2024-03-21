<?php

namespace App\Interfaces;

use App\Http\Requests\StorePullRequestRequest;

Interface PullRequestRepositoryInterface 
{
    // public function index();
    public function store(StorePullRequestRequest $request);
    // public function show(Repository $repository);
    // public function update(UpdateRepositoryRequest $request, Repository $repository);
    // public function destroy(Repository $repository);
}