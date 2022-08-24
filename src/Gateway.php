<?php
namespace Omnipay\Payplus;

use Omnipay\Common\AbstractGateway;
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Payplus';
    }

    public function getDefaultParameters()
    {
        return [
            'apiKey'=> '',
            'secretKey' => ''
        ];
    }

    public function setPpuid($value)
    {
        return $this->setParameter('ppUid', $value);
    }

    public function setApikey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function setSecretkey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function setTestmode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function authorize(array $parameters = [])
    {
        $parameters['charge_method'] = 2;
        return $this->createRequest(\Omnipay\Payplus\Message\PaymentPage\PaymentPageRequest::class, $parameters);
    }

    public function purchase(array $parameters = [])
    {
        $parameters['charge_method'] = 1;
        return $this->createRequest(\Omnipay\Payplus\Message\PaymentPage\PaymentPageRequest::class, $parameters);
    }

    public function completeAuthorize(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\TransactionReference\TransactionReferenceRequest::class, $parameters);
    }


    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\TransactionReference\TransactionReferenceRequest::class, $parameters);
    }

    public function capture(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\Capture\CaptureRequest::class, $parameters);
    }

    public function acceptNotification($parameters = []){
        return $this->createRequest(\Omnipay\Payplus\Message\TransactionReference\TransactionReferenceRequest::class, $parameters);
    }

    public function refund(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\Refund\RefundRequest::class, $parameters);
    }

    public function void(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\TransactionReference\TransactionReferenceRequest::class, $parameters);
    }

    public function createCard(array $parameters = [])
    {
        if (isset($parameters['cardReference'])) {
            return $this->createRequest(\Omnipay\Payplus\Message\CreditcardReference\CreditcardReferenceRequest::class, $parameters);
        }
        $parameters['charge_method'] = 5;
        return $this->createRequest(\Omnipay\Payplus\Message\PaymentPage\PaymentPageRequest::class, $parameters);
    }

    public function updateCard(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\CardReferenceRequest::class, $parameters);
    }

    public function deleteCard(array $parameters = [])
    {
        return $this->createRequest(\Omnipay\Payplus\Message\CardReferenceRequest::class, $parameters);
    }

    public function fetchTransaction($options = []) {
        return $this->createRequest(\Omnipay\Payplus\Message\TransactionReference\TransactionReferenceRequest::class, $options);
    }

    protected function createRequest($class, array $parameters)
    {
        $obj = new $class($this->httpClient, $this->httpRequest);
        $obj->gatewayParameters = $this->getParameters();
        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }
}

