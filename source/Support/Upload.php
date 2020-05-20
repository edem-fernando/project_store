<?php

namespace Source\Support;

use Source\Support\Message;
use CoffeeCode\Uploader\Image;
use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Media;

class Upload 
{
    /** @var Message */
    private $message;
    
    /**
     * Class Upload
     */
    public function __construct() 
    {
        $this->message = new Message();
    }
    
    /**
     * image(): Upa uma imagem para o servidor
     * imagens permitidos:
     * jpeg, png, gif
     * @param array $image
     * @param string $name
     * @param int $width
     * @return string | null
     * @throws \Exception
     */
    public function image(array $image, string $name, int $width = CONF_IMAGES_SIZE): ?string
    {
        $upload = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);
        if (empty($image["type"]) || !in_array($image["type"], $upload::isAllowed())) {
            $this->message()->error("Você não selecionou uma imagem válida!");
            return null;
        }

        return $upload->upload($image, $name, $width, CONF_IMAGES_QUALITY);
    }
    
    /**
     * file(): Upa um arquivo para o servidor
     * arquivos permitidos:
     * zip, rar, bz, pdf, doc, docx
     * @param array $file
     * @param string $name
     * @return string | null
     * @throws \Exception
     */
    public function file(array $file, string $name): ?string
    {
        $upload = new File(CONF_UPLOAD_DIR, CONF_UPLOAD_FILE_DIR);
        if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
            $this->message()->error("Você não selecionou um arquivo válido!");
            return null;
        }

        return $upload->upload($file, $name);
    }
    
    /**
     * media(): Upa uma mídia para o servidor, 
     * mídeas permitidos: 
     * mp3 e mp4
     * @param array $media
     * @param string $name
     * @return string | null
     * @throws \Exception
     */
    public function media(array $media, string $name): ?string
    {
        $upload = new Media(CONF_UPLOAD_DIR, CONF_UPLOAD_MEDIA_DIR);
        if (empty($media["type"]) || !in_array($media["type"], $upload::isAllowed())) {
            $this->message()->error("Você não selecionou uma mídea válida!");
            return null;
        }

        return $upload->upload($media, $name);
    }
    
    /**
     * remove(): Remove um arquivo via caminho do arquivo
     * @param strin $file_path
     * @return void
     */
    public function remove(string $file_path): void
    {
        if (file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
    }
    
    /** 
     * @return Message 
     */
    public function message(): Message
    {
        return $this->message;
    }
}
