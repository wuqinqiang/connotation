### 说明

**由于看到一个注解的小项目挺有意思,因此自己也创建一个包玩(cao)下(xi)**

### 安装
```php
composer require remember/annotations -vvv
```

### 使用
```php
class Test extends \Remember\Annotations\Annotation
{
    /**
     * @Message("你是假的")
     */
    const ENUM_INVALID_TOKEN=800;
}

$message=Test::getMessage(Test::ENUM_INVALID_TOKEN);
```

**输出 你是假的**

