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
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locations' => []]);
    }

    public function tryToGetLocation(ApiTester $I)
    {
        $I->haveALocation(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test']);
    }

    public function tryToGetLocationWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveALocation(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test']);
    }

    public function tryToGetLocationWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveALocation(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedLocation(ApiTester $I)
    {
        $location = $I->haveALocation(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test', 'deleted' => false]);
        $location->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getLocations');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['locationName' => 'test', 'deleted' => true]);
    }
}
