<?php

declare(strict_types=1);

use App\Http\Livewire\Auth\CheckYourEmailPage;
use App\Http\Livewire\Auth\ForgetPasswordPage;
use App\Http\Livewire\Auth\LoginPage;
use App\Http\Livewire\Auth\RecoverPasswordPage;
use App\Http\Livewire\Backoffice\ClientsPage;
use App\Http\Livewire\Backoffice\Dashboard;
use App\Http\Livewire\Backoffice\ProfileClientPage;
use App\Models\City;
use App\Models\Client;
use App\Models\Plaque;
use App\Models\Soustraitant;
use App\Models\Technicien;
use App\Models\User;
use App\Services\web\LoginService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


Route::middleware('guest')->group(function () {
    Route::any('/', LoginPage::class)->name('login');
    Route::any('/forget-password', ForgetPasswordPage::class)->name('forget-password');
    Route::any('/check-your-email', CheckYourEmailPage::class)->name('check-your-email');
    Route::any('/reset-password/{token}', RecoverPasswordPage::class)->name('password.reset');
});

Route::any('/logout', function () {
    return LoginService::logout();
})->name('logout');


Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::any('/dashboard', Dashboard::class)->name('dashboard');
    Route::any('/clients', ClientsPage::class)->name('clients');
    Route::any('/clients/{client}', ProfileClientPage::class)->name('clients.profile');
});



// ? Route DEV
Route::any('/create-user', function () {
    // $user = User::create([
    //     'uuid' => Str::uuid(),
    //     'first_name' => 'Backoffice',
    //     'last_name' => 'Account',
    //     'email' => 'b.account@neweracom.ma',
    //     'phone_no' => '0547815454',
    //     'password' => Hash::make('123456789'),
    // ]);
Role::create(['name' => 'admin' ]);
    User::find('1')->assignRole('admin');
});

Route::any('/create-soustraitant', function () {
    Soustraitant::create([
        'uuid' => Str::uuid(),
        'name' => 'NeweraCom',
    ]);
});


Route::any('/create', function (Faker $faker) {
    for ($i = 0; $i < 1000; $i++) {
        Client::create([
            'uuid' => Str::uuid(),
            'type' => 'B2C',
            'name' => $faker->name(),
            'address' => $faker->address,
            'lat' => '33.95960' . $i,
            'lng' => '-6.872' . $i . '50',
            'city_id' => rand(1, 5),
            'plaque_id' => 1,
            'phone_no' => $faker->phoneNumber,
            'debit' => '50MB',
            'sip' => '0547' . rand(30002, 40003),
            'status' => 'Saisie',
            'created_by' => Auth::user()->id,
            'created_at' => now()->subDays(rand(0, 1000)),
        ]);
    }
});


Route::any('/test-account', function () {

    for ($i = 0; $i < 10; $i++) {
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Technicien ' . $i,
            'last_name' => 'Account',
            'phone_no' => '0547815454',
            'email' => 't' . $i++ . '.account@neweracom.ma',
            'password' => Hash::make('123456789'),
        ]);

        Technicien::create([
            'soustraitant_id' => 1,
            'user_id' => $user->id,
            'planification_count' => 3,
        ]);
        $user->assignRole('technicien');
    }
});

Route::any('/create-role', function () {
    Role::create(['name' => 'technicien']);
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'soustraitant']);
    Role::create(['name' => 'supervisor']);
    Role::create(['name' => 'superadmin']);
    Role::create(['name' => 'controller']);
});


Route::any('/create-city', function () {
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.15',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.17',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.72',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.79',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.89',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.3.01',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.0.56',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.02',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.93',
        'status' => 1,
    ]);
    Plaque::create([
        'city_id' => 4,
        'code_plaque' => '15.1.30',
        'status' => 1,
    ]);
});
