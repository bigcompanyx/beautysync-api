<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SubscriptionPlanTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/subscription_plans';

    const SUBSCRIPTION_PLAN_DATA = [
        'id',
        'name',
        'description',
        'features',
        'price',
        'duration',
        'durationUnit',
        'trialDuration',
        'trialDurationUnit'
    ];

    public function testSubscriptionPlanGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testSubscriptionPlanGet() {
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::SUBSCRIPTION_PLAN_DATA, array_keys($response));
        $this->assertSame(SubscriptionPlanFeaturesTest::FEATURE_DATA, array_keys(array_shift($response['features'])));
    }
    
    public function testSubscriptionPlanDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testSubscriptionPlanUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testSubscriptionPlanCreate() {
        static::createClient()->request('POST', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}