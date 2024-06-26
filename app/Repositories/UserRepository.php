<?php

namespace App\Repositories;

class RepositoryRepository implements RepositoryRepositoryInterface
{
    public function index()
    {
        return RepositoryResource::collection(
            
            Repository::query()->orderBy('id', 'asc')->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepositoryRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $repository = Repository::create($data);
        return response(new RepositoryResource($repository), 201); // created new resource on the server
    }

    /**
     * Display the specified resource.
     */
    public function show(Repository $repository)
    {
        return new RepositoryResource($repository);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepositoryRequest $request, Repository $repository)
    {
        $data = $request->validated();
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $repository->update($data);

        return new RepositoryResource($repository);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repository $repository)
    {
        $repository->delete();

        return response("Successful", 204); 
    }
}