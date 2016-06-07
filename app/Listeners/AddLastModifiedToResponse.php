<?php

namespace App\Listeners;

use Carbon\Carbon;
use Dingo\Api\Event\ResponseWasMorphed;

class AddLastModifiedToResponse
{
    public function handle(ResponseWasMorphed $event)
    {
        if ($event->content) {
            $event->response->header('Last-Modified', Carbon::now()->toRfc2822String());
        }
    }
}