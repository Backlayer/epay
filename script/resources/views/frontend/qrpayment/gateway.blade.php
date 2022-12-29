@extends('payment.gateway', [
    "source" => (object) [
        'uuid' => $user->qr,
        'currency_id' => user_currency()->id,
        'currency' => user_currency()
    ],
    "formRoute" => 'frontend.qr.payment'
])
