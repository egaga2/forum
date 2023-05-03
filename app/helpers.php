<?php
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        // ...
    }
}
if (!function_exists('str_slug')) {
    function str_slug($string, $delimiter = '-')
    {
        $string = Str::slug($string);
        if ($string !== '') {
            $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
            $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
        }
        return $string;

    }
}
if (!function_exists('format_number_in_k')) {
    function format_number_in_k(int $number): string
    {
        $suffixByNumber = function () use ($number) {
            if ($number < 1000) {
                return sprintf('%d', $number);
            }

            if ($number < 1000000) {
                return  round($number / 1000, 1).'K';
                //return sprintf('%d%s', floor($number / 1000), 'K+');
            }

            if ($number >= 1000000 && $number < 1000000000) {
                return  round($number / 1000000, 1).'M';
                //return sprintf('%d%s', floor($number / 1000000), 'M+');
            }

            if ($number >= 1000000000 && $number < 1000000000000) {
                return  round($number / 1000000000, 1).'B';
                //return sprintf('%d%s', floor($number / 1000000000), 'B+');
            }

            return  round($number / 1000000000000, 1).'T';
           // return sprintf('%d%s', floor($number / 1000000000000), 'T+');
        };

        return $suffixByNumber();
    }
}
if (!function_exists('timeAgo')) {
    function timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "just now";
        } //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hour ago";
            } else {
                return "$hours hrs ago";
            }
        } //Days
//        else if ($days <= 7) {
//            if ($days == 1) {
//                return "yesterday";
//            } else {
//                return "$days days ago";
//            }
//        }
// //Weeks
//        else if ($weeks <= 4.3) {
//            if ($weeks == 1) {
//                return "a week ago";
//            } else {
//                return "$weeks weeks ago";
//            }
//        } //Months
//        else if ($months <= 12) {
//            if ($months == 1) {
//                return "a month ago";
//            } else {
//                return "$months months ago";
//            }
//        } //Years

        else {
            return date('d F, Y', $time_ago);
        }
    }
}
if (!function_exists('encodeContent')) {
    function encodeContent($content)
    {
        return htmlspecialchars(trim($content), ENT_QUOTES | ENT_HTML5);
    }
}
if (!function_exists('decodeContent')) {
    function decodeContent($content)
    {

        $content = str_replace('&lt;blockquote&gt;','&lt;blockquote&gt;&lt;pre&gt;&lt;code&gt;',$content);
        $content = str_replace('&lt;/blockquote&gt;','&lt;/blockquote&gt;&lt;/pre&gt;&lt;/code&gt;',$content);
        //$content = str_replace('&amp;nbsp;','',$content);
        return stripcslashes(htmlspecialchars_decode($content,ENT_QUOTES));

    }
}