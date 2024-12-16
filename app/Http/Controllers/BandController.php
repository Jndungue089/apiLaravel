<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;

class BandController extends Controller
{
    //
    public function index()
    {
        $bands = Band::all();
        return $bands ? response()->json($bands, 200) : abort(404);
    }
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:20',
                'gender' => 'required| max:50'
            ]);

            $band = Band::create([
                'name' => $validated['name'],
                'gender' => $validated['gender']
            ]);

            return response()->json(['message' => 'Banda cadastrada com sucesso!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Banda não cadastrada!'], 401);
        }
    }
    public function show($id)
    {
        $band = Band::find($id);
        return $band ? response()->json($band, 200) : abort(404);
    }
    public function update(Request $request, $id)
    {
        $band = Band::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:20',
            'gender' => 'string|max:50'
        ]);
        $band->update(array_filter([
            'name' => $validated['name'],
            'gender' => $validated['gender']
        ]));
        return response()->json(['message' => 'Banda atualizada com sucesso'], 200);
    }

    public function delete($id)
    {
        $band = Band::findOrFail($id);
        $band->delete();
        return response()->json(['message' => 'Banda deletada com sucesso']);
    }
}
