<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 3);
        $projects = Project::with('category', 'technologies')->paginate($perPage);
        return response()->json($projects);
    }
}
