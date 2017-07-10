<?php


class SchedulesCest extends BaseCest
{
    public function _before(ApiTester $I)
    {
        parent::_before($I);
    }

    public function _after(ApiTester $I)
    {
        parent::_after($I);
    }
    // tests
    public function tryToGetSchedulesWhenEmpty(ApiTester $I)
    {
        $code = 1111;
        $I->sendGET('v2/getSchedules?codes[]=' . $code);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['schedules' => []]);
    }

    public function tryToGetSchedules(ApiTester $I)
    {
        $code = 1111;
        $I->haveASchedule(['code' => $code]);
        $I->sendGET('v2/getSchedules?codes[]=' . $code);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'schedules' => [
                [
                    'code' => $code,
                    'events' => []
                ]
            ]
        ]);
    }

    public function tryToGetSchedulesWithIfModifiedSince(ApiTester $I)
    {
        $code = 1111;
        $since = \Carbon\Carbon::parse('-1 hour');
        $schedule = $I->haveASchedule(['code' => $code]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSchedules?codes[]=' . $code);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'schedules' => [
                [
                    'code' => $code,
                    'events' => []
                ]
            ]
        ]);
    }

    public function tryToGetSchedulesWithFutureIfModifiedSince(ApiTester $I)
    {
        $code = 1111;
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveASchedule(['code' => $code]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSchedules?codes[]=' . $code);
        $I->seeResponseCodeIs(304);
    }

    public function tryToCreateScheduleWhenEmpty(ApiTester $I)
    {
        $I->sendPOST('v2/createSchedule');
        $I->seeResponseCodeIs(200);
    }

    public function tryToCreateSchedule(ApiTester $I)
    {
        $I->sendPOST('v2/createSchedule', ['data' => $this->generateEventIds($I)]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseMatchesJsonType(['code' => 'integer']);
    }

    public function tryToUpdateSchedule(ApiTester $I)
    {
        $code = 1111;
        $I->haveASchedule(['code' => $code]);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('v2/updateSchedule/' . $code, ['data' => $this->generateEventIds($I, 4)]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['code' => $code]);
    }

    /**
     * @param ApiTester $I
     * @param int       $length
     * @return array
     */
    private function generateEventIds(ApiTester $I, $length = 2)
    {
        $ids = [];
        for ($i = 0; $i < $length; $i++) {
            $event = $I->haveAnEvent(['name' => 'test' . $i, 'event_type' => 'session']);
            $ids[] = $event->id;
        }
        return $ids;
    }
}
