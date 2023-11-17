<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\WorkingHoursFactory;
use App\Tests\ImprovedApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class WorkingHoursTest extends ImprovedApiTestCase
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
        WorkingHoursFactory::createMany(10);
        
        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testWorkingHoursGet() {
        $workinghours = WorkingHoursFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$workinghours->getId(),[
           'headers' =>  [
                'accept' => 'application/json'
            ] 
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::WORKING_HOURS_DATA, array_keys($response));

        // @todo $this->assertSame(self::WORKING_DAYS_DAY_DATA, array_keys($response['sunday']));
    }
    
    public function testWorkingHoursDelete() {
        $workinghours = WorkingHoursFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$workinghours->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testWorkingHoursUpdate() {
        $workinghours = WorkingHoursFactory::createOne();
        $workinghours2 = WorkingHoursFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'.$workinghours->getId(), [
            'headers' => [
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode($this->getRequestBody(self::WORKING_HOURS_DATA, $workinghours2))
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testWorkingHoursCreate() {
        $workinghours = WorkingHoursFactory::new()->withoutPersisting()->createOne()->object();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($this->getRequestBody(self::WORKING_HOURS_DATA, $workinghours))
        ]);

        $this->assertResponseIsSuccessful();
    }
}