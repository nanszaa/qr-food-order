<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Transaction;

class MidtransService
{
    public static function checkStatus($orderId)
    {
        self::init();

        return Transaction::status($orderId);
    }

    public static function init()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public static function createCharge($order, $method)
    {
        self::init();

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => (int)$order->total_price,
            ]
        ];

        switch ($method) {

            case 'qris':
                $params['payment_type'] = 'qris';
                break;

            case 'bca':
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bca'
                ];
                break;

            case 'bni':
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bni'
                ];
                break;

            case 'bri':
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'bri'
                ];
                break;

            case 'permata':
                $params['payment_type'] = 'bank_transfer';
                $params['bank_transfer'] = [
                    'bank' => 'permata'
                ];
                break;

            case 'gopay':
                $params['payment_type'] = 'gopay';
                break;

            case 'shopeepay':
                $params['payment_type'] = 'shopeepay';
                break;
        }

        return CoreApi::charge($params);
    }
}