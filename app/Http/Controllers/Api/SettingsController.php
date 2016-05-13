<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\SettingsRepository;
use App\Transformers\SettingsTransformer;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SettingsController extends ApiController
{
    public function index(SettingsRepository $repository)
    {
        $settings = $repository->getSettingsWithDeleted($this->since);
        $this->checkModified($settings);

        $transformer = new SettingsTransformer();

        return $transformer->transform($settings);
    }

    public function show($setting, SettingsRepository $repository)
    {
        $value = $repository->getByKeyWithDeleted($setting, $this->since);
        $this->checkModified($value);

        return $this->response->array([$setting => $value]);
    }

    public function getTwitter(SettingsRepository $repository)
    {
        $html = $repository->getByKeyWithDeleted('twitterWidget', $this->since);
        $search_query = $repository->getByKeyWithDeleted('twitterSearchQuery', $this->since);

        if (!$html && !$search_query && $this->request->hasHeader('If-Modified-Since')) {
            throw new HttpException(304);
        }

        $data = [];

        if ($html) {
            $data['twitterWidgetHTML'] = $html->value;
        }

        if ($search_query) {
            $data['twitterSearchQuery'] = $search_query->value;
        }

        return $this->response->array($data);
    }
}