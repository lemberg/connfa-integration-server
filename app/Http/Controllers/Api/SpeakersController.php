<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace app\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use app\Models\Speaker;
use App\Repositories\SpeakerRepository;
use App\Transformers\SpeakerTransformer;

class SpeakersController extends ApiController
{
    public function index(SpeakerRepository $speakerRepository)
    {
        $speakers = $speakerRepository->getSpeakersWithDeleted($this->since);

        return $this->response->collection($speakers, new SpeakerTransformer(), ['key' => 'speakers']);
    }

}