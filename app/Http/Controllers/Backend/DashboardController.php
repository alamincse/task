<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\Inertia;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $tasks = Task::where('user_id', Auth::id())
                    ->latest()
                    ->limit(5)
                    ->get();

        if (! blank($tasks)) {
            $tasks->map(function ($item) {
               $item->date = Carbon::parse(data_get($item, 'deadline'))->format('Y-m-d H:i:s');
            });
        }

        return Inertia::render('Backend/Dashboard/Index', [
            'tasks' => $tasks,
        ]);
    }
}
