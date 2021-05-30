<?php

declare(strict_types=1);

namespace App\Parser;

class XmlParser extends ParserAbstract
{
    /**
     * @return string
     */
    public static function getType(): string
    {
        return self::TYPE_XML;
    }
}
