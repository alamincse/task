<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TaskRequest;
use Inertia\Response;
use App\Models\Task;
use Inertia\Inertia;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(): Response
    {
        $items = Task::with('users')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        if (! blank($items)) {
            $items->map(function ($item) {
                $item->date = $this->getDate(data_get($item, 'deadline'));
            });
        }

        return Inertia::render('Backend/Task/Index', [
            'items' => $items,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Backend/Task/Create');
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();

            Task::create($data);

            return redirect()->route('backend.tasks.index');
        } catch (\Exception $e) {
            Log::error($e);

            return back()->withErrors('Something went wrong.');
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Task $task): Response
    {
        $this->authorize('view', $task);

        $task->date = $this->getDate(data_get($task, 'deadline'));

        return Inertia::render('Backend/Task/Edit', [
            'item' => $task,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        try {
            $task->update($request->all());

            return redirect()->route('backend.tasks.index');
        } catch (\Exception $e) {
            Log::error($e);

            return back()->withErrors('Something went wrong.');
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        try {
            if ($task->delete()) {
                $assignedUserIds = $task->users->pluck('id')->toArray();

                $task->users()->detach($assignedUserIds);
            }

            return redirect()->route('backend.tasks.index');
        } catch (\Exception $e) {
            Log::error($e);

            return back()->withErrors('Something went wrong.');
        }
    }

    private function getDate($date): string
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}
