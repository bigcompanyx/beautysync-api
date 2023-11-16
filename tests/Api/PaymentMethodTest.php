<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\PaymentMethodFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PaymentMethodTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/payment_methods';

    const PAYMENT_METHOD = [
        'id',
        'name'
    ];

    public function testPaymentMethodGetCollection() {
        PaymentMethodFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testPaymentMethodGet() {
        $paymentMethod = PaymentMethodFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'. $paymentMethod->getId(), [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::PAYMENT_METHOD, array_keys($response));
    }
    
    public function testPaymentMethodDelete() {
        $paymentMethod = PaymentMethodFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$paymentMethod->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testPaymentMethodUpdate() {
        $paymentMethod = PaymentMethodFactory::createOne();
        $paymentMethod2 = PaymentMethodFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'. $paymentMethod->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode([
                'name' => $paymentMethod2->getName()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testPaymentMethodCreate() {

        $language = PaymentMethodFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'name' => $language->getName()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }
}