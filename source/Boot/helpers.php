<?php

##################
###   PRICES   ###
##################

/**
 * @param float $value
 * @return string
 */
function _toBrl(float $value): string 
{
    return "R$ " . number_format($value, "2", ",", ".");
}

/**
 * @param float $price
 * @return string
 */
function _toCleanPrice(string $price): string 
{
    $format_price = str_replace($price, ",", ".");
    return $format_price;
}

####################
###   VALIDATE   ###
####################

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool 
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $passwd
 * @return bool
 */
function is_passwd(string $passwd): bool 
{
    if (password_get_info($passwd)['algo']) {
        return true;
    }
    
    return (mb_strlen($passwd) >= CONF_PASSWD_MIN_LEN && mb_strlen($passwd) <= CONF_PASSWD_MAX_LEN ? true : false);
}

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string 
{
    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool 
{
    return password_verify($password, $hash);
}

/**
 * @param string $password
 * @return bool
 */
function passwd_rehash(string $password): bool 
{
    return password_needs_rehash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * @return string
 */
function csrf_input(): string 
{
    session()->csrf();
    return "<input type='hidden' name='csrf' value='" . (session()->csrf_token ?? "") . "'/>";
}

/**
 * @param array $request
 * @return bool
 */
function csrf_verify($request): bool 
{
    if (empty(session()->csrf_token) || empty($request['csrf']) || $request['csrf'] != session()->csrf_token) {
        return false;
    } else {
        return true;
    }
}

##################
###   STRING   ###
##################

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string 
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["----", "---", "--"], "-", str_replace(" ", "-", trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))));
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string 
{
    $string = str_slug($string);
    $studly_case = str_replace(" ", "", mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE));
    return $studly_case;
}

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string 
{
    return lcfirst(str_studly_case($string));
}

/**
 * @param string $string
 * @return string
 */
function str_convert_title(string $string): string 
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string 
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arr_words = explode(" ", $string);
    $num_words = count($arr_words);

    if ($num_words < $limit) {
        return $string;
    } else {
        $words = implode(" ", array_slice($arr_words, 0, $limit));
        return "{$words}{$pointer}";
    }
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string 
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

    if (mb_strlen($string) <= $limit) {
        return $string;
    } else {
        $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
        return "{$chars}{$pointer}";
    }
}

###############
###   URL   ###
###############

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string 
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        
        return CONF_URL_TEST;
    }

    if ($path) {
        CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    
    return CONF_URL_BASE;
}

/**
 * @return string
 */
function url_back(): string 
{
    return ($_SERVER["HTTP_REFERER"] ?? url());
}

/**
 * @param string|null $path
 * @return string
 */
function theme(string $path = null): string 
{
    if (strpos($_SERVER["HTTP_HOST"], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/themes/" . CONF_VIEW_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        
        return CONF_URL_TEST . "/themes/" . CONF_VIEW_THEME;
    }

    if ($path) {
        return CONF_URL_BASE . "/themes/" . CONF_VIEW_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    
    return CONF_URL_BASE . "/themes/" . CONF_VIEW_THEME;
}

/**
 * @param string $url
 * @return void
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$url}");
        exit;
    }
}

################
###   CORE   ###
################

/**
 * @return PDO 
 */
function db(): PDO 
{
    return \Source\Core\Conn::getInstance();
}

/**
 * @return \Source\Core\Session 
 */
function session(): \Source\Core\Session 
{
    return new \Source\Core\Session();
}

###################
###   SUPPORT   ###
###################

/**
 * @return \Source\Core\Message 
 */
function message(): \Source\Support\Message 
{
    return new \Source\Support\Message();
}

##################
###   MODELS   ###
##################

/**
 * @return \Source\Models\User 
 */
function user(): \Source\Models\User 
{
    return new \Source\Models\User();
}
