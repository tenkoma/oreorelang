<?php
declare(strict_types=1);
namespace Tests;

use Tenkoma\OreOreLang\Lexer;

class LexerTest extends \PHPUnit\Framework\TestCase
{
    public function testParse()
    {
        $text = '1 + 2 + 3';
        $lexer = new Lexer();
        $result = $lexer->parse($text);
        $expected = [
            [["1"], "number"],
            [[" "], "spaces"],
            ["add_operator"],
            [[" "], "spaces"],
            [["2"], "number"],
            [[" "], "spaces"],
            ["add_operator"],
            [[" "], "spaces"],
            [["3"], "number"],
        ];
        $this->assertSame($expected, $result);
    }
}