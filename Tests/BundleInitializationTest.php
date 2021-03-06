<?php

namespace Happyr\LinkedInBundle\Tests;

use Happyr\LinkedIn\LinkedIn;
use Happyr\LinkedInBundle\HappyrLinkedInBundle;
use Http\HttplugBundle\HttplugBundle;
use Nyholm\BundleTest\BaseBundleTestCase;
use Nyholm\BundleTest\CompilerPass\PublicServicePass;

class BundleInitializationTest extends BaseBundleTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->addCompilerPass(new PublicServicePass('|happyr.*|'));
    }

    protected function getBundleClass()
    {
        return HappyrLinkedInBundle::class;
    }

    public function testInitBundle()
    {
        $kernel = $this->createKernel();
        $kernel->addConfigFile(__DIR__.'/config.yml');
        $kernel->addBundle(HttplugBundle::class);


        // Boot the kernel.
        $this->bootKernel();

        // Get the container
        $container = $this->getContainer();

        // Test if you services exists
        $this->assertTrue($container->has('happyr.linkedin'));
        $service = $container->get('happyr.linkedin');
        $this->assertInstanceOf(LinkedIn::class, $service);
    }
}