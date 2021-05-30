<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\InvalidParserException;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

abstract class ParserAbstract implements ParserInterface
{
    /**
     * @var DecoderInterface
     */
    private DecoderInterface $baseParser;

    /**
     * @param DecoderInterface $baseParser
     */
    public function __construct(DecoderInterface $baseParser)
    {
        $this->baseParser = $baseParser;
    }

    /**
     * @return string
     */
    abstract static function getType(): string;

    /**
     * @param string $content
     * @return array
     * @throws InvalidParserException
     */
    public function parse(string $content): array
    {
        try {
            return $this->baseParser->decode($content, static::getType());
        } catch (NotEncodableValueException $e) {
            throw new InvalidParserException();
        }
    }
}
