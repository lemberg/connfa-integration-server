<?php

class UpdatesCest extends BaseCest
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
    public function tryToCheckUpdates(ApiTester $I)
    {
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => []]);

        $I->haveASetting(['titleMajor' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0]]);

        $I->haveAType(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1]]);

        $I->haveALevel(['name' => 'beginner']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2]]);

        $I->haveATrack(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3]]);

        $I->haveAnSpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4]]);

        $I->haveALocation(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5]]);

        $I->haveAFloor(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6]]);

        $I->haveAnEvent(['name' => 'test', 'event_type' => 'session']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6, 7]]);

        $I->haveAnEvent(['name' => 'test1', 'event_type' => 'bof']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6, 7, 8]]);

        $I->haveAnEvent(['name' => 'test2', 'event_type' => 'social']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]]);

        $I->haveAPoint(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]]);

        $I->haveAPage(['name' => 'test']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]]);
    }

    public function tryToCheckUpdatesWithFeatureSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(304);
    }
}
