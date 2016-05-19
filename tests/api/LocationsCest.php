<?php

class LocationsCest extends BaseCest
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
    public function tryToGetLocationsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locations' => []]);
    }

    public function tryToGetLocation(ApiTester $I)
    {
        $I->haveALocation(['name' => 'test']);
        $I->sendGET('v2/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test']);
    }

    public function tryToGetLocationWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveALocation(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test']);
    }

    public function tryToGetLocationWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveALocation(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getLocations');
        $I->seeResponseCodeIs(304);
    }
}
