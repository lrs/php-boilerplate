<?php
/**
 * Test Core App features
 * PHP version 7
 *
 * @category Tests
 * @package  DesignFu
 * @author   LRS <lee.spendlove@design-fu.com>
 * @license  http://localhost MIT
 * @link     http://localhost
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use LRS\App\Core\App;

class CoreAppTest extends TestCase
{
    public function testBind()
    {
        // When we bind a key/value pair to the App registory
        App::bind('test', 'test');

        // The get static method should return the correct registory value for the given key.
        $this->assertEquals('test', App::get('test'));
    }

    /**
     * @depends testBind
     * @expectedException Exception
     * @expectedExceptionMessage No text is bound in the container
     * @returns Void
     */
    public function testBindException()
    {
        // When we mispell the key, the static get method should throw an exception
        $this->expectException(App::get('text'));
    }
}
