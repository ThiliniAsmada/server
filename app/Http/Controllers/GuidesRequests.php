<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\tours;
use App\guides;
use App\tourists;

class GuidesRequests extends Controller
{
    public function tripRequests($id)
    {
        $tours = tours::where(['guide_id', '=', $id],)->get();
        return response()->json($tours);
    }
}
