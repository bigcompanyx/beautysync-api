<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BookingTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const BOOKING_DATA = [
        'id',
        'dateTimeStart',
        'dateTimeEnd',
        'duration',
        'price',
        'assignee',
        'client'
    ];

    public function testBookingGetCollection() {

        $response = static::createClient()->request('GET', '/api/bookings');

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testBookingGet() {
        $response = static::createClient()->request('GET', '/api/bookings/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::BOOKING_DATA, array_keys($response));

        $this->assertSame(UsersTest::USER_DATA, array_keys($response['assignee']));

        $this->assertSame(ClientTest::CLIENT_DATA, array_keys($response['client']));

    }
    
    public function testBookingDelete() {
        static::createClient()->request('DELETE', '/api/bookings/1');

        $this->assertResponseIsSuccessful();
    }

    public function testBookingUpdate() {
        static::createClient()->request('PUT', '/api/bookings/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testBookingCreate() {
        static::createClient()->request('PUT', '/api/bookings/1', []);

        $this->assertResponseIsSuccessful();
    }
}