<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserSubscriptionTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/user_subscriptions';

    const USER_SUBSCRIPTION_DATA  = [
        'id',
        'subscriptionPlan',
        'expirationDate',
        'status',
        'trialActiveTrialActive',
        'user'
    ];

    public function testUserSubscriptionGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testUserSubscriptionGet() {
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::USER_SUBSCRIPTION_DATA, array_keys($response));

        $this->assertSame(UserSubscriptionTest::USER_SUBSCRIPTION_DATA, array_keys(array_shift($response['subscriptionPlan'])));

        $this->assertSame(UsersTest::USER_DATA, array_keys($response['user']));

    }
    
    public function testUserSubscriptionDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testUserSubscriptionUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testUserSubscriptionCreate() {
        static::createClient()->request('POST', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}