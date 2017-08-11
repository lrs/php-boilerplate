<?php
/**
 * Example Unit Test
 * PHP version 7
 *
 * @category Tests
 * @package  Tests\Unit
 * @author   LRS <lee.spendlove@design-fu.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://localhost
 */

namespace LRS\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Run Test Suite
 *
 * @category Tests
 * @package  Tests\Unit
 * @author   LRS <lee.spendlove@design-fu.com>
 */
class BasicTest extends TestCase
{
    /**
     * Check phpunit is working
     *
     * @return void
     */
    public function testBasic()
    {
        $this->assertEquals(1, 1);
    }
}
