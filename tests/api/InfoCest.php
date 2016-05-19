<?php

class InfoCest extends BaseCest
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
    public function tryToGetInfoWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['info' => []]);
    }

    public function tryToGetInfo(ApiTester $I)
    {
        $I->haveAPage(['name' => 'test title']);
        $I->sendGET('v2/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title']);
    }

    public function tryToGetInfoWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAPage(['name' => 'test title']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title']);
    }

    public function tryToGetInfoWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveALevel(['name' => 'test title']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getInfo');
        $I->seeResponseCodeIs(304);
    }
}
