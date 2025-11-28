<?php

namespace App\Http\Controllers;

use App\Services\indexServices;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function convertDocToPdfAction(Request $request) {
        return indexServices::convertDocToPdfAction($request);
    }
}
