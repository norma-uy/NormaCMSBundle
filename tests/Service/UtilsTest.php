<?php

namespace NormaUy\Bundle\NormaCMSBundle\Tests\Service;

use NormaUy\Bundle\NormaCMSBundle\Service\Utils;
use NormaUy\Bundle\NormaCMSBundle\Tests\TestApplication\NormaCMSKernel;
use PHPUnit\Framework\TestCase;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class UtilsTest extends TestCase
{
    public function testUnit()
    {
        $utils = new Utils();

        $isMobile = $utils->isMobile('');
        $this->assertIsBool($isMobile);
    }

    public function testServiceWiring()
    {
        $kernel = new NormaCMSKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $utils = $container->get(Utils::class);

        $this->assertInstanceOf(Utils::class, $utils);

        $isMobile = $utils->isMobile('');
        $this->assertIsBool($isMobile);
    }
}
