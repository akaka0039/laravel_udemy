<?php

namespace App\Constants;

class Common
{
    // 在庫数_追加
    const PRODUCT_ADD = '1';
    // 在庫数＿削減
    const PRODUCT_REDUCE = '2';

    const PRODUCT_LIST = [
        'add' => self::PRODUCT_ADD,
        'reduce' => self::PRODUCT_REDUCE
    ];
}
