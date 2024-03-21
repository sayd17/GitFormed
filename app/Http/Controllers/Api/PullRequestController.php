<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PullRequestRepositoryInterface;
use App\Http\Requests\StorePullRequestRequest;

class PullRequestController extends Controller
{   
    private $pullRequest;

    public function __construct(PullRequestRepositoryInterface $pullRequest){
        $this->pullRequest = $pullRequest;
    }

    public function store(StorePullRequestRequest $request){
        return $this->pullRequest->store($request);
    }
}
