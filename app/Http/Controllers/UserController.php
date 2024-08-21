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

    public function vendorIndex()
    {
        return view('vendor.index');
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate(
            array(
                'first_name'  => 'required|string',
                'last_name'   => 'nullable|string',
                'email'       => 'required|email|unique:users,email',
                'phone'       => 'nullable|string',
                'home_number' => 'nullable|string',
                'address'     => 'nullable|string',
                'age'         => 'nullable|integer',
                'bio'         => 'nullable|string',
                'gender'      => 'nullable|integer',
            )
        );

        $user = User::create(
            array(
                'name'        => $request['first_name'] . ' ' . $request['last_name'] ?? '',
                'username'    => 'user_' . uniqid(),
                'email'       => $request['email'],
                'role'        => 'patient',
                'phone'       => $request['phone'] ?? null,
                'home_number' => $request['home_number'] ?? null,
                'address'     => $request['address'] ?? null,
                'password'    => Hash::make(uniqid()),
            )
        );

        Profile::create(
            array(
                'user_id'    => $user->ID,
                'first_name' => $request['first_name'] ?? null,
                'last_name'  => $request['last_name'] ?? null,
                'address'    => $request['address'] ?? null,
                'age'        => $request['age'] ?? null,
                'bio'        => $request['bio'] ?? null,
                'gender'     => $request['gender'] ?? 1,
            )
        );

        return redirect()->route('user.create')->with('success', 'User has been added successflly');
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
