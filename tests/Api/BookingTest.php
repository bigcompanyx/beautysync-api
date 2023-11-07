<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BookingTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testBookingGetCollection() {

        $response = static::createClient()->request('GET', '/api/bookings');

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testBookingGet() {
        static::createClient()->request('GET', '/api/bookings/1');

        $this->assertResponseIsSuccessful();
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