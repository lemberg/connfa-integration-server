<?php

namespace App\Listeners;

use Carbon\Carbon;
use Dingo\Api\Event\ResponseWasMorphed;

class AddLastModifiedToResponse
{
    public function handle(ResponseWasMorphed $event)
    {
        $event->response->header('Access-Control-Allow-Origin', '*');
        $event->response->header('Access-Control-Allow-Headers', 'Accept,Origin,If-Modified-Since');

        if ($event->content) {
            $event->response->header('Last-Modified', Carbon::now()->toRfc2822String());
        }
    }
}
