<?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace test\Mockery;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Generator\Method;
use test\Mockery\Fixtures\MethodWithNullableReturnType;

/**
 * @requires PHP 7.1.0RC3
 */
class MockingNullableMethodsTest extends MockeryTestCase
{
    /**
     * @var \Mockery\Container
     */
    private $container;

    protected function mockeryTestSetUp()
    {
        parent::mockeryTestSetUp();

        require_once __DIR__."/Fixtures/MethodWithNullableReturnType.php";
    }

    /**
     * @tests
     */
    public function itShouldAllowNonNullableTypeToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullablePrimitive')->andReturn('a string');
        $mock->nonNullablePrimitive();
    }

    /**
     * @tests
     */
    public function itShouldNotAllowNonNullToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullablePrimitive')->andReturn(null);
        $this->expectException(\TypeError::class);
        $mock->nonNullablePrimitive();
    }

    /**
     * @tests
     */
    public function itShouldAllowPrimitiveNullableToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullablePrimitive')->andReturn(null);
        $mock->nullablePrimitive();
    }

    /**
     * @tests
     */
    public function itShouldAllowPrimitiveNullableToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullablePrimitive')->andReturn('a string');
        $mock->nullablePrimitive();
    }

    /**
     * @tests
     */
    public function itShouldAllowSelfToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableSelf')->andReturn(new MethodWithNullableReturnType());
        $mock->nonNullableSelf();
    }

    /**
     * @tests
     */
    public function itShouldNotAllowSelfToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableSelf')->andReturn(null);
        $this->expectException(\TypeError::class);
        $mock->nonNullableSelf();
    }

    /**
     * @tests
     */
    public function itShouldAllowNullableSelfToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableSelf')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableSelf();
    }

    /**
     * @tests
     */
    public function itShouldAllowNullableSelfToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableSelf')->andReturn(null);
        $mock->nullableSelf();
    }

    /**
     * @tests
     */
    public function itShouldAllowClassToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nonNullableClass();
    }

    /**
     * @tests
     */
    public function itShouldNotAllowClassToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableClass')->andReturn(null);
        $this->expectException(\TypeError::class);
        $mock->nonNullableClass();
    }

    /**
     * @tests
     */
    public function itShouldAllowNullalbeClassToBeSet()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableClass();
    }

    /**
     * @tests
     */
    public function itShouldAllowNullableClassToBeNull()
    {
        $mock = mock("tests\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(null);
        $mock->nullableClass();
    }

    /** @tests */
    public function it_allows_returning_null_for_nullable_object_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableClass")->andReturnNull();

        $this->assertNull($double->nullableClass());
    }

    /** @tests */
    public function it_allows_returning_null_for_nullable_string_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableString")->andReturnNull();

        $this->assertNull($double->nullableString());
    }

    /** @tests */
    public function it_allows_returning_null_for_nullable_int_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableInt")->andReturnNull();

        $this->assertNull($double->nullableInt());
    }

    /** @tests */
    public function it_returns_null_on_calls_to_ignored_methods_of_spies_if_return_type_is_nullable()
    {
        $double = \Mockery::spy(MethodWithNullableReturnType::class);

        $this->assertNull($double->nullableClass());
    }
}
