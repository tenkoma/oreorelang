<?php
declare(strict_types=1);

namespace Tenkoma\OreOreLang;

class Lexer
{
    public function parse(string $text): array
    {
        $tokens = [];
        $length = mb_strlen($text);
        for ($i = 0; $i < $length;) {
            $values = [];
            $char = mb_substr($text, $i, 1);
            if (ctype_digit($char)) {
                // 数字である場合
                for (; ctype_digit($char = mb_substr($text, $i, 1)) && $i < $length; $i++) {
                    $values[] = $char;
                }
                $tokens[] = [
                    $values,
                    'number'
                ];
            } elseif ($char === ' ') {
                for (; ($char = mb_substr($text, $i, 1)) === ' ' && $i < $length; $i++) {
                    $values[] = $char;
                }
                $tokens[] = [
                    $values,
                    'spaces'
                ];
            } elseif ($char === '+') {
                $tokens[] = [
                    'add_operator'
                ];
                $i++;
            }
        }
        return $tokens;
    }
}