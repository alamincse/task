<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Inertia\Response;
use App\Models\User;
use Inertia\Inertia;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(): Response
    {
        $items = User::latest()->paginate(10);

        if (! blank($items)) {
            $items->map(function ($item) {
               $item->date = Carbon::parse(data_get($item, 'created_at'))->format('Y-m-d h:m:s');
            });
        }
        return Inertia::render('Backend/User/Index', [
            'items' => $items,
        ]);
    }
}
