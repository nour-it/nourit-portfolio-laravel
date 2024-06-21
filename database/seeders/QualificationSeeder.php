<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Qualification;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QualificationSeeder extends Seeder
{


    private $images = [];

    private $categories = [];

    private $qualifications = [];

    private $addresses = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->images = Arr::map(
            Storage::allFiles("assets/img/qualification"),
            fn ($image) => ['path' => $image]
        );
        $this->categories = Arr::map(
            ['Education', 'Experience'],
            fn ($category) => [
                'name' => $category,
                "type" => Qualification::class,
            ]
        );

        $this->addresses = Arr::map([
            ["Togo", 'Lome', "CPAP"]
        ], fn ($address) => [
            'country' => $address[0],
            'city'    => $address[1],
            'company' => $address[2]
        ]);

        // l'id des categories de service commence par 7
        $this->qualifications = Arr::map(
            [
                ["Scientific secondary school diploma", 7, new DateTime("01/01/2015"), new DateTime("01/01/2019"), 1],
            ],
            fn ($qualification) => [
                'name'                      => $qualification[0],
                'start_at'                  => $qualification[2],
                'end_at'                    => $qualification[3],
                'qualification_category_id' => $qualification[1],
                'address_id'                => $qualification[4],
                'user_id'                   => User::first()->id,
            ]
        );

        // DB::table('images')->insert($this->images);
        Category::insert($this->categories);

        foreach ($this->qualifications as $key => $qualification) {
            $tmp = Qualification::create([
                'name'     => $qualification['name'],
                'user_id'  => $qualification['user_id'],
                'start_at' => $qualification['start_at'],
                'end_at'   => $qualification['end_at'],
            ]);
            $tmp->category()->attach($qualification['qualification_category_id']);
            $tmp->address()->create($this->addresses[$key]);
            $tmp->address_id = $key + 1;
            $tmp->save();
        }



        // l'id des images pour les qualifications commence par 20
        // DB::table('imageables')->insert(Arr::map([
        //     [1, 20],
        // ], fn ($qualification_image) => [
        //     'imageable_id'   => $qualification_image[0],
        //     'imageable_type' => Qualification::class,
        //     'image_id'       => $qualification_image[1],
        //     "upload_at"      => new DateTime(),
        // ]));
    }
}
