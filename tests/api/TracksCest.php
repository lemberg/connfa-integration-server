<?php

class TracksCest extends BaseCest
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
    public function tryToGetTracksWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['tracks' => []]);
    }

    public function tryToGetTrack(ApiTester $I)
    {
        $I->haveATrack(['name' => 'test']);
        $I->sendGET('v2/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test']);
    }

    public function tryToGetTrackWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveATrack(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test']);
    }

    public function tryToGetTrackWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveATrack(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTracks');
        $I->seeResponseCodeIs(304);
    }
}
