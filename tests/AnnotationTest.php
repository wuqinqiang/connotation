<?php

namespace Remember\Annotations\Tests;

use Remember\Annotations;
use PHPUnit\Framework\TestCase;
use Remember\Annotations\Tests\Status\ErrorCode;

class AnnotationTest extends TestCase
{
    public function testGetMessage()
    {
        $res = ErrorCode::GetMessage(ErrorCode::ENUM_INVALID_TOKEN);
        $this->assertEquals('参数错误2', $res);
    }
}