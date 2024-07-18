<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablishmentController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(Auth::user()->tokenCan('establishment:show'), 403 , "you don't have permissions to perform this action.");

        $establishments = Establishment::query();

        if ($request->category && $request->has('popular')) {
            $establishments->where('category', $request->category)->orderBY('stars','DESC');
        }

        $establishments->where('category', $request->category);

        return EstablishmentResource::collection($establishments->paginate(10));
    }

    public function show(Establishment $establishment)
    {
        abort_unless(Auth::user()->tokenCan('establishment:show'), 403 , "you don't have permissions to perform this action.");

        $establishment->load('products');

        return new EstablishmentResource($establishment);
    }
}
