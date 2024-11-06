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
        try {
            Note::create(array_merge($request->all(), ['user_id' => $request->user()->id]));
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $note = Note::find($id);
            $note->fill($request->all());
            $new_note = $note->save();
            return $new_note;
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
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
