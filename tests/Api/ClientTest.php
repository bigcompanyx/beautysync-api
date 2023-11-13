<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\ClientFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ClientTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/clients';

    const CLIENT_DATA = [
        'id',
        'fullName',
        'email',
        'phone'
    ];

    public function testClientGetCollection() {
        ClientFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testClientGet() {
        $client = ClientFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$client->getId(),[
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::CLIENT_DATA, array_keys($response));
    }
    
    public function testClientDelete() {
        $client = ClientFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$client->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testClientUpdate() {
        $client = ClientFactory::createOne();
        $faker = ClientFactory::faker();

        static::createClient()->request('PUT', self::API_ENDPOINT.'/'.$client->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'email' => $faker->email(),
                'fullName' => $faker->firstName() .' ' . $faker->lastName(),
                'phone' => $faker->phoneNumber(),
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testClientCreate() {
        $faker = ClientFactory::faker();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'email' => $faker->email(),
                'fullName' => $faker->firstName() .' ' . $faker->lastName(),
                'phone' => $faker->phoneNumber(),
            ])
        ]);
       


        $this->assertResponseIsSuccessful();
    }
}