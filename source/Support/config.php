<?php

##################################
##   CONTATANTES DA APLICAÇÃO   ##
##################################

// DATABASE
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "project_store");

// URL
define("CONF_URL_BASE", "https://localhost/project_store");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");
define("CONF_URL_ADMIN", CONF_URL_BASE . "/admin");

// DATA
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y/m/d H:i:s");

// SESSÕES
define("CONF_SESS_PATH", __DIR__ . "/../../storage/sessions");

// ERROR
define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");

// PASSWORD
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTIONS", ["cost" => 10]);