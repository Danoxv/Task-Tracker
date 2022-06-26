<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class TaskController extends BaseController
{

    // весь список тасков тек. пользователя
    public function index()
    {

        $user = User::find(Auth::id());
        $task = $user->tasks()->get();
        return response()->json($task);
    }


    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    //создание таска
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
            'status' => 'required',
        ]);
        $user = Auth::user();
        return $user->tasks()->create($data);

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:128',
            'text' => 'nullable|string|max:8000',
        ]);
        $data['status'] = 'open';
        $task = Task::where('id', $id)->update($data);
        return response()->json($task);
    }


    public function destroy($id)
    {
        $isTaskDeleted = Task::where('id', $id)->delete();
        return response()->json($isTaskDeleted);
    }


    public function restore($id)
    {
        $isRestoreTask = Task::withTrashed()->where('id', $id)->restore();
        return response()->json($isRestoreTask);
    }
}
