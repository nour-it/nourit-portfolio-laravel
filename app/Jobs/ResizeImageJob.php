<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;

class ResizeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $dimensions = [
        'thumb' => [100, 100],
        'medium' => [300, 300],
        'large' => [500, 500],
    ];

    /**
     * Create a new job instance.
     */
    public function __construct(public string $pathToImage)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach ($this->dimensions as $key => [$width, $height]) {
            $manager = new ImageManager(
                new \Intervention\Image\Drivers\Gd\Driver()
            );
            $image = $manager->read(storage_path('app/' . $this->pathToImage));
            $image->resize($width, $height);
            // $image->brightness(1);
            // $image->place('images/watermark.png');
            $encoded = $image->toPng();
            $encoded->save(storage_path("app/example_{$key}.jpg"));
        }
    }
}
