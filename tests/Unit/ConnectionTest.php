<?php
/**
 * Test database connection, insert and select
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

use PDO;

use LRS\App\Core\Database\Connection;
use LRS\App\Core\Database\QueryBuilder;

/**
 * Run Test Suite
 *
 * @category Tests
 * @package  Tests\Unit
 * @author   LRS <lee.spendlove@design-fu.com>
 */
class ConnectionTest extends TestCase
{
    /**
     * Check phpunit is working
     *
     * @return void
     */
    public function testConnection()
    {
        // Get a connection to the database using the Connection Class
        $config = require_once __DIR__ . '/../../app/config.php';

        $conn = new Connection;
        $conn = $conn::make($config['testdb']);

        $this->assertNotNull($conn);

        return $conn;
    }

    /**
     * @depends testConnection
     */
    public function testInsert(PDO $conn)
    {
        // Set up a QueryBuilder
        $db = new QueryBuilder($conn);

        // Clear the Posts table
        $db->clear('posts');

        // Add a post
        $post = [
            'author' => 'LRS',
            'title' => 'Test Post',
            'content' => 'This is a post created by the Unit test suite.',
            'published' => 1
        ];

        $id = $db->insert('posts', $post);

        // Add in the id for the test post
        $post['id'] = $id;

        // Get all posts.
        $posts = $db->selectAll('posts');

        // Need map the results to an array
        $mapped = array_map(function ($post) {
            return (array)$post;
        }, $posts);

        // The posts table should contain one post
        $this->assertEquals(1, count($mapped));

        // and be equal to the inserted post
        $this->assertEquals($post, $mapped[0]);
    }
}
