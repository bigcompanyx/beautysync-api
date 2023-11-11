<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ServiceTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/services';

    public function testServiceGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testServiceGet() {
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame([
            'id',
            'name',
            'price',
            'description',
            'duration'
        ], array_keys($response));

    }
    
    public function testServiceDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testServiceUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testServiceCreate() {
        static::createClient()->request('POST', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}