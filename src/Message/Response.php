<?php
namespace Omnipay\Payplus\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use RuntimeException;

/**
 * Payplus Response
 *
 * This is the response class for all Payplus requests.
 *
 * @see \Omnipay\Payplus\Gateway
 */
abstract class Response extends AbstractResponse
{

    public $responseObject;
    protected $success = false;
    private $bodyContents;
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->init();
    }

    protected function init() {
        $this->bodyContents = $this->data->getBody()->getContents();
        if (!$this->bodyContents) {
            return;
        }
        $this->responseObject = json_decode($this->bodyContents);
        if ($this->responseObject === null) {
            return;
        }
    }

    public function getMessage()
    {
        if ($this->responseObject === null) {
            return $this->bodyContents;
        }
        if (isset($this->responseObject->message)) {
            return $this->responseObject->message;
        }

        if (isset($this->responseObject->results->description)) {
            return $this->responseObject->results->description;
        }

        if (isset($this->responseObject->data->status_description)) {
            return $this->responseObject->data->status_description;
        }
        return '';
    }

    public function getCode()
    {
        if ($this->responseObject === null) {
            return '';
        }
        if (isset($this->responseObject->results->code)) {
            return $this->responseObject->results->code;
        }

        if (isset($this->responseObject->data->status_code)) {
            return $this->responseObject->data->status_code;
        }
        return '';
    }
}
