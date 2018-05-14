<?php
/**
 * @author Eduardo Aguilar <dante.aguilar41@gmail.com>
 */

namespace CompropagoSdk\Factory;

use CompropagoSdk\Client;
use CompropagoSdk\Factory\Models\CpOrderInfo;
use CompropagoSdk\Factory\Models\Customer;
use CompropagoSdk\Factory\Models\EvalAuthInfo;
use CompropagoSdk\Factory\Models\Exchange;
use CompropagoSdk\Factory\Models\FeeDetails;
use CompropagoSdk\Factory\Models\InstructionDetails;
use CompropagoSdk\Factory\Models\Instructions;
use CompropagoSdk\Factory\Models\NewOrderInfo;
use CompropagoSdk\Factory\Models\OrderInfo;
use CompropagoSdk\Factory\Models\PlaceOrderInfo;
use CompropagoSdk\Factory\Models\Provider;
use CompropagoSdk\Factory\Models\SmsData;
use CompropagoSdk\Factory\Models\SmsInfo;
use CompropagoSdk\Factory\Models\SmsObject;
use CompropagoSdk\Factory\Models\Webhook;

/**
 * Class Serialize
 * @package CompropagoSdk\Factory
 */
class Serialize
{
    /**
     * Create an instance of CpOrderInfo Object
     * @param array $data
     * @return CpOrderInfo
     */
    public static function cpOrderInfo($data=array())
    {
        if (empty($data)) {
            return new CpOrderInfo();
        } else {
            $obj = new CpOrderInfo();

            $obj->id          = $data['id'];
            $obj->short_id    = $data['short_id'];
            $obj->type        = $data['type'];
            $obj->object      = empty($data['object']) ? null : $data['object'];
            $obj->livemode    = empty($data['livemode']) ? null : $data['livemode'];
            $obj->created_at  = empty($data['created_at']) ? null : $data['created_at'];
            $obj->accepted_at = empty($data['accepted_at']) ? null : $data['accepted_at'];
            $obj->expires_at  = empty($data['expires_at']) ? null : $data['expires_at'];
            $obj->paid        = empty($data['paid']) ? null : $data['paid'];
            $obj->amount      = empty($data['amount']) ? null : $data['amount'];
            $obj->currency    = empty($data['currency']) ? null : $data['currency'];
            $obj->refunded    = empty($data['refunded']) ? null : $data['refunded'];
            $obj->fee         = empty($data['fee']) ? null : $data['fee'];
            $obj->fee_details = self::feeDetails($data['fee_details']);
            $obj->order_info  = self::orderInfo($data['order_info']);
            $obj->customer    = self::customer($data['customer']);
            $obj->api_version = $data['api_version'];

            return $obj;
        }
    }

    /**
     * Create an instance of Customer Object
     * @param array $data
     * @return Customer
     */
    public static function customer($data=array())
    {
        if (empty($data)) {
            return new Customer();
        } else {
            $obj = new Customer();

            $obj->customer_name  = empty($data['customer_name']) ? null : $data['customer_name'];
            $obj->customer_email = empty($data['customer_email']) ? null : $data['customer_email'];
            $obj->customer_phone = empty($data['customer_phone']) ? null : $data['customer_phone'];

            return $obj;
        }
    }

    /**
     * Create an instance of EvalAuthInfo Object
     * @param array $data
     * @return EvalAuthInfo
     */
    public static function evalAuthInfo($data=array())
    {
        if (empty($data)) {
            return new EvalAuthInfo();
        } else {
            $obj = new EvalAuthInfo();

            $obj->type     = empty($data['type']) ? null : $data['type'];
            $obj->code     = empty($data['code']) ? null : $data['code'];
            $obj->message  = empty($data['message']) ? null : $data['message'];
            $obj->livemode = empty($data['livemode']) ? null : $data['livemode'];
            $obj->mode_key = empty($data['mode_key']) ? null : $data['mode_key'];

            return $obj;
        }
    }

    /**
     * Create an instance FeeDetails Object
     * @param array $data
     * @return FeeDetails
     */
    public static function feeDetails($data=array())
    {
        if (empty($data)) {
            return new FeeDetails();
        } else {
            $obj = new FeeDetails();

            $obj->tax             = isset($data['tax']) ? $data['tax'] : null;
            $obj->type            = isset($data['type']) ? $data['type'] : null;
            $obj->amount          = isset($data['amount']) ? $data['amount'] : null;
            $obj->currency        = isset($data['currency']) ? $data['currency'] : null;
            $obj->application     = isset($data['application']) ? $data['application'] : null;
            $obj->amount_refunded = isset($data['amount_refunded']) ? $data['amount_refunded'] : null;

            return $obj;
        }
    }

    /**
     * Create an instance of InstructionDetails Object
     * @param array $data
     * @return InstructionDetails
     */
    public static function instructionDetails($data=array())
    {
        if (empty($data)) {
            return new InstructionDetails();
        } else {
            $obj = new InstructionDetails();

            $obj->store                    = empty($data['store']) ? null : $data['store'];
            $obj->amount                   = empty($data['amount']) ? null : $data['amount'];
            $obj->bank_name                = empty($data['bank_name']) ? null : $data['bank_name'];
            $obj->payment_store            = empty($data['payment_store']) ? null : $data['payment_store'];
            $obj->payment_amount           = empty($data['payment_amount']) ? null : $data['payment_amount'];
            $obj->bank_reference           = empty($data['bank_reference']) ? null : $data['bank_reference'];
            $obj->company_bank_number      = empty($data['company_bank_number']) ? null : $data['company_bank_number'];
            $obj->bank_account_number      = empty($data['bank_account_number']) ? null : $data['bank_account_number'];
            $obj->order_reference_number   = empty($data['order_reference_number']) ? null : $data['order_reference_number'];
            $obj->company_reference_name   = empty($data['company_reference_name']) ? null : $data['company_reference_name'];
            $obj->bank_account_holder_name = empty($data['bank_account_holder_name']) ? null : $data['bank_account_holder_name'];
            $obj->company_reference_number = empty($data['company_reference_number']) ? null : $data['company_reference_number'];

            return $obj;
        }
    }

    /**
     * Create an instance of Instructions Object
     * @param array $data
     * @return Instructions
     */
    public static function instructions($data=array())
    {
        if (empty($data)) {
            return new Instructions();
        } else {
            $obj = new Instructions();

            $obj->description          = empty($data['description']) ? null : $data['description'];
            $obj->step_1               = empty($data['step_1']) ? null : $data['step_1'];
            $obj->step_2               = empty($data['step_2']) ? null : $data['step_2'];
            $obj->step_3               = empty($data['step_3']) ? null : $data['step_3'];
            $obj->note_extra_comition  = empty($data['note_extra_comition']) ? null : $data['note_extra_comition'];
            $obj->note_expiration_date = empty($data['note_expiration_date']) ? null : $data['note_expiration_date'];
            $obj->note_confirmation    = empty($data['note_confirmation']) ? null : $data['note_confirmation'];
            $obj->details              = self::instructionDetails($data['details']);

            return $obj;
        }
    }

    /**
     * Create an instance of NewOrderInfo Object
     * @param array $data
     * @return NewOrderInfo
     */
    public static function newOrderInfo($data=array())
    {
        if (empty($data)) {
            return new NewOrderInfo();
        } else {
            $obj = new NewOrderInfo();

            $obj->id           = $data['id'];
            $obj->short_id     = $data['short_id'];
            $obj->type         = $data['type'];
            $obj->object       = empty($data['object']) ? null : $data['object'];
            $obj->livemode     = empty($data['livemode']) ? null : $data['livemode'];
            $obj->created_at   = empty($data['created_at']) ? null : $data['created_at'];
            $obj->accepted_at  = empty($data['accepted_at']) ? null : $data['accepted_at'];
            $obj->expires_at   = empty($data['expires_at']) ? null : $data['expires_at'];
            $obj->paid         = empty($data['paid']) ? null : $data['paid'];
            $obj->amount       = empty($data['amount']) ? null : $data['amount'];
            $obj->currency     = empty($data['currency']) ? null : $data['currency'];
            $obj->refunded     = empty($data['refunded']) ? null : $data['refunded'];
            $obj->fee          = empty($data['fee']) ? null : $data['fee'];
            $obj->fee_details  = self::feeDetails($data['fee_details']);
            $obj->order_info   = self::orderInfo($data['order_info']);
            $obj->customer     = self::customer($data['customer']);
            $obj->instructions = self::instructions($data['instructions']);
            $obj->api_version  = $data['api_version'];

            return $obj;
        }
    }

    /**
     * Create an instance of Exchange Object
     * @param array $data
     * @return Exchange
     */
    public static function exchange($data=array())
    {
        if (empty($data)) {
            return new Exchange();
        } else {
            $obj = new Exchange();

            $obj->rate            = empty($data['rate']) ? null : $data['rate'];
            $obj->request         = empty($data['request']) ? null : $data['request'];
            $obj->exchange_id     = empty($data['exchange_id']) ? null : $data['exchange_id'];
            $obj->final_amount    = empty($data['final_amount']) ? null : $data['final_amount'];
            $obj->origin_amount   = empty($data['origin_amount']) ? null : $data['origin_amount'];
            $obj->final_currency  = empty($data['final_currency']) ? null : $data['final_currency'];
            $obj->origin_currency = empty($data['origin_currency']) ? null : $data['origin_currency'];

            return $obj;
        }
    }

    /**
     * Create an instance of OrderInfo Object
     * @param array $data
     * @return OrderInfo
     */
    public static function orderInfo($data=array())
    {
        if (empty($data)) {
            return new OrderInfo();
        } else {
            $obj = new OrderInfo();

            $obj->order_id       = isset($data['order_id']) ? $data['order_id'] : null;
            $obj->order_name     = isset($data['order_name']) ? $data['order_name'] : null;
            $obj->order_price    = isset($data['order_price']) ? $data['order_price'] : null;
            $obj->payment_method = isset($data['payment_method']) ? $data['payment_method'] : null;
            $obj->store          = isset($data['store']) ? $data['store'] : null;
            $obj->country        = isset($data['country']) ? $data['country'] : null;
            $obj->image_url      = isset($data['image_url']) ? $data['image_url'] : null;
            $obj->success_url    = isset($data['success_url']) ? $data['success_url'] : null;
            $obj->failed_url     = isset($data['failed_url']) ? $data['failed_url'] : null;
            $obj->exchage        = self::exchange($data['exchange']);

            return $obj;
        }
    }

    /**
     * Create an instance of PlaceOrderInfo Object
     * @param array $data
     * @return PlaceOrderInfo
     */
    public static function placeOrderInfo($data=array())
    {
        if (empty($data)) {
            return new PlaceOrderInfo(null, null, null, null, null);
        } else {
            $customerPhone    = empty($data['custome_phone']) ? null : $data['custome_phone'];
            $paymentType      = empty($data['payment_type']) ? 'OXXO' : $data['payment_type'];
            $currency         = empty($data['currency']) ? 'MXN' : $data['currency'];
            $expirationTime   = empty($data['expiration_time']) ? null : $data['expiration_time'];
            $imageUrl         = empty($data['image_url']) ? '': $data['image_url'];
            $appClientName    = empty($data['app_client_name']) ? 'phpsdk' : $data['app_client_name'];
            $appClientVersion = empty($data['app_client_version']) ? Client::VERSION : $data['app_client_version'];
            $extras           = empty($data['extras']) ? null : $data['extras'];

            return new PlaceOrderInfo(
                $data['order_id'],
                $data['order_name'],
                $data['order_price'],
                $data['customer_name'],
                $data['customer_email'],
                $customerPhone,
                $paymentType,
                $currency,
                $expirationTime,
                $imageUrl,
                $appClientName,
                $appClientVersion,
                $extras
            );
        }
    }

    /**
     * Create an instance of Provider Object
     * @param array $data
     * @return Provider
     */
    public static function provider($data=array())
    {
        if (empty($data)) {
            return new Provider();
        } else {
            $obj = new Provider();

            $obj->internal_name     = empty($data['internal_name']) ? null : $data['internal_name'];
            $obj->availability      = empty($data['availability']) ? null : $data['availability'];
            $obj->name              = empty($data['name']) ? null : $data['name'];
            $obj->rank              = empty($data['rank']) ? null : $data['rank'];
            $obj->transaction_limit = empty($data['transaction_limit']) ? null : $data['transaction_limit'];
            $obj->commission        = empty($data['commission']) ? null : $data['commission'];
            $obj->is_active         = empty($data['is_active']) ? null : $data['is_active'];
            $obj->store_image       = empty($data['store_image']) ? null : $data['store_image'];
            $obj->image_small       = empty($data['image_small']) ? null : $data['image_small'];
            $obj->image_medium      = empty($data['image_medium']) ? null : $data['image_medium'];

            return $obj;
        }
    }

    /**
     * Create an instance of SmsData Object
     * @param array $data
     * @return SmsData
     */
    public static function smsData($data=array())
    {
        if (empty($data)) {
            return new SmsData();
        } else {
            $obj = new SmsData();

            $obj->object = self::smsObject($data['object']);

            return $obj;
        }
    }

    /**
     * Create an instance of SmsInfo Object
     * @param array $data
     * @return SmsInfo
     */
    public static function smsInfo($data=array())
    {
        if (empty($data)) {
            return new SmsInfo();
        } else {
            $obj = new SmsInfo();

            $obj->type   = empty($data['type']) ? null : $data['type'];
            $obj->object = empty($data['object']) ? null : $data['object'];
            $obj->data   = self::smsData($data['data']);

            return $obj;
        }
    }

    /**
     * Create an instance of SmsObject Object
     * @param array $data
     * @return SmsObject
     */
    public static function smsObject($data=array())
    {
        if (empty($data)) {
            return new SmsObject();
        } else {
            $obj = new SmsObject();

            $obj->id       = empty($data['id']) ? null : $data['id'];
            $obj->short_id = empty($data['short_id']) ? null : $data['short_id'];
            $obj->object   = empty($data['object']) ? null : $data['object'];

            return $obj;
        }
    }

    /**
     * Create an instance of Webhook Object
     * @param array $data
     * @return Webhook
     */
    public static function webhook($data=array())
    {
        if (empty($data)) {
            return new Webhook();
        } else {
            $obj = new Webhook();

            $obj->id     = isset($data['id']) ? $data['id'] : null;
            $obj->url    = isset($data['url']) ? $data['url'] : null;
            $obj->mode   = isset($data['mode']) ? $data['mode'] : null;
            $obj->status = isset($data['status']) ? $data['status'] : null;
            $obj->type   = isset($data['type']) ? $data['type'] : null;

            return $obj;
        }
    }
}