<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\InvalidParserException;

interface ParserInterface
{
    const TYPE_XML = 'xml';
    const TYPE_JSON = 'json';

    /**
     * @return string
     */
    public static function getType(): string;

    /**
     * @param string $content
     * @return array
     * @throws InvalidParserException
     */
    public function parse(string $content): array;
}
