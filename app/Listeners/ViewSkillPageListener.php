<?php

namespace App\Listeners;

use App\Events\ViewSkillPageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ViewSkillPageListener implements ShouldQueue
{
    public $delay = 60;

    public function handle(ViewSkillPageEvent $event): void
    {
        Log::info('Consultation des skils par ' . $event->ip);
    }

    public function shouldQueue(ViewSkillPageEvent $event): bool
    {
        return true;
    }
}
