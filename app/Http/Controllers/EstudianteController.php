<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstudianteResource;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index() {
        return EstudianteResource::collection(Estudiante::orderBy('id', 'DESC')->get());
    }
}
