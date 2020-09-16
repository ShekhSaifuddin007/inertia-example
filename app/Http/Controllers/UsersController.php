<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $users = User::query();
//        $search =

        if (\request()->filled('search')) {
            $users->where('name', 'LIKE', '%'.\request('search').'%')
                ->orWhere('email', 'LIKE', '%'.\request('search').'%');

        }

        //return $users = UserResource::collection(
         $users = $users->select('id', 'name', 'email')->orderByDesc('id')->paginate();
        //);

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|min:8',
        ]);
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User Created.!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'email' => "required|email|string|unique:users,email,{$user->id}",
        ]);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User Updated.!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted.!');
    }

    public function search($query)
    {
        $users = User::query()
            ->where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->select('id', 'name', 'email')
            ->orderByDesc('id')
            ->paginate();

//        return Inertia::render('Users/Index', [
//            'users' => $users
//        ]);
    }
}
