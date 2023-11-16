<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class WorkingHoursTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/working_hours';

    const WORKING_HOURS_DATA = [
        'id',
        // @todo 'sunday',
        // @todo 'monday',
        // @todo 'tuesday',
        // @todo 'wednesday',
        // @todo 'thursday',
        // @todo 'friday'
    ];

    const  WORKING_DAYS_DAY_DATA = [
        'id',
        'dayName',
        'workStart',
        'workEnd',
        'open'
    ];

    public function testWorkingHoursGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testWorkingHoursGet() {
        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();


        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::WORKING_HOURS_DATA, array_keys($response));

        // @todo $this->assertSame(self::WORKING_DAYS_DAY_DATA, array_keys($response['sunday']));
    }
    
    public function testWorkingHoursDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testWorkingHoursUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testWorkingHoursCreate() {
        static::createClient()->request('POST', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}