<?php

namespace Tests\Unit;

use App\Jobs\ResizeImageJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResizeImageJobTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Bus::fake();
        Storage::fake("local");
        UploadedFile::fake()->image("image.jpg")->storeAs("upload/test/demo", "image.jpg", "local");
        ResizeImageJob::dispatch("image.png", "upload/test/demo/");
        Bus::assertDispatched(ResizeImageJob::class, function ($job) {
            return $job;
        });
    }
}
