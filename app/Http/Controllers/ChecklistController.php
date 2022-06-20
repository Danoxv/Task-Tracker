<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;


class ChecklistController extends BaseController
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $checklist = $user->checklists()->get();
        return response()->json($checklist);
    }


    public function show($id)
    {
        $task = Checklist::find($id);
        return response()->json($task);
    }

    //создание таска
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
            'task_id' => 'required',
        ]);

        $user = Auth::user();
        return $user->checklists()->create($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
        ]);

        $task = Checklist::findOrFail($id);
        $task->update($data);

        return response()->json($task);
    }

    public function destroy($id)
    {
        $deleteTask = Checklist::findOrFail($id)->delete();

        return  response()->json($deleteTask);
    }


    public function restore($id)
    {
        $restoreTask = Checklist::withTrashed()->findOrFail($id)->restore();

        return  response()->json($restoreTask);
    }
}
