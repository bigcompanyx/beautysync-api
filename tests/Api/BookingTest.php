<?php 

namespace App\Tests\Api;

use App\Factory\BookingFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BookingTest extends ImprovedApiTestCase
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
        'services',
        'company'
    ];

    public function testBookingCreate() {

        $booking = BookingFactory::new()->withoutPersisting()->createOne();

        $response = static::createClient()->request(
            'POST', 
            '/api/bookings', 
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($this->getRequestBody(self::BOOKING_DATA, $booking->object()))
            ]

        )->toArray();

        $this->assertResponseIsSuccessful();
       
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertArrayHasKeys(self::BOOKING_DATA, $response);
    }

    public function testBookingGet() {

        $booking = BookingFactory::createOne();

        $response = static::createClient()->request('GET', '/api/bookings/'.$booking->getId())->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertArrayHasKeys(self::BOOKING_DATA, $response);

        $this->assertArrayHasKeys(ServiceTest::SERVICE_DATA, array_shift($response['services']));


        $this->assertArrayHasKeys(function(){
            $userExpectedData = UsersTest::USER_DATA;

            $propsToExclude = ['roles', 'password', 'userIdentifier'];

            array_walk($propsToExclude, function($prop) use(&$userExpectedData){
                unset($userExpectedData[array_search($prop, $userExpectedData)]);
            });

            return $userExpectedData;

        }, $response['assignee']);

        $this->assertArrayHasKeys(ClientTest::CLIENT_DATA, $response['client']);
    }

    public function testBookingGetCollection() {
        BookingFactory::createMany(10);

        $response = static::createClient()->request('GET', '/api/bookings');

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testBookingUpdate() {
        $booking = BookingFactory::new()->createOne();

        $newBooking = BookingFactory::new()->withoutPersisting()->createOne();

        $response = static::createClient()->request('PATCH', '/api/bookings/'. $booking->getId(), [
            'headers' => [
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode($this->getRequestBody(BookingTest::BOOKING_DATA, $newBooking->object()))
        ])->toArray();

        $this->assertResponseIsSuccessful();

    }
    
    public function testBookingDelete() {
        $booking = BookingFactory::createOne();

        static::createClient()->request('DELETE', '/api/bookings/'.$booking->getId());

        $this->assertResponseIsSuccessful();
    }

}