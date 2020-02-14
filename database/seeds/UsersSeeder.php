<?php

use Illuminate\Database\Seeder;

use App\Models\User\Project;
use App\Models\User\Role;
use App\Models\User\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $countries = \DB::connection('dbp')->table('countries')->get();
        $projects  = Project::all();
        $role_id   = Role::where('slug', 'user')->first()->id;
        $languages = \App\Models\Language\Language::limit(500)->select('id')->get();

        $user = User::create([
            'name' => 'FCBH Test Developer',
            'first_name'                     => $faker->firstName,
            'last_name'                      => $faker->lastName,
            'email'                          => $faker->unique()->safeEmail,
            'password'                       => bcrypt('password'),
            'token'                          => Str::random(64),
            'activated'                      => true,
            'signup_ip_address'              => $faker->ipv4,
            'signup_confirmation_ip_address' => $faker->ipv4,
        ]);

        $key = \App\Models\User\Key::create([
            'user_id' => $user->id,
            'key'     => $faker->bankAccountNumber,
            'name'    => 'test-key'
        ]);
        $key->access()->sync([1,2,3,4,6]);

        \App\Models\User\ProjectMember::create([
           'user_id' => $user->id,
           'project_id' => $projects->random()->id,
           'role_id' => 2
        ]);

        \App\Models\User\ProjectMember::create([
            'user_id'    => $user->id,
            'project_id' => $projects->random()->id,
            'role_id'    => 1
        ]);


        for ($user_count = 0; $user_count <= 300; $user_count++) {
            $user = User::create([
                'name'                           => $faker->unique()->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $faker->unique()->safeEmail,
                'password'                       => bcrypt('password'),
                'token'                          => Str::random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            // 50 percent chance to have a profile
            if (random_int(0, 1)) {
                $user->profile()->create([
                    'language_id'   => $languages->random()->id,
                    'bio'           => implode(' ', $faker->paragraphs(3)),
                    'address_1'     => (string) $faker->streetAddress,
                    'address_2'     => (string) $faker->buildingNumber,
                    'city'          => (string) $faker->city,
                    'state'         => (string) $faker->state,
                    'zip'           => (string) $faker->postcode,
                    'country_id'    => (string) $countries->random()->id,
                    'avatar'        => (string) $faker->imageUrl(),
                    'sex'           => collect([0,1,9])->random(),
                    'phone'         => $faker->phoneNumber,
                ]);
            }

            // 50 percent chance to have a some Social Accounts
            if (random_int(0, 1)) {
                $user->accounts()->create([
                    'project_id'       => $projects->random()->id,
                    'provider_id'      => $faker->randomElement(['facebook','github','google']),
                    'provider_user_id' => $faker->md5,
                ]);
            }

            \DB::connection('dbp_users')->table('project_members')->insert([
                'user_id'    => $user->id,
                'project_id' => $projects->random()->id,
                'role_id'    => $role_id,
                'token'      => Str::random(12)
            ]);
        }
    }
}
