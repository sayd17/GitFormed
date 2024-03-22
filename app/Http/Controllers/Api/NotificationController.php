<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function index(){
        return NotificationResource::collection(

            Notification::query()->orderBy('id', 'desc')->paginate(10)
        ); 

    }
}
