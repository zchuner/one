<?php
return [
    1 => [
        'urlruleid' => '1',
        'module' => 'content',
        'file' => 'category',
        'ishtml' => '1',
        'urlrule' => '{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html',
        'example' => 'news/law/1000.html',
    ],
    2 => [
        'urlruleid' => '2',
        'module' => 'content',
        'file' => 'show',
        'ishtml' => '1',
        'urlrule' => '{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html',
        'example' => 'news/law/2010/0720/1_2.html',
    ],
    3 => [
        'urlruleid' => '3',
        'module' => 'content',
        'file' => 'show',
        'ishtml' => '0',
        'urlrule' => 'show/{$catid}/{$id}/{$page}.html',
        'example' => 'show/1/2/1.html',
    ],
    4 => [
        'urlruleid' => '4',
        'module' => 'content',
        'file' => 'category',
        'ishtml' => '0',
        'urlrule' => 'list/{$catid}/{$page}.html',
        'example' => 'category/1/1.html',
    ],
];