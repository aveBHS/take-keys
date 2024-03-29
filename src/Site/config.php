<?php

const FILTER_RECOMMENDATIONS_CONFIG = 1;
const FILTER_CATALOG = 2;
const FILTER_NONE = 0;

const EARTH_RADIUS = 6372795;

const MONTHS_RP = [
    "jan"  => "января",
    "feb"  => "февраля",
    "mar"  => "марта",
    "apr"  => "апреля",
    "may"  => "мая",
    "jun" => "июня",
    "jul" => "июля",
    "aug"  => "августа",
    "sep" => "сентября",
    "oct"  => "октября",
    "nov"  => "ноября",
    "dec"  => "декабря"
];

const DATE_FILTER_HOURS = [0,12,24,48,72,168,720];
const DATE_FILTER_HOURS_DEFAULT = DATE_FILTER_HOURS[2];

// Menu pages slugs
const UNDEFINED_PAGE = null;
const LK_NOTIFIES_PAGE = "notifies";
const LK_FAVORITES_PAGE = "favorites";
const LK_RECENT_PAGE = "recent";
const LK_RECOMMENDATIONS_PAGE = "recommendations";

// Calls statues
const OBJECT_CALL_NEW = 0;
const OBJECT_CALL_IN_PROCESS = 1;
const OBJECT_CALL_DONE = 2;
const OBJECT_CALL_RETRY = 3;
const OBJECT_CALL_FAILED = 4;

// Call results
const OBJECT_CALL_RESULT_NONCALL = 1;
const OBJECT_CALL_RESULT_LIMIT = 2;
const OBJECT_CALL_RESULT_IRRELEVANT = 3;
const OBJECT_CALL_RESULT_ACTUAL_HAVE_COMMISSION  = 4;
const OBJECT_CALL_RESULT_ACTUAL = 5;
const OBJECT_CALL_RESULT_AGENT = 6;

// Object deal type
const OBJECT_RENT_TYPE = 1;
const OBJECT_SELL_TYPE = 2;

// Poster statuses
const POSTER_NEW_STATUS = 0;
const POSTER_IN_WORK_STATUS = 1;
const POSTER_ACTIVE_STATUS = 2;

// Messengers communication scenarios
const MESSENGER_SCENARIOS = [
    "Сейчас есть минутка, можете позвонить по этому номеру +79637562077 и обсудить вопросы.\n\nЕсли удобнее общаться в чате, можем познакомиться в чате - в таком случае расскажите пожалуйста по подробнее о себе, с кем будете жить, на какой срок хотите заселиться и когда готовы посмотреть.",
    "Отправляю прямую ссылку для связи с владельцем и подробные условия обслуживания:\n[URL]\n\nОзнакомьтесь, если все устроит связывайтесь и договаривайтесь с этим и другими владельцами пока пока предложения ещё актуальны!\n\nЕсли, что пишите в чат на сайте операторы с радостью вам помогут."
];