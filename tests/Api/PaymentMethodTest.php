<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PaymentMethodTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/payment_methods';

    public function testPaymentMethodGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testPaymentMethodGet() {
        static::createClient()->request('GET', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }
    
    public function testPaymentMethodDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testPaymentMethodUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testPaymentMethodCreate() {
        static::createClient()->request('POST', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}