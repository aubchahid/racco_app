<?php

declare(strict_types=1);

use App\Http\Livewire\Auth\LoginPage;
use App\Http\Livewire\Backoffice\ClientsPage;
use App\Http\Livewire\Backoffice\Dashboard;
use App\Models\Client;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

Route::any('/', LoginPage::class)->middleware(['guest'])->name('login');

Route::any('/logout',function(){
    return LoginService::logout();
})->name('logout');


Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::any('/dashboard',Dashboard::class)->name('dashboard');
    Route::any('/clients',ClientsPage::class)->name('clients');
});



// ? Route DEV
Route::any('/create',function(Faker $faker){
    for ($i=0; $i <350 ; $i++) { 
        Client::create([
            'uuid' => Str::uuid(),
            'type' => 'B2B',
            'name' => $faker->name(),
            'address' => $faker->address,
            'city_id' => 6,
            'plaque_id' => 2,
            'phone_no' => $faker->phoneNumber,
            'debit' => '20MB',
            'sip' => '054781'.$i.'54',
            'status' => 'Saisie',  
            'created_at' => now()->subDays(rand(1, 15)),          
        ]);
    }
});


Route::any('/test-account',function(){
   $user = User::create([
    'uuid' => Str::uuid(),
    'first_name' => 'Backoffice',
    'last_name' => 'Account',
    'phone_no' => '0547815454',
    'email' => 'b.account@neweracom.ma', 
    'password' => Hash::make('123456789'),   
   ]);

   $user->assignRole('admin');
});

Route::any('/create-role',function(){
    Role::create(['name' => 'supervisor']);
    Role::create(['name' => 'soustraitant']);
    Role::create(['name' => 'superadmin']);
    Role::create(['name' => 'controler']);
});
