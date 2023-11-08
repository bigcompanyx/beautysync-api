<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class UsersTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testGetUsersCollection() {

        UserFactory::createMany(10);

        $response = static::createClient()->request('GET', '/api/users', [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertCount(10, $response);

        $this->assertSame([
            "id",
            "email",
            "roles",
            'password',
            'userIdentifier'
        ], array_keys(array_shift($response)));

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

        $this->assertSame([
            "id",
            "email",
            "roles",
            'password',
            'userIdentifier'
        ], array_keys($response));
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
                    'password' =>  $faker->password()
                ])
            ]

        )->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame([
            'id',
            'email',
            'roles',
            'password',
            'userIdentifier'
        ], array_keys($response));
    }

    public function testUpdateUser() {
        $user = UserFactory::createOne();
        $faker = UserFactory::faker();

        $email = $faker->email();

        $response = static::createClient()->request('PUT', '/api/users/'. $user->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                "email" => $email,
                "roles" => ['ROLE_USER'],
                'password' => $faker->password()
            ])
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame($email, $response['email']);
    }

    public function testDeleteUser() {
        $user = UserFactory::createOne();

        static::createClient()->request('DELETE', '/api/users/'. $user->getId());

        $this->assertResponseStatusCodeSame(204);

    }
}
