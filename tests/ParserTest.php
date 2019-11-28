<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tenkoma\OreOreLang\Parser;

class ParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new Parser();

        $tokens = [
            [["1"], "number"],
            [[" "], "spaces"],
            ["plus_operator"],
            [[" "], "spaces"],
            [["2"], "number"],
            [[" "], "spaces"],
            ["plus_operator"],
            [[" "], "spaces"],
            [["3"], "number"],
        ];
        $tree = [
            [
                "type" => "plus_operator",
                "right" => ["3", "type" => "number"],
                "left" => [
                    "type" => "plus_operator",
                    "right" => ["2", "type" => "number"],
                    "left" => ["1", "type" => "number"],
                ],
            ]
        ];
        $this->assertSame($tree, $parser->parse($tokens));
    }
}