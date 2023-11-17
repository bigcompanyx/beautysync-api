<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\SubscriptionPlanFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SubscriptionPlanTest extends ImprovedApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/subscription_plans';

    const SUBSCRIPTION_PLAN_DATA = [
        'id',
        'name',
        'description',
        //@todo 'features',
        'price',
        'duration',
        'durationUnit',
        'trialDuration',
        'trialDurationUnit'
    ];

    public function testSubscriptionPlanGetCollection() {
        SubscriptionPlanFactory::createMany(10);
        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testSubscriptionPlanGet() {
        $subscriptionPlan = SubscriptionPlanFactory::createOne();
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$subscriptionPlan->getId(),[
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::SUBSCRIPTION_PLAN_DATA, array_keys($response));
        //@todo $this->assertSame(SubscriptionPlanFeaturesTest::FEATURE_DATA, array_keys(array_shift($response['features'])));
    }
    
    public function testSubscriptionPlanDelete() {
        $subscriptionPlan = SubscriptionPlanFactory::createOne();
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$subscriptionPlan->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testSubscriptionPlanUpdate() {
        $subscriptionPlan = SubscriptionPlanFactory::createOne();
        $subscriptionPlan2 = SubscriptionPlanFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'.$subscriptionPlan->getId(), [
            'headers' => [
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode($this->getRequestBody(self::SUBSCRIPTION_PLAN_DATA, $subscriptionPlan2))
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testSubscriptionPlanCreate() {
        $subscriptionPlan = SubscriptionPlanFactory::new()->withoutPersisting()->createOne()->object();
        
        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($this->getRequestBody(self::SUBSCRIPTION_PLAN_DATA, $subscriptionPlan)) 
        ]);

        $this->assertResponseIsSuccessful();
    }
}