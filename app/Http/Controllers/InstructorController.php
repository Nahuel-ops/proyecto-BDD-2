<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    public function index()
    {
        $instructores = Instructor::withCount('curso')
            ->orderBy('apellido')
            ->paginate(3);
        return view('instructores.index', compact('instructores'));
    }
    public function create()
    {
        return view('instructores.create');
    }
}
