<?php

declare(strict_types=1);

namespace App\Tests\Parser;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use App\Parser\XmlParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

/**
 * @internal
 */
final class XmlParserTest extends TestCase
{
    /**
     * @var XmlParser
     */
    private $parser;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $baseParser = new XmlEncoder();
        $this->parser = new XmlParser($baseParser);
    }

    public function testGetType(): void
    {
        $this->assertSame($this->parser::getType(), ParserInterface::TYPE_XML);
    }

    /**
     * @dataProvider getDataProvider
     * @throws \App\Exception\InvalidParserException
     */
    public function testParse(string $data, array $expectedResults): void
    {
        $result = $this->parser->parse($data);
        $this->assertEquals($result, $expectedResults);
    }

    /**
     * @return \Generator
     */
    public function getDataProvider(): \Generator
    {
        yield 'supplier 1 data' => [
            'xml' => '<?xml version="1.0" encoding="UTF-8"?>
<products>
    <product>
        <id>123-456-1</id>
        <name>Product 1</name>
        <desc>Product 1 description</desc>
    </product>
    <product>
        <id>123-456-2</id>
        <name>Product 2</name>
        <desc>Product 2 description</desc>
    </product>
    </products>',

            'expected_attributes' => [
                'product' => [
                    [
                        'id' => '123-456-1',
                        'name' => 'Product 1',
                        'desc' => 'Product 1 description'
                    ],
                    [
                        'id' => '123-456-2',
                        'name' => 'Product 2',
                        'desc' => 'Product 2 description'
                    ],
                ],
            ],
        ];

        yield 'supplier 2 data' => [
            'xml' => '<?xml version="1.0" encoding="UTF-8"?>
<items>
    <item>
        <key>CC-123-456-1</key>
        <title>Product 1</title>
        <description>Product 1 description</description>
    </item>
    <item>
        <key>CC-123-456-2</key>
        <title>Product 2</title>
        <description>Product 2 description</description>
    </item></items>',

            'expected_attributes' => [
                'item' => [
                    [
                        'key' => 'CC-123-456-1',
                        'title' => 'Product 1',
                        'description' => 'Product 1 description'
                    ],
                    [
                        'key' => 'CC-123-456-2',
                        'title' => 'Product 2',
                        'description' => 'Product 2 description'
                    ],
                ],
            ],
        ];
    }

    public function testParseException(): void
    {
        $this->expectException(InvalidParserException::class);
        $result = $this->parser->parse('wrong data');
    }
}
