<?php

namespace Source\Support;

use CoffeeCode\Cropper\Cropper;

/**
 * Class Thumb: utiliza o componente Cropper do packgist para gerar
 * miniaturas de imagens e liberar cache dessas imagens
 * @package Source\Support
 */
class Thumb 
{
    /** @var Cropper */
    private $cropper;
    
    /** @var string */
    private $uploads;
    
    /**
     * Thumb Constructor
     */
    public function __construct() 
    {
        $this->cropper = new Cropper(CONF_IMAGES_CACHE, CONF_IMAGES_QUALITY["jpg"], CONF_IMAGES_QUALITY["png"]);
        $this->uploads = CONF_UPLOAD_DIR;
    }
    
    /**
     * make(): gera a miniatura da image
     * @param string $image
     * @param int $width
     * @param int $heigth
     * @return string
     */
    public function make(string $image, int $width, int $heigth): string
    {
        return $this->cropper->make("{$this->uploads}/$image", $width, $heigth);
    }
    
    /**
     * flush(): libera cach para imagens, caso não seja passado o 
     * caminho ele liberará todas as imagens
     * @param string $image
     * @return void
     */
    public function flush(string $image = null): void
    {
        if ($image) {
            $this->cropper->flush("{$this->uploads}/{$image}");
            return;
        }
        $this->cropper->flush();
        return;
    }
    
    /**
     * @return Cropper
     */
    public function cropper(): Cropper
    {
        return $this->cropper;
    }
}
