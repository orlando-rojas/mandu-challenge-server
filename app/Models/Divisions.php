<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    use HasFactory;
    protected $fillable = ["name", "level", "collaborators_amount", "parent_division", "sub_divisions", "ambassador"];

    public function sub_divisions()
    {
        $sub_divisions = Divisions::where("parent_division", $this->id)->get();
        if (is_null($sub_divisions)) {
            return response()->json(['message' => "No subdivisions found"], 404);
        }

        return response()->json($sub_divisions)->original;
    }

    public function sub_divisions_amount()
    {
        return count($this->sub_divisions());
    }
}
