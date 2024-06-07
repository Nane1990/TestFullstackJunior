<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase {
	
	public function testHelloWithoutName() {
		$client = static::createClient(); $client->request('GET', '/hello');

    $this->assertEquals(200, $client->getResponse()->getStatusCode());
    $this->assertStringContainsString('¡Hola, World!', $client->getResponse()->getContent());
    }

}