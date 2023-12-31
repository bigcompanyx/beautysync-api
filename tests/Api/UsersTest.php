<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UsersTest extends ApiTestCase
{
    use ResetDatabase, Factories;
    const USER_DATA = [
        'id',
        'email',
        'roles',
        'password',
        // @todo  'photo',
        'fullName',
        'jobTitle',
        'userIdentifier'
    ];
    public function testGetUsersCollection() {

        UserFactory::createMany(10);

        $response = static::createClient()->request('GET', '/api/users')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response['hydra:member']);

    }

    public function testGetUser() { 
        $user = UserFactory::createOne();

        $response = static::createClient()->request('GET', '/api/users/'. $user->getId(), [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::USER_DATA, array_keys($response));
    }

    public function testCreateUser() {
        $faker = UserFactory::faker();

        $response = static::createClient()->request(
            'POST', 
            '/api/users', 
            [
                'headers' => [
                    'accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    "email" => $faker->email(),
                    "roles" => ['ROLE_USER'],
                    "fullName" => $faker->firstName() .' '. $faker->lastName(),
                    "jobTitle" => $faker->word(),
                    'password' =>  $faker->password(),

                ])
            ]

        )->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::USER_DATA, array_keys($response));
    }

    public function testUpdateUser() {
        $user = UserFactory::createOne();
        $faker = UserFactory::faker();

        static::createClient()->request('PUT', '/api/users/'. $user->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                "email" => $faker->email(),
                "roles" => ['ROLE_USER'],
                "fullName" => $faker->firstName() .' '. $faker->lastName(),
                "jobTitle" => $faker->word(),
                'password' =>  $faker->password(),
            ])
        ])->toArray();

        $this->assertResponseIsSuccessful();

    }

    public function testDeleteUser() {
        $user = UserFactory::createOne();

        static::createClient()->request('DELETE', '/api/users/'. $user->getId());

        $this->assertResponseStatusCodeSame(204);

    }
}
