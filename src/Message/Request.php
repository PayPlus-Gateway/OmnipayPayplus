<?php
namespace Omnipay\Payplus\Message;

use Omnipay\Common\Message\AbstractRequest;

abstract class Request extends AbstractRequest
{
    public $gatewayParameters;
    public function sendData($data)
    {
        $responseClass = $this->getResponseClass();
        $r = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getExpandedEndpoint(),
            [ 
                "Authorization" =>json_encode([
                    'api_key' => $this->gatewayParameters['apiKey'],
                    'secret_key' => $this->gatewayParameters['secretKey']
                ]),
                'Content-Type' => 'application/json'
            ],
            json_encode($data)
        );
        return $this->response = new $responseClass($this, $r);
    }

    abstract public function GetResponseClass() :string;

    abstract public function getHttpMethod();

    abstract public function getExpandedEndpoint();

    protected function getEndpoint()
    {
        $dev = ($this->getTestMode()) ? 'dev' : '';
        return "https://restapi$dev.payplus.co.il/api/v1.0/";
    }
    
}
