<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v11/services/invoice_service.proto

namespace Google\Ads\GoogleAds\V11\Services;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Response message for [InvoiceService.ListInvoices][google.ads.googleads.v11.services.InvoiceService.ListInvoices].
 *
 * Generated from protobuf message <code>google.ads.googleads.v11.services.ListInvoicesResponse</code>
 */
class ListInvoicesResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The list of invoices that match the billing setup and time period.
     *
     * Generated from protobuf field <code>repeated .google.ads.googleads.v11.resources.Invoice invoices = 1;</code>
     */
    private $invoices;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Ads\GoogleAds\V11\Resources\Invoice[]|\Google\Protobuf\Internal\RepeatedField $invoices
     *           The list of invoices that match the billing setup and time period.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V11\Services\InvoiceService::initOnce();
        parent::__construct($data);
    }

    /**
     * The list of invoices that match the billing setup and time period.
     *
     * Generated from protobuf field <code>repeated .google.ads.googleads.v11.resources.Invoice invoices = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * The list of invoices that match the billing setup and time period.
     *
     * Generated from protobuf field <code>repeated .google.ads.googleads.v11.resources.Invoice invoices = 1;</code>
     * @param \Google\Ads\GoogleAds\V11\Resources\Invoice[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setInvoices($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Ads\GoogleAds\V11\Resources\Invoice::class);
        $this->invoices = $arr;

        return $this;
    }

}

