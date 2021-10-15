<?php
namespace App\Entity\Medias\Tools;

class ImageSize
{
    private $width = 0;

    private $height = 0;

    public function __construct($stringImageSize = '')
    {
        if ($stringImageSize != '') {
            $tmp = explode('x', $stringImageSize);
            $this->width = $tmp[0];
            $this->height = $tmp[1];
        }
    }

    public function __toString()
    {
        return $this->width . 'x' . $this->height;
    }

    /**
     * Get the value of width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
} //--- Fin de la class ImageSize
