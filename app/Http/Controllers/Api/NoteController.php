<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Exception;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request)
    {

    }

    public function edit($id, Request $request)
    {

    }

    public function list(Request $request)
    {
        try {
            return Note::all();
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function detail($id, Request $request)
    {
        try {
            return Note::find($id);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
