<?php
namespace Omnipay\Payplus\Message\CreditcardReference;

use Omnipay\Payplus\Message\Request;

class CreditcardReferenceRequest extends Request
{
    public function getData()
    {
        $this->validate('cardReference');
        return [];
    }

    public function setCardReference($value)
    {
        return $this->setParameter('cardReference', $value);
    }

    public function GetResponseClass() : string
    {
        return \Omnipay\Payplus\Message\CreditcardReference\CreditcardReferenceResponse::class;
    }

    public function getExpandedEndpoint()
    {
        return $this->getEndpoint() . 'Token/Check/' . $this->getCardReference();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
