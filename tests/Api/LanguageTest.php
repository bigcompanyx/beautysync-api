<?php 

namespace App\Tests\Api;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\LanguageFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class LanguageTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    const API_ENDPOINT = '/api/languages';

    const LANGUAGE_DATA = [
        'id',
        'name'
    ];

    public function testLanguageGetCollection() {
        LanguageFactory::createMany(10);
        
        $response = static::createClient()->request('GET', self::API_ENDPOINT);

        $this->assertResponseIsSuccessful();

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }

    public function testLanguageGet() {
        $language = LanguageFactory::createOne();

        $response = static::createClient()->request('GET', self::API_ENDPOINT.'/'. $language->getId(), [
            'headers' => [
                'accept' => 'application/json'
            ]
        ])->toArray();

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');

        $this->assertSame(self::LANGUAGE_DATA, array_keys($response));

    }
    
    public function testLanguageDelete() {
        $language = LanguageFactory::createOne();

        static::createClient()->request('DELETE', self::API_ENDPOINT.'/'.$language->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testLanguageUpdate() {
        $language = LanguageFactory::createOne();
        $language2 = LanguageFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('PATCH', self::API_ENDPOINT.'/'. $language->getId(), [
            'headers' => [
                'accept' => 'application/json',
                'Content-Type' => 'application/merge-patch+json'
            ],
            'body' => json_encode([
                'name' => $language2->getName()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testLanguageCreate() {
        $language = LanguageFactory::new()->withoutPersisting()->createOne();

        static::createClient()->request('POST', self::API_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' =>  json_encode([
                'name' => $language->getName()
            ])
        ]);

        $this->assertResponseIsSuccessful();
    }
}