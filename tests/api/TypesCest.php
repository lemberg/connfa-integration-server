<?php

class TypesCest extends BaseCest
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
    public function tryToGetTypesWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['types' => []]);
    }

    public function tryToGetType(ApiTester $I)
    {
        $I->haveAType(['name' => 'test']);
        $I->sendGET('v2/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test']);
    }

    public function tryToGetTypeWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAType(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test']);
    }

    public function tryToGetTypeWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAType(['name' => 'test']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTypes');
        $I->seeResponseCodeIs(304);
    }
}
