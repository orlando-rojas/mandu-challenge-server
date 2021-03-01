<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{

    public function index()
    {
        $divisions = Divisions::all();

        return response()->json($divisions);
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
        if (!is_null($request->parent_division)) {
            $valid = $this->validate_parent_division($request);
            if (!$valid) {
                return response()->json(['message' => "Invalid parent division"], 404);
            }
        }
        $division = Divisions::create($request->all());
        return response($division, 201);
    }

    public function update(Request $request, $id)
    {
        if (!is_null($request->parent_division)) {
            $valid = $this->validate_parent_division($request);
            if (!$valid) {
                return response()->json(['message' => "Invalid parent division"], 404);
            }
        }
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

    public function validate_parent_division($req)
    {
        $parentd = $req->parent_division;
        if (is_null(Divisions::where("name", $parentd)->first())) {
            return false;
        }
        return true;
    }
}
