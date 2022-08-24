<?php
namespace Omnipay\Payplus\Message\Capture;

use Omnipay\Payplus\Message\Response;
use stdClass;

class CaptureResponse extends Response {
    protected function init() {
        parent::init();
        $this->data = new stdClass;
        if (isset($this->responseObject->results->status) && $this->responseObject->results->status === 'success') {
            if (isset($this->responseObject->data)) {
                $this->data = $this->responseObject->data;
            }
        }
    }
    public function isRedirect()
    {
        return false;
    }
    public function isSuccessful()
    {
        return (isset($this->data->transaction) && $this->data->transaction->status_code === '000');
    }

    public function getMessage()
    {
        if (isset($this->data->transaction->status_description) && $this->data->transaction->status_description) {
            return $this->data->transaction->status_description;
        }
        return parent::getMessage();
    }
    public function getTransactionReference()
    {
        return ($this->data->transaction->uid ?? null);
    }
}