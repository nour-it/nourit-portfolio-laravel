<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Psy\Command\HistoryCommand;

class ResizeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private string $uploadPath = "upload/";

    private array $dimensions = [
        'thumb'  => [100, 100],
        'medium' => [300, 300],
        'large'  => [500, 500],
    ];

    private string $input;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $name, public ?string $folder)
    {
        if (NULL !== $this->folder) {
            $this->input = storage_path('app/' . $this->name);
        } else {
            $this->input = storage_path('app/' . $this->uploadPath . $this->name);
        }
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
            $image = $manager->read($this->input);
            $image->resize($width, $height);
            // $image->brightness(1);
            // $image->place('images/watermark.png');
            $encoded = $image->toPng();
            $encoded->save(storage_path("app/" . $this->folder . "{$key}_{$width}x{$height}.jpg"));
        }
    }
}
