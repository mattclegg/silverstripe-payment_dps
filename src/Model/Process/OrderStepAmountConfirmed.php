<?php

namespace Sunnysideup\PaymentDps\Forms\Process;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use Sunnysideup\Ecommerce\Interfaces\OrderStepInterface;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\Process\OrderStep;
use Sunnysideup\PaymentDps\DpsPxPayPaymentRandomAmount;
use SilverStripe\Control\Controller;

/**
 * @authors: Nicolaas [at] Sunny Side Up .co.nz
 * @package: ecommerce
 * @sub-package: model

 **/
class OrderStepAmountConfirmed extends OrderStep implements OrderStepInterface
{
    private static $defaults = [
        'CustomerCanEdit' => 0,
        'CustomerCanCancel' => 0,
        //the one below may seem a bit paradoxical, but the thing is that the customer can pay up to and inclusive of this step
        //that ist he code PAID means that the Order has been paid ONCE this step is completed
        'CustomerCanPay' => 0,
        'Name' => 'Amount Confirmed',
        'Code' => 'AMOUNTCONFIRMED',
        'ShowAsInProcessOrder' => 1,
    ];

    /**
     * A form that can be used by the Customer to progress step!
     * @param Controller $controller
     * @param string     $name
     * @param Order      $order
     * @return \SilverStripe\Forms\Form|null (CustomerOrderStepForm)
     **/
    public function CustomerOrderStepForm(Controller $controller, string $name, Order $order)
    {
        return CustomerOrderStepForm::create($controller, $name, $order);
    }

    /**
     *initStep:
     * makes sure the step is ready to run.... (e.g. check if the order is ready to be emailed as receipt).
     * should be able to run this function many times to check if the step is ready.
     *
     * @see Order::doNextStatus
     *
     * @param Order $order object
     *
     * @return bool - true if the current step is ready to be run...
     **/
    public function initStep(Order $order)
    {
        return true;
    }

    /**
     *doStep:
     * should only be able to run this function once
     * (init stops you from running it twice - in theory....)
     * runs the actual step.
     *
     * @see Order::doNextStatus
     *
     * @param Order $order object
     *
     * @return bool - true if run correctly.
     **/
    public function doStep(Order $order)
    {
        return true;
    }

    /**
     * can go to next step if order has been paid.
     *
     * @see Order::doNextStatus
     *
     * @param Order $order
     *
     * @return OrderStep|null (next step OrderStep object)
     **/
    public function nextStep(Order $order)
    {
        $canDo = true;
        if ($this->hasAmountValidation($order)) {
            return $this->hasAmountConfirmed($order);
        }
        if($canDo) {
            return parent::nextStep($order);
        }

        return null;
    }

    /**
     * Allows the opportunity for the Order Step to add any fields to Order::getCMSFields.
     *
     *@param FieldList $fields
     *@param Order $order
     *
     *@return \SilverStripe\Forms\FieldList
     **/
    public function addOrderStepFields(FieldList $fields, Order $order)
    {
        $fields = parent::addOrderStepFields($fields, $order);
        if (! $order->IsPaid()) {
            $msg = _t(
                'OrderStep.AMOUNTNOTCONFIRMED',
                '
                    This order can not be completed, because it requires the customer to confirm the amount
                    deducted from their credit card.
                '
            );
            $fields->addFieldToTab('Root.Next', new LiteralField('NotPaidMessage', '<p>' . $msg . '</p>'), 'ActionNextStepManually');
        }

        return $fields;
    }

    /**
     * Explains the current order step.
     *
     * @return string
     */
    protected function myDescription()
    {
        return _t('OrderStep.PAID_DESCRIPTION', 'The order amount charged is confirmed by customer.');
    }

    public function hasAmountValidation($order) : bool
    {
        foreach($order->Payments() as $payment) {
            if($payment) {
                if($payment instanceof DpsPxPayPaymentRandomAmount) {
                    return $payment->RandomDeduction > 0;
                }
            }
        }
        return false;
    }

    public function relevantPayments(Order $order)
    {
        return $order->Payments()->filter(
            [
                'ClassName' => DpsPxPayPaymentRandomAmount::class,
                'Status' => EcommercePayment::SUCCESS_STATUS,
            ]
        );
    }

    public function hasAmountConfirmed(Order $order) : bool
    {
        return $order->OrderStatusLogs()->filter(
            [
                'ClassName' => OrderStepAmountConfirmedLog::class,
                'IsValid' => true
            ]
        )->count() ? true : false;
    }

}
