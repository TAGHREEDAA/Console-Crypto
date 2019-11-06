<?php


namespace Crypto\Encrypter;


use GuzzleHttp\Client;

class ReverseEncrypter implements Encrypter
{
    public function encrypt($word)
    {
        $response = $this->sendRequest('POST', 'http://backendtask.robustastudio.com/encode', ['string' => $word]);
        return $response;
    }

    public function decrypt($word)
    {
        $response = $this->sendRequest('POST', 'http://backendtask.robustastudio.com/decode', ['string' => $word]);
        return $response;
    }

    private function sendRequest($method, $url, $params)
    {
        $response = (new Client())->request($method, $url, ['form_params' => $params]);

        if ($response->getStatusCode() === 200 && $response->hasHeader('Content-Length')) {
            $result = json_decode($response->getBody()->getContents());
            return [
                'success' => [
                    'data' => $result->string,
                    'code' => $response->getStatusCode()
                ]
            ];
        } else {
            return [
                'error' => [
                    'message' => $response->getReasonPhrase(),
                    'code' => $response->getStatusCode()
                ]
            ];
        }
    }
}