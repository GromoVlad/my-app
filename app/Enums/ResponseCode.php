<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Http коды возврата
 *
 * @method static OK
 * @method static CREATED
 * @method static BAD_REQUEST
 * @method static UNAUTHORIZED
 * @method static AUTHORITY_NO_ACCESS_RIGHTS
 * @method static NOT_FOUND
 * @method static ALREADY_EXISTS
 * @method static APPLICATION_ERROR
 */
class ResponseCode extends BaseEnum
{
    /** Ок */
    const OK = 200;
    /** Создано */
    const CREATED = 201;
    /** Некорректный запрос */
    const BAD_REQUEST = 400;
    /** Не авторизован */
    const UNAUTHORIZED = 401;
    /** Нет прав доступа */
    const AUTHORITY_NO_ACCESS_RIGHTS = 403;
    /** Не найдено */
    const NOT_FOUND = 404;
    /** Уже существует */
    const ALREADY_EXISTS = 409;
    /** Ошибка приложения */
    const APPLICATION_ERROR = 500;
}
