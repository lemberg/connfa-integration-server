<?php

class TwitterCest extends BaseCest
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
    public function tryToGetTwitterWhenEmpty(ApiTester $I)
    {
        $I->sendGET('v2/getTwitter');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);
    }

    public function tryToGetTwitter(ApiTester $I)
    {
        $I->haveATwitter(['twitterWidget' => 'test widget', 'twitterSearchQuery' => '#connfa']);
        $I->sendGET('v2/getTwitter');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['twitterWidgetHTML' => 'test widget']);
        $I->seeResponseContainsJson(['twitterSearchQuery' => '#connfa']);
    }

    public function tryToGetTwitterWithIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('-1 hour');
        $I->haveATwitter(['twitterWidget' => 'test widget', 'twitterSearchQuery' => '#connfa']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTwitter');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['twitterWidgetHTML' => 'test widget']);
        $I->seeResponseContainsJson(['twitterSearchQuery' => '#connfa']);
    }

    public function tryToGetTwitterWithFeatureIfModifiedSince(ApiTester $I)
    {
        $since = \Carbon\Carbon::parse('+5 hour');
        $I->haveATwitter(['twitterWidget' => 'test widget', 'twitterSearchQuery' => '#connfa']);
        $I->haveHttpHeader('If-modified-since', $since->toIso8601String());
        $I->sendGET('v2/getTwitter');
        $I->seeResponseCodeIs(304);
    }
}
