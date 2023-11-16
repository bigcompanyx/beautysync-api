<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\CompanyFactory;
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
        // @todo 'paymentMethods',
        // @todo 'workingHours',
        // @todo 'services',
        // @todo 'users',
        // @todo 'logo',
        // @todo 'gallery'
    ];
    public function testCompanyGetCollection() {

        CompanyFactory::createMany(10);

        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testCompanyGet() {

        $company = CompanyFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'.$company->getId(), [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::COMPANY_DATA, array_keys($response));

        // @todo $this->assertSame(PaymentMethodTest::PAYMENT_METHOD, array_keys(array_shift($response['paymentMethods'])));

        // @todo $this->assertSame(WorkingHoursTest::WORKING_HOURS_DATA, array_keys(array_shift($response['workingHours'])));

       // @todo  $this->assertSame(ServiceTest::SERVICE_DATA, array_keys(array_shift($response['services'])));

        // @todo $this->assertSame(UsersTest::USER_DATA, array_keys(array_shift($response['users'])));

    }
    
    public function testCompanyDelete() {
        $company = CompanyFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$company->getId());

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