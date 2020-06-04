<?php

namespace Source\Support;

use CoffeeCode\Cropper\Cropper;

/**
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
    
    /**=
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
