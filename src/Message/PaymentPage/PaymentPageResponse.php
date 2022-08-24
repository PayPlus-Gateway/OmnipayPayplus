<?php
namespace Omnipay\Payplus\Message\PaymentPage;

use Omnipay\Payplus\Message\Response;
use RuntimeException;

class PaymentPageResponse extends Response {
    public $redirectURL;
    protected function init() {
        
        parent::init();
        if (isset($this->responseObject->results->status) && $this->responseObject->results->status === 'success') {
            if (isset($this->responseObject->data->payment_page_link) && $this->responseObject->data->payment_page_link) {
                $this->redirectURL = $this->responseObject->data->payment_page_link;
                return;
            }
        }
    }
    public function isRedirect()
    {
        return ($this->redirectURL !== null);
    }

    public function getRedirectUrl()
    {
        return $this->redirectURL;
    }

    public function isSuccessful()
    {
        return false;
    }

    protected function validateRedirect() {
        if (empty($this->getRedirectUrl())) {
            throw new RuntimeException('The given redirectUrl cannot be empty.');
        }

        if (!in_array($this->getRedirectMethod(), ['GET', 'POST'])) {
            throw new RuntimeException('Invalid redirect method "'.$this->getRedirectMethod().'".');
        }
    }
}