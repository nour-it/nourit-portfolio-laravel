<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceSeeder extends Seeder
{

    private $images = [];

    private $categories = [];

    private $services = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->images = Arr::map(
            Storage::allFiles("assets/img/service"),
            fn ($image) => ['path' => $image]
        );
        

        // l'id des categories de service commence par 6
        $this->services = Arr::map(
            [
                ["Intégration web", 6],
            ],
            fn ($service) => [
                'title' => $service[0],
                'service_category_id' => $service[1],
                'user_id' => User::first()->id,
            ]
        );

        DB::table('images')->insert($this->images);
        foreach ($this->services as $service) {
            $tmp = Service::create(['title' => $service['title'], 'user_id' => $service['user_id']]);
            $c = Category::find($service['service_category_id']);
            $c->service()->attach($tmp);
        }

        // l'id des images pour les services commence par 20
        DB::table('imageables')->insert(Arr::map([
            [1, 19],
        ], fn ($service_image) => [
            'imageable_id' => $service_image[0],
            'imageable_type' => Service::class,
            'image_id' => $service_image[1],
            "upload_at" => new DateTime(),
        ]));
    }
}
