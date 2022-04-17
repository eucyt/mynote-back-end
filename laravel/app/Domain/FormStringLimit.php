<?php

namespace App\Domain;

/**
 * フォームの文字数制限に関するドメインオブジェクト
 */
class FormStringLimit
{
    /** @var int DBのvarchar(255)のカラムのフォーム上での文字数制限 */
    const VARCHAR_COLUMN_LIMIT = 255;
}
