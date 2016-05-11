<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Repositories\Event;


use app\Models\Event\Type;
use App\Repositories\BaseRepository;

class TypeRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Event\Type';
    }

    public function getTypesWithDeleted($since = false)
    {
        if ($since) {
            return Type::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Type::withTrashed()->get();
    }
}