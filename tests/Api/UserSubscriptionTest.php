<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserSubscriptionFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserSubscriptionTest extends ImprovedApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/user_subscriptions';

    const USER_SUBSCRIPTION_DATA  = [
        'id',
        // @todo 'subscriptionPlan',
        'expirationDate',
        'status',
        'trialActive',
        // @todo 'user'
    ];

    public function testUserSubscriptionGetCollection() {
        UserSubscriptionFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testUserSubscriptionGet() {
        $userSubscription = UserSubscriptionFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$userSubscription->getId(),[
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::USER_SUBSCRIPTION_DATA, array_keys($response));

       //@todo //@todo  $this->assertSame(UserSubscriptionTest::USER_SUBSCRIPTION_DATA, array_keys(array_shift($response['subscriptionPlan'])));

        //@todo $this->assertSame(UsersTest::USER_DATA, array_keys($response['user']));

    }
    
    public function testUserSubscriptionDelete() {
        $userSubscription = UserSubscriptionFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$userSubscription->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testUserSubscriptionUpdate() {
        $userSubscription = UserSubscriptionFactory::createOne();
        $userSubscription2 = UserSubscriptionFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'.$userSubscription->getId(), [
            'headers' => [
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode($this->getRequestBody(self::USER_SUBSCRIPTION_DATA, $userSubscription2))
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testUserSubscriptionCreate() {
        $userSubscription = UserSubscriptionFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($this->getRequestBody(self::USER_SUBSCRIPTION_DATA, $userSubscription))
        ]);

        $this->assertResponseIsSuccessful();
    }
}