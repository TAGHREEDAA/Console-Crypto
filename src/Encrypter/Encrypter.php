<?php


namespace Crypto\Encrypter;


interface Encrypter
{
    public function encrypt($word);

    public function decrypt($word);
}