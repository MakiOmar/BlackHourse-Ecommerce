<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'account_type' => 'required|string|in:customer,vendor,admin',
        ]);
        switch ($validatedData['account_type']) {
            case 'admin':
                $utype = 'ADM';
                break;

            case 'vendor':
                $utype = 'VDR';
                break;

            default:
                $utype = 'USR';
                break;
        }
        unset($validatedData['account_type']);
        $validatedData['utype'] = $utype;
        $user = User::create($validatedData);

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

        $user = Auth()->user();

        if ($user && $user->utype === 'ADM') {
        }
        return view('admin.users.create', compact('user'));
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
        $authUser = Auth()->user();
        if ($authUser) {
            $user = $authUser;
            if ($authUser->utype === 'ADM') {
                $edit = 'admin.users.edit';
                // Find the user by ID
                $user = User::find($id);
            } elseif ($authUser->utype === 'VDR') {
                $edit = 'vendor.account';
            } else {
                $edit = 'customer.account';
            }
        }
        if ($user) {
            return view($edit, compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'account_type' => 'required|string|in:customer,vendor,admin',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        switch ($request->account_type) {
            case 'admin':
                $utype = 'ADM';
                break;

            case 'vendor':
                $utype = 'VDR';
                break;

            default:
                $utype = 'USR';
                break;
        }
        $user->utype = $utype;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
