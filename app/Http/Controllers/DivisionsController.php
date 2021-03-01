<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{

    public function index()
    {
        $divisions = Divisions::paginate(3);

        return response()->json($divisions->items());
    }

    public function show($id)
    {
        $division = Divisions::find($id);
        if (is_null($division)) {
            return response()->json(['message' => "Division not found"], 404);
        }
        return response()->json(Divisions::find($id), 200);
    }

    public function store(Request $request)
    {
        $division = Divisions::create($request->all());
        return response($division, 201);
    }

    public function update(Request $request, $id)
    {
        $division = Divisions::find($id);
        if (is_null($division)) {
            return response()->json(['message' => "Division not found"], 404);
        }
        $division->update($request->all());
        return response($division, 200);
    }

    public function destroy(Request $request, $id)
    {
        $division = Divisions::find($id);
        if (is_null($division)) {
            return response()->json(['message' => "Division not found"], 404);
        }
        $division->delete();
        return response()->json(null, 204);
    }

    public function get_subdivisions($id)
    {
        $sub_divisions = Divisions::find($id)->sub_divisions();
        return response()->json($sub_divisions);
    }

    public function get_subdivisions_count($id)
    {
        $sub_divisions_amount = Divisions::find($id)->sub_divisions_amount();
        return $sub_divisions_amount;
    }
}
