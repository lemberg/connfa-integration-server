<?php

class SpeakersCest extends BaseCest
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
    public function tryToGetSpeakersWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['speakers' => []]);
    }

    public function tryToGetSpeaker(ApiTester $I)
    {
        $I->haveASpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['firstName' => 'test']);
    }

    public function tryToGetSpeakerWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveASpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['firstName' => 'test']);
    }

    public function tryToGetSpeakerWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveASpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedSpeaker(ApiTester $I)
    {
        $speaker = $I->haveASpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['firstName' => 'test']);
        $speaker->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/getSpeakers');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['firstName' => 'test', 'deleted' => true]);
    }
}
