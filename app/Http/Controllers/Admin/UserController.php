<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        $users = User::when(request()->q, function($users) {
            $users->where('name', 'like', '%'. request()->q . '%')
                ->orWhere('email', 'like', '%'. request()->q . '%');
        })->latest()->paginate(20);

        $users->appends(['q' => request()->q]);

        return inertia('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'          => 'required|unique:users|email',
            'password'      => 'required|confirmed',
        ]);

        User::create([
            'name'          => $request->name,
            'email'          => $request->email,
            'password'      => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response|ResponseFactory
     */
    public function edit($id): Response|ResponseFactory
    {
        $user = User::findOrFail($id);

        return inertia('Admin/Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,'.$user->id,
            'password'      => 'confirmed'
        ]);

        if($request->password == "") {
            $user->update([
                'name'          => $request->name,
                'email'          => $request->email,
            ]);

        } else {
            $user->update([
                'name'          => $request->name,
                'email'          => $request->email,
                'password'      => bcrypt($request->password),
            ]);

        }

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.users.index');
    }

}
