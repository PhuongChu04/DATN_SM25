<?php

return [
    'tmn_code' => env('VNP_TMN_CODE', 'GMWGIATS'), // Mã Merchant của bạn
    'hash_secret' => env('VNP_HASH_SECRET', 'HAYRFRPMGWTJ776A3JOJSBHBAG2DR7DJ'), // Secret key của bạn
    'url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',  // URL thanh toán VNPay
    'return_url' => 'http://localhost/vnpay_php/vnpay_return.php',  // URL trả về sau khi thanh toán
    'api_url' => 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',  // API URL của VNPay
    'transaction_api_url' => 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction', // API giao dịch
    'start_time' => date('YmdHis'),
    'expire_time' => date('YmdHis', strtotime('+15 minutes', strtotime(date('YmdHis')))),
];
