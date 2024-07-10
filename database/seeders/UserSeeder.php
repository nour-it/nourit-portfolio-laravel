<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = env("MAIL_FROM_NAME");
        User::insert([
            "username"    => $username,
            "slug"        => Str::slug($username),
            "email"       => env("MAIL_FROM_ADDRESS"),
            "password"    => Hash::make(env("PASSWORD")),
            "validate_at" => Carbon::now(),
            'post'        => "Web and Mobile App developer",
            'bio'         => "
                        <p>Hi, I'm Nouroudine, a web developer with over fourth years of experience in the industry. I specialize in
                            front-end development and have a strong foundation in HTML, CSS, and JavaScript. I am also proficient in
                            popular web development framework like React.</p>
                        <p>My passion for web development extends beyond my professional work. I am an active contributor to several
                            open-source projects and enjoy experimenting with new technologies. In my free time, you can find me
                            attending hackathons or working on personal projects to hone my skills.</p>
                        <p>I'm excited to join your team and contribute to building innovative and impactful web applications.</p>
                   ",

            'about'     => "<p style=\"opacity: 1;\">In my previous role, I was responsible for building and maintaining a suite of web
                applications for a large
                e-commerce company. I worked closely with designers and product managers to ensure that the applications
                were user-friendly and met the needs of our customers. I also collaborated with back-end developers to
                integrate our front-end code with the company's API.</p>"
        ]);

        Role::insert([
            ['title' => 'ADMIN'],
            ['title' => 'USER']
        ]);

        Role::find(1)->user()->attach(User::find(1));
        Role::find(2)->user()->attach(User::find(1));
    }
}
