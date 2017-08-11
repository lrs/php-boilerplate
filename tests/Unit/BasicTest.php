<?php
/**
 * Example Unit Test
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

/**
 * Run Test Suite
 *
 * @category Tests
 * @package  DesignFu
 * @author   LRS <lee.spendlove@design-fu.com>
 * @license  http://localhost MIT
 * @link     http://localhost
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
