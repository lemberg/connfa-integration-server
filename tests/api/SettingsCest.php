<?php

class SettingsCest extends BaseCest
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
    public function tryToGetSettingsWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getSettings');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);
    }

    public function tryToGetSetting(ApiTester $I)
    {
        $I->haveASetting(['titleMajor' => 'test']);
        $I->sendGET('v2/getSettings');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['titleMajor' => 'test']);
    }

    public function tryToGetSettingWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveASetting(['titleMajor' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSettings');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['titleMajor' => 'test']);
    }

    public function tryToGetSettingWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveASetting(['titleMajor' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getSettings');
        $I->seeResponseCodeIs(304);
    }
}
