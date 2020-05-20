<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

/**
 * Class Seo: utiliza o componente Optimizer do packgist para gerar
 * o SEO de uma página WEB, servindo tags para Facebook, Twitter cards etc
 * @package Source\Support;
 */
class Seo 
{
    /** @var Optimizer */
    protected $optimizer;
    
    /**
     * @param $name
     * @return mixed
     */ 
    public function __get($name)
    {
        return $this->optimizer->data()->$name;
    }
    
    /**
     * Seo Class
     * @param string $schema
     */
    public function __construct(string $schema = "article")
    {
        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
                CONF_SITE_NAME,
                CONF_SITE_LANG,
                $schema
        )->twitterCard(
                CONF_SOCIAL_TWITTER_CREATOR,
                CONF_SOCIAL_TWITTER_PUBLISHER,
                CONF_SITE_DOMAIN
        )->publisher(
                CONF_SOCIAL_FACEBOOK_PAGE,
                CONF_SOCIAL_FACEBOOK_AUTHOR,
                ""
        )->facebook(
                CONF_SOCIAL_FACEBOOK_APP
        );
    }
    
    /**
     * render(): monta e retorna a string de HTML
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param bool $follow
     * @return string
     */
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string 
    {
        $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }
    
    /**
     * @return Optimizer
     */
    public function optimizer(): Optimizer
    {
        return $this->optimizer;
    }
    
    /**
     * @param string $title
     * @param string $desc
     * @param string $url
     * @param string $image
     * @return object | null
     */
    public function data(string $title = null, string $desc = null, string $url = null, string $image = null): ?object
    {
        return $this->optimizer->data($title, $desc, $url, $image);
    }
}
