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

        $I->haveAnSpeaker(['first_name' => 'test', 'last_name' => 'Speaker']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [4]]);

        $I->haveALevel(['name' => 'beginner']);
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['idsForUpdate' => [2, 4]]);
    }

    public function tryToCheckUpdatesWithFeatureSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/checkUpdates');
        $I->seeResponseCodeIs(304);
    }
}
