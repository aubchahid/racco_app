<?php

declare(strict_types=1);

use App\Http\Livewire\Auth\CheckYourEmailPage;
use App\Http\Livewire\Auth\ForgetPasswordPage;
use App\Http\Livewire\Auth\LoginPage;
use App\Http\Livewire\Auth\RecoverPasswordPage;
use App\Http\Livewire\Backoffice\AffectationsMapPage;
use App\Http\Livewire\Backoffice\AffectationsPage;
use App\Http\Livewire\Backoffice\CitiesPage;
use App\Http\Livewire\Backoffice\ClientsPage;
use App\Http\Livewire\Backoffice\Dashboard;
use App\Http\Livewire\Backoffice\PlaquesPage;
use App\Http\Livewire\Backoffice\ProfileCityPage;
use App\Http\Livewire\Backoffice\ProfileClientPage;
use App\Http\Livewire\Backoffice\ProfilePlaquePage;
use App\Http\Livewire\Backoffice\ProfileSoustraitantPage;
use App\Http\Livewire\Backoffice\RouteursPage;
use App\Http\Livewire\Backoffice\SoustraitantPage;
use App\Http\Livewire\Backoffice\StockPage;
use App\Http\Livewire\Backoffice\TechnicienPage;
use App\Models\Affectation;
use App\Models\Blocage;
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
    Route::any('/affectations', AffectationsPage::class)->name('affectations');
    Route::any('/affectations/map', AffectationsMapPage::class)->name('affectations.map');
    Route::any('/plaques',PlaquesPage::class)->name('plaques');
    Route::any('/plaques/{plaque}',ProfilePlaquePage::class)->name('plaques.profile');
    Route::any('/soustraitant',SoustraitantPage::class)->name('soustraitant');
    Route::any('/soustraitant/profile/{soustraitant}',ProfileSoustraitantPage::class)->name('soustraitant.profile');
    Route::any('/cities',CitiesPage::class)->name('cities');
    Route::any('/cities/{city}',ProfileCityPage::class)->name('cities.profile');
    Route::any('/routeurs',RouteursPage::class)->name('routeurs');
    Route::any('/techniciens',TechnicienPage::class)->name('techniciens');
    Route::any('/stock',StockPage::class)->name('stock');
});



// ? Route DEV
Route::any('/create-user', function () {
    $user = User::create([
        'uuid' => Str::uuid(),
        'first_name' => 'Backoffice',
        'last_name' => 'Account',
        'email' => 'b.account@neweracom.ma',
        'phone_no' => '0547815454',
        'password' => Hash::make('123456789'),
    ]);

    $user->assignRole('admin');
});

Route::any('/create-soustraitant', function () {
    Soustraitant::create([
        'uuid' => Str::uuid(),
        'name' => 'Optlink',
    ]);
});


Route::any('/create', function (Faker $faker) {
    for ($i = 0; $i < 120; $i++) {

        $p = rand(2, 109);
        Client::create([
            'uuid' => Str::uuid(),
            'type' => 'B2C',
            'name' => $faker->name(),
            'address' => $faker->address,
            'lat' => '33.95960' . $i,
            'lng' => '-6.872' . $i . '50',
            'city_id' => Plaque::find($p)->city->id,
            'plaque_id' => Plaque::find($p)->id,
            'phone_no' => $faker->phoneNumber,
            'debit' => '50MB',
            'sip' => '0547' . rand(885945, 985945),
            'created_at' => now()->subMonth(rand(4,9)),
            'created_by' => Auth::user()->id,
        ]);
    }
});


Route::any('/test-account', function () {

    for ($i = 10; $i < 20; $i++) {
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Technicien ' . $i,
            'last_name' => 'Account',
            'phone_no' => '0547815454',
            'email' => 't' . $i++ . '.account@neweracom.ma',
            'password' => Hash::make('123456789'),
        ]);

        Technicien::create([
            'soustraitant_id' => rand(1,2),
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
    City::create([
        'uuid' => Str::uuid(),
        'name' => 'Casablanca',
        'code' => '02',
    ]);
    City::create([
        'uuid' => Str::uuid(),
        'name' => 'Casablanca',
        'code' => '03',
    ]);
    City::create([
        'uuid' => Str::uuid(),
        'name' => 'Casablanca',
        'code' => '02',
    ]);
});


Route::any('/blocage',function(){
    Blocage::create([
        'uuid' => Str::uuid(),
        'affectation_id' => 49,
        'cause' => 'Le client n\'est pas disponible',
    ]);

    return 'Blocage Created';

});

Route::any('/planned-affectation/{id}',function($id){
    Affectation::find($id)->update([
        'status' => 'Planifié',
        'planification_date' => now(),
    ]);

    return 'Done';
});
