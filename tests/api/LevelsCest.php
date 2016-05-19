<?php

class LevelsCest extends BaseCest
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
    public function tryToGetLevelsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getLevels');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['levels' => []]);
    }

    public function tryToGetLevel(ApiTester $I)
    {
        $I->haveALevel(['name' => 'beginner']);
        $I->sendGET('v2/getLevels');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['levelName' => 'beginner']);
    }

    public function tryToGetLevelWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveALevel(['name' => 'beginner']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getLevels');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['levelName' => 'beginner']);
    }

    public function tryToGetLevelWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveALevel(['name' => 'beginner']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getLevels');
        $I->seeResponseCodeIs(304);
    }
}
