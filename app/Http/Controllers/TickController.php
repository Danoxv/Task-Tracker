<?php

namespace App\Http\Controllers;

use App\Models\Tick;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class TickController extends BaseController
{
    public function index()
    {
        $user = User::find(Auth::id());
        $ticks = $user->ticks()->get();
        return response()->json($ticks);
    }

    //
    public function show($id)
    {
        $task = Tick::find($id);
        return response()->json($task);
    }

    //создание таска
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
            'status' => 'required',
            'checklist_id' => 'required',
        ]);
        $user = Auth::user();
        return $user->ticks()->create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
            'status' => 'required',
        ]);

        $task = Tick::findOrFail($id);
        $task->update($data);

        return response()->json($task);
    }

    public function delete(Request $request, $id)
    {
        $task = Tick::findOrFail($id);
        $task->delete();

        return 204;
    }

    public function destroy($id)
    {
        Tick::findOrFail($id)->delete();

        redirect()->back();
        return 200;
    }


    public function restore($id)
    {
        Tick::withTrashed()->findOrFail($id)->restore();

        redirect()->back();
        return 200;
    }
}
