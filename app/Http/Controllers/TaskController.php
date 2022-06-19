<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{

    // весь список тасков тек. пользователя
    public function index()
    {

        $user = User::find(Auth::id());
        $task = $user->tasks()->get();
        return response()->json($task);
    }

    //
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
//            'author_id' => 'required',
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
            'status' => 'required',
        ]);

        $task = Task::findOrFail($id);
        $task->update($data);

        return response()->json($task);
    }


    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        redirect()->back();
        return 200;
    }


    public function restore($id)
    {
        Task::withTrashed()->findOrFail($id)->restore();

        redirect()->back();
        return 200;
    }
}
