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
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['types' => []]);
    }

    public function tryToGetType(ApiTester $I)
    {
        $I->haveAType(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test']);
    }

    public function tryToGetTypeWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveAType(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test']);
    }

    public function tryToGetTypeWithFutureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveAType(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(304);
    }

    public function tryToGetDeletedType(ApiTester $I)
    {
        $type = $I->haveAType(['name' => 'test', 'conference_id' => $this->conference->id]);
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test', 'deleted' => false]);
        $type->delete();
        $I->haveHttpHeader('If-modified-since', \Carbon\Carbon::now()->toIso8601String());
        $I->sendGET('v2/test/getTypes');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['typeName' => 'test', 'deleted' => true]);
    }
}
