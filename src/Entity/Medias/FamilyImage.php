<?php

namespace App\Entity\Medias;

/**
 * Gestion Family image entity description file
 *
 * @author Philippe Basuyau <geronimo8080@gmail.com>
 */

use App\Entity\Medias\Tools\ImageSize;
use Doctrine\ORM\Mapping as ORM;

/**
 * Gestion Family Image Entity
 *
 * @ORM\Table("media_image")
 * @ORM\Entity()
 * @ORM\MappedSuperclass
 */
class FamilyImage extends FamilyFile
{

    protected $clearName = "Pictures management";

    /**
     * Size of Image in pixels
     *
     * @var ImageSize
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $originalSize;

    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
    }

    public function generateMetadata($withHash = true)
    {
        parent::generateMetadata($withHash);

        if ($this->originalSize == null) {
            $is = getimagesize($this->filePath);

            $this->originalSize = new ImageSize();

            $this->originalSize->setWidth($is[0]);
            $this->originalSize->setHeight($is[0]);
        }
    }

    /**
     * Get Orginal ImageSize
     *
     * @return  ImageSize
     */
    public function getOriginalSize()
    {
        return $this->originalSize;
    }

    /**
     * Set Orginal ImageSize
     *
     * @param  ImageSize  $originalSize  Undocumented variable
     *
     * @return  self
     */
    public function setOriginalSize(ImageSize $originalSize)
    {
        $this->originalSize = $originalSize;

        return $this;
    }
} //--- Fin de la class FamilyImage
