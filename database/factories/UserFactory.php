<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       /* return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];*/

    //     return [
    //         'admin_name' => $faker->name,
    //         'admin_email' => $faker->unique()->safeEmail,
    //         'admin_phone' => '0989647819',
    //     'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // password
    // ];

}

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'admin_name' => $faker->name,
        'admin_email' => $faker->unique()->safeEmail,
        'admin_phone' => '0932023992',
        'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // password
    ];
});

$factory->afterCreating(Admin::class, function($admin,$faker){
    $roles = Roles::where('roles_name','user')->get();
    $admin->roles()->sync($roles->pluck('roles_id')->toArray());
});
}
