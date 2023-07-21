<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\TaskAssignRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\TaskAssign;
use Inertia\Response;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Task;

class TaskAssignController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(Task $task): Response
    {
        $this->authorize('view', $task);

        $assignedUserIds = $task->users->pluck('id')->toArray();

        $selectedUser = User::whereIn('id', $assignedUserIds)
                            ->select(['name as label', 'id as value'])
                            ->get()
                            ->toArray();

        return Inertia::render('Backend/Task/Show', [
            'users' => $this->getUser(),
            'task' => $task,
            'selectedUser' => $selectedUser,
        ]);
    }

    public function store(TaskAssignRequest $request, Task $task): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $taskAssignedUser = $task->users;

            $oldUserId = $taskAssignedUser->pluck('id')->toArray();

            $assignUsers = data_get($request, 'user');

            $userIds = array_column($assignUsers, 'value');

            $userMails = User::whereIn('id', $userIds)->pluck('email')->toArray();

            $task->users()->detach($oldUserId);
            $task->users()->attach($userIds);

            $title = data_get($task, 'title');
            $description = data_get($task, 'description');
            $deadline = data_get($task, 'deadline');

            if (! blank($userMails)) {
                foreach  ($userMails as $mail) {
                    Mail::to($mail)
                        ->queue(new TaskAssign($title, $description, $deadline));
                }
            }

            DB::Commit();

            return redirect()->route('backend.tasks.index');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();

            return back()->withErrors('Something went wrong.');
        }
    }

    private function getUser()
    {
        return User::select(['name as label', 'id as value'])
                    ->get()
                    ->toArray();
    }
}
