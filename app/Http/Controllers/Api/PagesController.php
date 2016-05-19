<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\PageRepository;
use App\Transformers\PageTransformer;
use vendocrat\Settings\Facades\Setting;

class PagesController extends ApiController
{
    public function index(PageRepository $repository)
    {
        $pages = $repository->getPagesWithDeleted($this->since);
        $this->checkModified($pages);

        $response = [];
        $response['info'] = [];
        $response['title']['titleMajor'] = Setting::get('titleMajor');
        $response['title']['titleMinor'] = Setting::get('titleMinor');

        $transformer = new PageTransformer();

        foreach ($pages as $page) {
            $response['info'][] = $transformer->transform($page);
        }

        return $this->response->array($response);
    }
}