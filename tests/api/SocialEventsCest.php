<?php

class SocialEventsCest extends BaseCest
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
    public function tryToGetSocialEventsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);
    }

    public function tryToGetSocialEvent(ApiTester $I)
    {
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'social', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['date' => $event->date]);
        $I->seeResponseContainsJson(['name' => 'test']);
    }

    public function tryToGetSocialEventWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'social', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'test']);
    }

    public function tryToGetSocialEventWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAnEvent(['name' => 'test', 'event_type' => 'social', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedSocialEvent(ApiTester $I)
    {
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'social', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['date' => $event->date]);
        $I->seeResponseContainsJson(['name' => 'test', 'deleted' => false]);
        $event->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getSocialEvents');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'test', 'deleted' => true]);
    }
}
