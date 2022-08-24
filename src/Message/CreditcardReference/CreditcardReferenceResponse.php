<?php
namespace Omnipay\Payplus\Message\CreditcardReference;

use Omnipay\Payplus\Message\Response;
use stdClass;

class CreditcardReferenceResponse extends Response {
    protected function init() {
        parent::init();
        $this->data = new stdClass;
        if (isset($this->responseObject->results->status) && $this->responseObject->results->status === 'success') {
            if (isset($this->responseObject)) {
                $this->data = $this->responseObject->data;
            }
        }
    }

    public function getTransactionId() {
        return $this->data->transaction_uid;
    }

    public function getToken() {
        if (isset($this->data->token_uid)) {
            return $this->data->token_uid;
        }
        return null;
    }

    public function isRedirect()
    {
        return false;
    }
    public function isSuccessful()
    {
        $requestParameters = $this->request->getParameters();
        if ($requestParameters && $requestParameters['cardReference']) {
            return ($this->data->token_uid !== null && $this->data->token_uid === $requestParameters['cardReference']);
        }
        return false;
    }

    public function getMessage()
    {
        if (isset($this->data->status_description) && $this->data->status_description) {
            return $this->data->status_description;
        }
        return parent::getMessage();
    }
    public function getTransactionReference()
    {
        return ($this->data->transaction_uid ?? null);
    }
}
