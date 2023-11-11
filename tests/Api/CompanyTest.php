<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class CompanyTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/companies';

    const COMPANY_DATA = [
        'id',
        'name',
        'description',
        'location',
        'slug',
        'published',
        'paymentMethods',
        'workingHours',
        'services',
        'users',
        'logo',
        'gallery'
    ];
    public function testCompanyGetCollection() {

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testCompanyGet() {
       $response = static::createClient()->request('GET', self::API_ENDPOINT.'/1')->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::COMPANY_DATA, array_keys($response));

        $this->assertSame(PaymentMethodTest::PAYMENT_METHOD, array_keys(array_shift($response['paymentMethods'])));

        $this->assertSame(WorkingHoursTest::WORKING_HOURS_DATA, array_keys(array_shift($response['workingHours'])));

        $this->assertSame(ServiceTest::SERVICE_DATA, array_keys(array_shift($response['services'])));

        $this->assertSame(UsersTest::USER_DATA, array_keys(array_shift($response['users'])));

    }
    
    public function testCompanyDelete() {
        static::createClient()->request('DELETE', self::API_ENDPOINT.'/1');

        $this->assertResponseIsSuccessful();
    }

    public function testCompanyUpdate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }

    public function testCompanyCreate() {
        static::createClient()->request('PUT', self::API_ENDPOINT.'/1', []);

        $this->assertResponseIsSuccessful();
    }
}