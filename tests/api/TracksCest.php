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
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['tracks' => []]);
    }

    public function tryToGetTrack(ApiTester $I)
    {
        $I->haveATrack(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test']);
    }

    public function tryToGetTrackWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveATrack(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test']);
    }

    public function tryToGetTrackWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveATrack(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedTrack(ApiTester $I)
    {
        $track = $I->haveATrack(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test', 'deleted' => false]);
        $track->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getTracks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['trackName' => 'test', 'deleted' => true]);
    }
}
