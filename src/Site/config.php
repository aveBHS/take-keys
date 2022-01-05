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