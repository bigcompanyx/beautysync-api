<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\BookingFactory;
use App\Factory\ServiceFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BookingTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const BOOKING_DATA = [
        'id',
        'dateTimeEnd',
        'dateTimeStart',
        'duration',
        'price',
        'assignee',
        'client',
        'service',
        'company'
    ];

    public function testBookingGetCollection() {
        ServiceFactory::createMany(3);

        BookingFactory::createMany(10, function() {
            return [
                'service' => ServiceFactory::randomRange(0, 3),
            ];
        });


        $response = static::createClient()->request('GET', '/api/bookings');

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testBookingGet() {

        $booking = BookingFactory::createOne();

        $response = static::createClient()->request('GET', '/api/bookings/'.$booking->getId())->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');


        $bookingData = self::BOOKING_DATA;
        array_walk($bookingData, function($key) use($response){
            $this->assertArrayHasKey($key, $response);

        });

        // @todo $this->assertSame(UsersTest::USER_DATA, array_keys($response['assignee']));

        // @todo $this->assertSame(ClientTest::CLIENT_DATA, array_keys($response['client']));

    }
    
    public function testBookingDelete() {
        $booking = BookingFactory::createOne();

        static::createClient()->request('DELETE', '/api/bookings/'.$booking->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testBookingUpdate() {
        $booking = BookingFactory::createOne();
        $faker = BookingFactory::faker();

        static::createClient()->request('PUT', '/api/bookings/'. $booking->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'dateTimeEnd' => \DateTimeImmutable::createFromMutable($faker->dateTime())->format('Y-m-d H:i:s'),
                'dateTimeStart' => \DateTimeImmutable::createFromMutable($faker->dateTime())->format('Y-m-d H:i:s'),
                'duration' => $faker->randomNumber(),
                'price' => $faker->randomNumber(),
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testBookingCreate() {

        $faker = BookingFactory::faker();

        $response = static::createClient()->request(
            'POST', 
            '/api/bookings', 
            [
                'headers' => [
                    'accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    'dateTimeEnd' => \DateTimeImmutable::createFromMutable($faker->dateTime())->format('Y-m-d H:i:s'),
                    'dateTimeStart' => \DateTimeImmutable::createFromMutable($faker->dateTime())->format('Y-m-d H:i:s'),
                    'duration' => $faker->randomNumber(),
                    'price' => $faker->randomNumber(),

                ])
            ]

        )->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::BOOKING_DATA, array_keys($response));
    }
}