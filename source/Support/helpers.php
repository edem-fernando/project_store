<?php


##################
###   PRICES   ###
##################

/**
 * _TOBRL(): Converte qualquer número para o formato brasileiro
 * @param float $value
 * @return string
 */
function _toBrl(float $value) 
{
    return "R$ " . number_format($value, "2", ",", ".");
}


####################
###   VALIDATE   ###
####################

/**
 * IS_CPF(): Verifica se o CPF informado é válido
 * @param string $cpf
 * @return bool
 */
function is_cpf(string $cpf): bool 
{
    if (empty($cpf)) {
        return null;
    }
    
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true;
}

/**
 * IS_EMAIL(): verifica se o e-mail informado está válido
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool 
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * IS_PASSWD(): Verifica se a senha contém a quantidade de caracteres permitidos
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
 * PASSWD(): gera uma hash de senha
 * @param string $password
 * @return string
 */
function passwd(string $password): string 
{
    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * PASSWD_VERIFY(): verifica se a senha e a hash são compatíveis
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool 
{
    return password_verify($password, $hash);
}

/**
 * PASSWD_REHASH(): verifica se é necessário gerar outra hash
 * @param string $password
 * @return bool
 */
function passwd_rehash(string $password): bool 
{
    return password_needs_rehash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTIONS);
}

/**
 * CSRF_INPUT(): Cria um input com o value do csrf da classe Session para monitoramento
 * @return string
 */
function csrf_input(): string 
{
    session()->csrf();
    return "<input type='hidden' name='csrf' value='" . (session()->csrf_token ?? "") . "'/>";
}

/**
 * CSRF_VERIFY(): Verifica se os token's são iguais...
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
 * STR_SLUG(): Converte uma string para url
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
 * STR_STUDLY_CASE(): Converte uma string para o padrão Studlycase 
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
 * STR_CAMEL_CASE(): Converte uma string para o padrão camelCase 
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string 
{
    return lcfirst(str_studly_case($string));
}

/**
 * STR_CONVERT_TITLE(): Converte uma os primeiros caracteres das palavras
 * de uma string para maiúsculo
 * @param string $string
 * @return string
 */
function str_convert_title(string $string): string 
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * STR_LIMIT_WORDS(): Limita a quantidade de palavras em uma string
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
 * STR_LIMIT_CHARS(): Limita a quantidade de caracteres em uma string
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
 * url(): Retorna a url digitada concatenada com o caminho inteiro da aplicação, 
 * remove a "/", caso ela venha
 * @param string $path
 * @return string
 */
function url(string $path): string
{
    if ($path[0] == "/") {
        return CONF_URL_BASE . "/" . mb_substr($path, 1);
    } else {
        return CONF_URL_BASE . "/" . $path;
    }
}

/**
 * REDIRECT(): Direciona o usuário para a url informada
 * @param string $url
 * @return void
 */
function redirect(string $url): void 
{
    header("HTTP/1.1 302 Redirect");
    $location = url($url);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit();
    } else {
        header("Location: {$location}");
        exit();
    }
}


################
###   CORE   ###
################

/** @return PDO */
function db(): PDO 
{
    return \Source\Core\Conn::getInstance();
}

/** @return \Source\Core\Session */
function session(): \Source\Core\Session 
{
    return new \Source\Core\Session();
}

/** @return \Source\Core\Message */
function message(): \Source\Core\Message 
{
    return new \Source\Core\Message();
}


##################
###   MODELS   ###
##################

/** @return \Source\Models\User */
function user(): \Source\Models\User 
{
    return new \Source\Models\User();
}
