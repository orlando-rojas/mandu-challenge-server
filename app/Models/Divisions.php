<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    use HasFactory;
    protected $fillable = ["name", "level", "collaborators_amount", "parent_division", "ambassador"];

    public function sub_divisions()
    {
        $sub_divisions = Divisions::where("parent_division", $this->name)->get();
        if (is_null($sub_divisions)) {
            return response()->json(['message' => "No subdivisions found"], 404);
        }

        return response()->json($sub_divisions)->original;
    }

    public function sub_divisions_amount()
    {
        $sub_divisions = $this->sub_divisions();
        if (is_null($sub_divisions)) {
            return 0;
        }
        return count($this->sub_divisions());
    }
}
