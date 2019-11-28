<?php

namespace Tenkoma\OreOreLang;

class Parser
{
    public function parse(array $tokens): array
    {
        $currentLeft = null;
        $currentType = null;
        foreach ($tokens as $token) {
            if ($token[1] === 'number') {
                if (is_null($currentLeft)) {
                    $currentLeft = [implode("", $token[0]), "type" => $token[1]];
                } else {
                    $currentLeft = [
                        'type' => $currentType,
                        'right' => [implode("", $token[0]), "type" => $token[1]],
                        'left' => $currentLeft,
                    ];
                    $currentType = null;
                }
            } else if ($token[0] === 'plus_operator') {
                $currentType = 'plus_operator';
            }
        }

        return [$currentLeft];
    }
}