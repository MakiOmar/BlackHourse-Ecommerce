<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }
    public function list()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }
    public function actions(Request $request, $user_id)
    {
        switch ($request->action) {
            case 'block':
                return $this->blockUser($user_id);
                break;

            case 'unblock':
                return $this->unBlockUser($user_id);
                break;

            default:
                return;
                break;
        }
    }
    public function blockUser($user_id)
    {
        // Find the user by ID
        $user = User::find($user_id);

        // Check if the user exists
        if ($user) {
            // Update the account status to 'blocked'
            $user->account_status = 'blocked';
            $user->save();
            return redirect()->back()->with('success', 'User has been blocked!');
        }
    }
    public function unBlockUser($user_id)
    {
        // Find the user by ID
        $user = User::find($user_id);

        // Check if the user exists
        if ($user) {
            // Update the account status to 'blocked'
            $user->account_status = 'allowed';
            $user->save();
            return redirect()->back()->with('success', 'User has been allowed!');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
