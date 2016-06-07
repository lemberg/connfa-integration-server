<?php

class FloorsCest extends BaseCest
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
    public function tryToGetFloorsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['floorPlans' => []]);
    }

    public function tryToGetFloor(ApiTester $I)
    {
        $I->haveAFloor(['name' => 'test']);
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['floorPlanName' => 'test']);
    }

    public function tryToGetFloorWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAFloor(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['floorPlanName' => 'test']);
    }

    public function tryToGetFloorWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAFloor(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedFloor(ApiTester $I)
    {
        $type = $I->haveAFloor(['name' => 'test']);
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['floorPlanName' => 'test', 'deleted' => false]);
        $type->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/getFloorPlans');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['floorPlanName' => 'test', 'deleted' => true]);
    }
}
