<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function update(Request $request, Task $task)
    {

        $request->validate([
            'status' => 'required'
        ]);

        $task->status = $request->status;

        $task->save();
    }
}
