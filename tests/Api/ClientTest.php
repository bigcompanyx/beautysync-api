<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ClientTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/clients';

    public function testClientGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testClientGet() {
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame([
            'id',
            'fullName',
            'email',
            'phone'
        ], array_keys($response));
    }
    
    public function testClientDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testClientUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testCilientCreate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}