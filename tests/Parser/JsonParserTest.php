<?php

declare(strict_types=1);

namespace App\Tests\Parser;

use App\Exception\InvalidParserException;
use App\Parser\JsonParser;
use App\Parser\ParserInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * @internal
 */
final class JsonParserTest extends TestCase
{
    /**
     * @var JsonParser
     */
    private $parser;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $baseParser = new JsonEncoder();
        $this->parser = new JsonParser($baseParser);
    }

    public function testGetType(): void
    {
        $this->assertSame($this->parser::getType(), ParserInterface::TYPE_JSON);
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
            'json' => '{
  "list": [
    {
      "id": "999-ABC-DEF-1",
      "name": "Product 1"
    },
    {
      "id": "999-ABC-DEF-2",
      "name": "Product 2"
    },
    {
      "id": "999-ABC-DEF-3",
      "name": "Product 3"
    }
  ]
}',

            'expected_attributes' => [
                'list' => [
                    [
                        'id' => '999-ABC-DEF-1',
                        'name' => 'Product 1',
                    ],
                    [
                        'id' => '999-ABC-DEF-2',
                        'name' => 'Product 2',
                    ],
                    [
                        'id' => '999-ABC-DEF-3',
                        'name' => 'Product 3',
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
