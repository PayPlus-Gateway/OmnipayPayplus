<?php
namespace Omnipay\Payplus\Message\TransactionReference;

use Omnipay\Payplus\Message\Request;

class TransactionReferenceRequest extends Request
{
    public function getData()
    {
        $data = [];
        if ($this->httpRequest->query->get('transaction_uid')) {
            $data['transaction_uid'] = $this->httpRequest->query->get('transaction_uid');
        } else if ($this->httpRequest->query->get('page_request_uid')) {
            $data['payment_request_uid'] = $this->httpRequest->query->get('page_request_uid');
        }

        $moreInfo = $this->httpRequest->query->get('more_info');
        if (is_numeric($moreInfo)) {
            $moreInfo = (float) $moreInfo;
        }
        if ($this->httpRequest->query->get('more_info')) {
            $data['more_info'] = $moreInfo;
        }
        return $data;
    }

    public function setTransactionuid($value)
    {
        $this->setParameter('transaction_uid', $value);
    }

    public function setMoreinfo($value)
    {
        $this->setParameter('more_info', $value);
    }

    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    public function GetResponseClass() : string
    {
        return \Omnipay\Payplus\Message\TransactionReference\TransactionReferenceResponse::class;
    }

    public function getExpandedEndpoint()
    {
        return $this->getEndpoint() . 'PaymentPages/ipn';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }
}
