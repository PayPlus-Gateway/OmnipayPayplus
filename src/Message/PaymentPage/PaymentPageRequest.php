<?php
namespace Omnipay\Payplus\Message\PaymentPage;

use Omnipay\Payplus\Message\Request;

class PaymentPageRequest extends Request
{
    public function getData()
    {
        $chargeMethod = $this->getParameter('charge_method');
        if ($chargeMethod === 5) {
            $this->validate('currency', 'ppUid');
        } else {
            $this->validate('amount', 'currency', 'ppUid');
        }
        $req = [
            'payment_page_uid' => $this->getPpUid(),
            'amount' => $this->getAmount(),
            'currency_code' => $this->getCurrency(),
        ];
        if ($this->getAmount()) {
            $req['amount'] = $this->getAmount();
        }
        if ($this->getParameter('charge_method')) {
            $req['charge_method'] = $this->getParameter('charge_method');
        }
        if ($this->getParameter('charge_default')) {
            $req['charge_default'] = $this->getParameter('charge_default');
        }
        if ($this->getParameter('hide_other_charge_methods')) {
            $req['hide_other_charge_methods'] = $this->getParameter('hide_other_charge_methods');
        }
        if ($this->getParameter('hide_other_charge_methods')) {
            $req['hide_other_charge_methods'] = $this->getParameter('hide_other_charge_methods');
        }
        if ($this->getParameter('language_code')) {
            $req['language_code'] = $this->getParameter('language_code');
        }
        if ($this->getParameter('customer')) {
            $req['customer'] = $this->getParameter('customer');
        }
        if ($this->getParameter('items')) {
            $req['items'] = $this->getParameter('items');
        }
        if ($this->getParameter('refURL_success')) {
            $req['refURL_success'] = $this->getParameter('refURL_success');
        }
        if ($this->getParameter('create_token')) {
            $req['create_token'] = $this->getParameter('create_token');
        }
        if ($this->getParameter('more_info')) {
            $req['more_info'] = $this->getParameter('more_info');
        }
        if ($this->getParameter('token')) {
            $req['token'] = $this->getParameter('token');
        }
        return $req;
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function GetResponseClass() : string
    {
        if ($this->getParameter('token')) {
            return \Omnipay\Payplus\Message\TransactionReference\TransactionReferenceResponse::class;
        }
        return \Omnipay\Payplus\Message\PaymentPage\PaymentPageResponse::class;
    }

    public function setCardReference($value)
    {
        return $this->setParameter('token', $value);
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function setRefurlsuccess($value)
    {
        return $this->setParameter('refURL_success', $value);
    }

    public function setCreatetoken($value)
    {
        return $this->setParameter('create_token', $value);
    }

    public function setItems($value)
    {
        return $this->setParameter('items', $value);
    }

    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }

    public function setLanguagecode($value)
    {
        return $this->setParameter('language_code', $value);
    }

    public function setHideotherchargemethods($value)
    {
        return $this->setParameter('hide_other_charge_methods', $value);
    }

    public function setChargedefault($value)
    {
        return $this->setParameter('charge_default', $value);
    }
    public function setChargemethod($value)
    {
        return $this->setParameter('charge_method', $value);
    }

    public function getChargemethod()
    {
        return $this->getParameter('charge_method');
    }

    public function setMoreinfo($value)
    {
        return $this->setParameter('more_info', $value);
    }

    public function setPpuid($value)
    {
        return $this->setParameter('ppUid', $value);
    }

    public function setParameter($key, $value)
    {
        return parent::setParameter($key, $value);
    }


    public function getPpuid()
    {
        return $this->getParameter('ppUid');
    }

    public function getExpandedEndpoint()
    {
        return $this->getEndpoint() . 'PaymentPages/generateLink';
    }
}
