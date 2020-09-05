<?php

namespace Elvendor\Tcmb\Tests;

use Orchestra\Testbench\TestCase;
use Elvendor\Tcmb\TcmbServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TcmbServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
