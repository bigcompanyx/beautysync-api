<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;


class UsersTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testGetCollection() {

        UserFactory::createMany(10);
        $response = static::createClient()->request('GET', '/api/users');

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertCount(10, $response->toArray()['hydra:member']);

    }

    public function testGetUser() { 
        $user = UserFactory::createOne();

        static::createClient()->request('GET', '/api/users/'. $user->getId());

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/User',
            "@id" => "/api/users/".$user->getId(),
            '@type' => 'User',
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "roles" => $user->getRoles(),
            "userIdentifier" => $user->getEmail(),
            "fullName" => $user->getFullName(),
            "jobTitle" => $user->getJobTitle()
        ]);
    }

    public function testCreateUsers() {
        $faker = UserFactory::faker();

        $userDAta = [
            "email" => $faker->email(),
            "roles" => ['ROLE_USER'],
            "fullName" => $faker->firstName() .' '. $faker->lastName(),
            "jobTitle" => $faker->word()
        ];

        static::createClient()->request('POST', '/api/users/', [
            "email" => $userDAta["email"],
            "roles" => ['ROLE_USER'],
            "fullName" => $userDAta["fullName"],
            "jobTitle" => $userDAta["jobTitle"]
        ]);

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/User',
            '@type' => 'User',
            "email" => $userDAta["email"],
            "roles" =>['ROLE_USER'],
            "userIdentifier" => $userDAta["email"],
            "fullName" => $userDAta["fullName"],
            "jobTitle" => $userDAta["jobTitle"]
        ]);
    }

    public function testUpdateUsers() {}

    public function testDeleteUsers() {}
}
