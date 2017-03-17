<?php

class PointsCest extends BaseCest
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
    public function tryToGetPointsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['poi' => []]);
    }

    public function tryToGetPoint(ApiTester $I)
    {
        $I->haveAPoint(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['poiName' => 'test']);
    }

    public function tryToGetPointWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAPoint(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['poiName' => 'test']);
    }

    public function tryToGetPointWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAPoint(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedPoint(ApiTester $I)
    {
        $type = $I->haveAPoint(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['poiName' => 'test', 'deleted' => false]);
        $type->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getPOI');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['poiName' => 'test', 'deleted' => true]);
    }
}
