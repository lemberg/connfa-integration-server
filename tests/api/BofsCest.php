<?php

class BofsCest extends BaseCest
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
    public function tryToGetBofsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);
    }

    public function tryToGetBof(ApiTester $I)
    {
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'bof', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['date' => $event->date]);
        $I->seeResponseContainsJson(['name' => 'test']);
    }

    public function tryToGetBofWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'bof', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'test']);
    }

    public function tryToGetBofWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAnEvent(['name' => 'test', 'event_type' => 'bof', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedBof(ApiTester $I)
    {
        $event = $I->haveAnEvent(['name' => 'test', 'event_type' => 'bof', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'test', 'deleted' => false]);
        $event->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getBofs');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['name' => 'test', 'deleted' => true]);
    }
}
