<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function user (Request $request, User $user)
    {
        return response()->json($user);
    }

}
