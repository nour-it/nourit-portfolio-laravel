<?php

namespace App\Listeners\Admin;

use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCategoryEventListener
{

    private Category $category;

    private array $request;

    private string $type;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->category = $event->category;
        $this->request  = $event->request;
        $this->type     = $event->type;


        dd($this->request);
    }
}
