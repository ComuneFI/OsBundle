<?php

namespace Fi\OsBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fi\OsBundle\DependencyInjection\OsFunctions;

class OsFunctionsTest extends WebTestCase
{
    protected function setUp()
    {
        /* require_once __DIR__.'/../../AppKernel.php';

          $kernel = new \AppKernel('test', true);
          $kernel->boot();
          $container = $kernel->getContainer(); */
    }

    public function testFunctions()
    {
        $this->assertContains('php', OsFunctions::getPHPExecutableFromPath());
        if (PHP_OS == 'WINNT') {
            $this->assertTrue(OsFunctions::isWindows());
            $this->assertEquals(OsFunctions::getSeparator(), '&');
        } else {
            $this->assertFalse(OsFunctions::isWindows());
            $this->assertEquals(OsFunctions::getSeparator(), ';');
        }
        $dirtest = sys_get_temp_dir().DIRECTORY_SEPARATOR.'testosbundle';
        mkdir($dirtest);
        $this->assertTrue(file_exists($dirtest));
        OsFunctions::delTree($dirtest);
        $this->assertFalse(file_exists($dirtest));
        $url = 'http://www.example.com/';
        $retget = OsFunctions::httpCurlResponse($url);
        $this->assertContains('example', $retget);
        $retpost = OsFunctions::httpCurl($url);
        $this->assertContains('example', $retpost);
    }
}
