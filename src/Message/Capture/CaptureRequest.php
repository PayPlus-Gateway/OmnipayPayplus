<?php
namespace Omnipay\Payplus\Message\Capture;

use Omnipay\Payplus\Message\Request;

class CaptureRequest extends Request
{
    public function getData()
    {
        $this->validate('transactionReference');
        return [
            'transaction_uid' => $this->getTransactionReference(),
            'amount' => $this->getParameter('amount')
        ];
    }

    public function setTransactionuid($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function GetResponseClass() : string
    {
        return \Omnipay\Payplus\Message\Capture\CaptureResponse::class;
    }

    public function getExpandedEndpoint()
    {
        return $this->getEndpoint() . 'Transactions/ChargeByTransactionUID';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }
}
