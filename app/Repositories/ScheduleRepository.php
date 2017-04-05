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
     * Generate unique code for new schedule
     *
     * @param int $length
     * @return int
     */
    public function generateCode($length = 4)
    {
        $min = (int) str_pad(1, $length, "0", STR_PAD_RIGHT);
        $max = (int) str_pad(9, $length, "9", STR_PAD_RIGHT);

        $code = mt_rand($min, $max);
        $schedule = $this->findOneByCode($code);
        if ($schedule) {

            return $this->generateCode();
        }

        return $code;
    }

    /**
     * Find one schedule by code
     *
     * @param int $code
     * @return mixed
     */
    public function findOneByCode($code)
    {
        return $this->model->where('code', '=', $code)->first();
    }

    /**
     * Find all by codes
     *
     * @param array $codes
     * @return mixed
     */
    public function findByCodes(array $codes)
    {
        return $this->model->whereIn('code', $codes)->get();
    }

}
