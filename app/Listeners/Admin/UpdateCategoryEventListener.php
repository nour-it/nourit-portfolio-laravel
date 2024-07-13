<?php

namespace App\Listeners\Admin;

use App\Models\Category;
use App\Models\Image;
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

        $this->category->name        = $this->request['name'] ?? $this->category->name;
        $this->category->description = $this->request['description'] ??  $this->category->description;
        $this->category->type        = $this->type;

        $this->category->save();
        
        $this->updateIcon();
        
    }

    private function updateIcon(): void
    {
        if (isset($this->request["icon"])) {
            $this->category->images()->delete();
            $this->category->images()->create(['path' => $this->request['icon']]);
        }
        
    }
    
}
