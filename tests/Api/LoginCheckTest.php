<?php

namespace App\Tests\Api;

use App\Factory\UserFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class LoginCheckTest extends ImprovedApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/login_check';

    const LOGIN_CHECK_RESPONSE = [
        'token'
    ];

    public function testGetAccessToken()
    {
        $user = UserFactory::createOne();

        $response = static::createClient()->request(
            'POST', 
            self::API_ENDPOINT,
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    "email" => $user->getEmail(),
                    "password" => "password"
                ])
            ]
        )->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertSame(self::LOGIN_CHECK_RESPONSE, array_keys($response));

    } 
}