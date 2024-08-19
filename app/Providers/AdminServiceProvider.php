<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        return;
        $adminEmail = 'admin@admin.com';
        //var_dump(User::where('utype', 'ADM')->count()); die;
        // Check if there is any admin user (utype = 'ADM')
        if (! User::where('utype', 'ADM')->where('email', $adminEmail)->exists()) {
            // Create a default admin user if none exists
            User::create([
                'name' => 'admin', // Adjust the name as needed
                'email' => $adminEmail, // Adjust the email as needed
                'password' => Hash::make('Xyz123456'), // Adjust the password as needed
                'utype' => 'ADM',
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
