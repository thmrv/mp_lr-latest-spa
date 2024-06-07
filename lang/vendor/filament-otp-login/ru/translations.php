<?php

return [
    'otp_code' => 'Одноразовый код',

    'mail' => [
        'subject' => 'Одноразовый код',
        'greeting' => 'Добрый день,',
        'line1' => 'Ваш одноразовый код: :code',
        'line2' => 'Он будет валидным :seconds секунд.',
        'line3' => 'Если вы не запрашивали код, рекомендуем обратить внимание на то, кто может запрашивать доступ вместо вас..',
        'salutation' => 'Megaputer',
    ],

    'view' => [
        'time_left' => 'секунд осталось',
        'resend_code' => 'Отправить новый',
        'verify' => 'Подтвердить',
        'go_back' => 'Назад',
    ],

    'notifications' => [
        'title' => 'Код отправлен',
        'body' => 'Он должен придти на административную почту и будет рабочим в течение :seconds секунд.',
    ],

    'validation' => [
        'invalid_code' => 'Код указан неверно.',
        'expired_code' => 'Код уже недействителен.',
    ],
];