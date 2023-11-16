<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\CurrencyFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class CurrencyTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/currencies';

    const CURRENCY_DATA = [
        'id',
        'name',
        'isoCode'
    ];

    public function testCurrencyGetCollection() {
        CurrencyFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testCurrencyGet() {
        $currency = CurrencyFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$currency->getId(), [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::CURRENCY_DATA, array_keys($response));

    }
    
    public function testCurrencyDelete() {
        $currency = CurrencyFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'. $currency->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testCurrencyUpdate() {
        $currency = CurrencyFactory::createOne();
        $currency2 = CurrencyFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'.$currency->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode([
                'name' => $currency2->getName()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testCurrencyCreate() {
        $currency = CurrencyFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'name' => $currency->getName(),
                'isoCode' => $currency->getIsoCode()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }
}