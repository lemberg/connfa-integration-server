<?php

namespace App\Repositories;

use App\Models\Schedule;

class ScheduleRepository extends BaseRepository
{

    public function model()
    {
        return Schedule::class;
    }

    /**
     * @param int $length
     * @return int
     */
    public function generateCode($length = 4)
    {
        $min = (int) str_pad(1, $length, "0", STR_PAD_RIGHT);
        $max = (int) str_pad(9, $length, "9", STR_PAD_RIGHT);

        $code = mt_rand($min, $max);
        $schedule = $this->model->where('code', '=', $code)->first();
        if ($schedule) {

            return $this->generateCode();
        }

        return $code;
    }

}
