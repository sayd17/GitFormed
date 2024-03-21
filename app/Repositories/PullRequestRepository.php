<?php

namespace App\Repositories;
use App\Http\Requests\StorePullRequestRequest;
use App\Models\PullRequest;
use App\Http\Resources\PullRequestResource;
use App\Interfaces\PullRequestRepositoryInterface;

class PullRequestRepository implements PullRequestRepositoryInterface
{
    // public function index()
    // {
    //     return PullRequestResource::collection(
            
    //         PullRequest::query()->orderBy('id', 'asc')->paginate(10)
    //     );
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePullRequestRequest $request) 
    {
        $data = $request->validated();
        $pullRequest = PullRequest::create($data);
        return response(new PullRequestResource($pullRequest), 201); // created new resource on the server
    }

    /**
     * Display the specified resource.
     */
    // public function show(PullRequest $repository)
    // {
    //     return new PullRequestResource($repository);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateRepositoryRequest $request, Repository $repository)
    // {
    //     $data = $request->validated();
    //     if(isset($data['password'])){
    //         $data['password'] = bcrypt($data['password']);
    //     }

    //     $repository->update($data);

    //     return new RepositoryResource($repository);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Repository $repository)
    // {
    //     $repository->delete();

    //     return response("Successful", 204);
    // }
}