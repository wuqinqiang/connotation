<?php
namespace Remember\Annotations\Tests\Status;
use Remember\Annotations\Annotation;

class ErrorCode extends Annotation
{
    /**
     * @Message("你是假的")
     */
    const ENUM_INVALID_TOKEN=800;
}