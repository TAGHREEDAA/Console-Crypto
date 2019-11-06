<?php


namespace Crypto\Encrypter;


class ShiftEncrypter implements Encrypter
{
    public function encrypt($word)
    {
        $response = $this->shiftSentenceBy($word, 3);
        return $response;
    }

    public function decrypt($word)
    {
        $response = $this->shiftSentenceBy($word, 23);
        return $response;
    }
    private function shiftSentenceBy($word, $step)
    {
        if (trim($word) === "") {
            return [
                'error' => [
                    'message' => 'Empty string can not be encrypted',
                    'code' => 400 // missing data
                ]
            ];
        }
        else {
            $result = '';
            $AAscii = ord('A'); // 65
            $aAscii = ord('a'); // 97

            for ($i = 0; $i < strlen($word); $i++) {
                $currentLetter = $word[$i];

                if ($currentLetter === ' ') {
                    $result .= $currentLetter;
                }
                elseif (ctype_upper($currentLetter)) {
                    $result .= chr((ord($currentLetter) + $step - $AAscii) % 26 + $AAscii);
                }
                else {
                    $result .= chr((ord($currentLetter) + $step - $aAscii) % 26 + $aAscii);
                }
            }

            return [
                'success' => [
                    'data' => $result,
                    'code' => 200
                ]
            ];
        }
    }
}