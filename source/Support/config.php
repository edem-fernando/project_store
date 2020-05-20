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

// VIEWS
define("CONF_VIEW_PATH", __DIR__ ."/../../assets/views");
define("CONF_VIEW_EXT", "php");

// PASSWORD
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTIONS", ["cost" => 10]);

// MAIL
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASSWD", "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");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_SENDER", ["name" => "Core Company", "address" => "edem.fbc@gmail.com"]);
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

// UPLOADS
define("CONF_UPLOAD_DIR", "../../storage/uploads");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

// IMAGES
define("CONF_IMAGES_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGES_SIZE", 2000);
define("CONF_IMAGES_QUALITY", ["jpg" => 75, "png" => 5]);

// SITE
define("CONF_SITE_NAME", "Core Company");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "https://localhost/project_store");

// SOCIAL
// depois de pronto trocar app do facebook
define("CONF_SOCIAL_TWITTER_CREATOR", "@EdemBastos");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@EdemBastos");
define("CONF_SOCIAL_FACEBOOK_APP", "865324750639571");
define("CONF_SOCIAL_FACEBOOK_PAGE", "edem.fernando.7");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "edem.fernando.7");
