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
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['info' => []]);

    }

    public function tryToGetInfo(ApiTester $I)
    {
        $I->haveAPage(['name' => 'test title', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title']);
    }

    public function tryToGetInfoWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAPage(['name' => 'test title', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title']);
    }

    public function tryToGetInfoWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveALevel(['name' => 'test title', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedInfo(ApiTester $I)
    {
        $page = $I->haveAPage(['name' => 'test title', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title', 'deleted' => false]);
        $page->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getInfo');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['infoTitle' => 'test title', 'deleted' => true]);
    }
}
