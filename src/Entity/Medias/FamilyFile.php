<?php

namespace App\Entity\Medias;

/**
 * Gestion Family file entity description file
 *
 * @author Philippe Basuyau <geronimo808@gmail.com>
 */

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Gestion Family File Entity
 *
 * @ORM\Table("family_file")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\MappedSuperclass
 *
 */
class FamilyFile
{

    protected $clearName = "Files management";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=2048)
     */
    protected $basePath;
    /**
     * @ORM\Column(type="string", length=2048)
     */
    protected $filePath;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $extension;
    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $fileSize = 0;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createTime;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $fileHash;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $mimeType;

    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;

        if (!file_exists($this->basePath)) {
            mkdir($this->basePath, $mode = 0775, true);
        }
    }

    public function LoadFile($originalPath, $moveFile = true, $newName = "")
    {
        if ($newName == "") {
            $this->name = basename($originalPath);
        } else {
            $this->name = $newName;
        }
    }

    public function move(string $originalPath)
    {
        try {
            $this->filePath = $this->basePath . "/" . $this->name;
            rename($originalPath, $this->filePath);
            return true;
        } catch (Exception $ex) {
            $this->filePath = $originalPath;
            throw new Exception('Error on file move : ' . $ex->getMessage());
        }

        return false;
    }

    protected function generateMetadata($withHash = true)
    {
        $this->mimeType = mime_content_type($this->filePath);
        $this->extension = pathinfo($this->filePath)['extension'];
        $this->fileSize = filesize($this->filePath);

        $this->createTime = new DateTime(
            date('Y-m-d H:i:s', filectime($this->filePath))
        );

        if ($withHash == true) {
            $this->makeHash();
        }
    }

    public function makeHash()
    {
        $this->fileHash = md5_file($this->filePath);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of basePath
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Set the value of basePath
     *
     * @return  self
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Get the value of filePath
     */
    public function getFilePath()
    {

        $final = explode('public/', $this->filePath);

        if (count($final) > 1) {
            return $final[1];
        }

        return "";
    }

    /**
     * Set the value of filePath
     *
     * @return  self
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(?string $name)
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set the value of extension
     *
     * @return  self
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get the value of fileSize
     */
    public function getFileSize()
    {
        return (int) $this->fileSize;
    }

    /**
     * Set the value of fileSize
     *
     * @return  self
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get the value of createTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set the value of createTime
     *
     * @return  self
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get the value of fileHash
     */
    public function getFileHash()
    {
        return $this->fileHash;
    }

    /**
     * Set the value of fileHash
     *
     * @return  self
     */
    public function setFileHash($fileHash)
    {
        $this->fileHash = $fileHash;

        return $this;
    }

    /**
     * Get the value of mimeType
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set the value of mimeType
     *
     * @return  self
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get the value of clearName
     */
    public function getClearName()
    {
        return $this->clearName;
    }

    /**
     * Set the value of clearName
     *
     * @return  self
     */
    public function setClearName($clearName)
    {
        $this->clearName = $clearName;

        return $this;
    }

    public static function HumanSize($size, $startExtention = "Mo")
    {
        $extension = array("o", "Ko", "Mo", "Go", "To", "Po");
        $extensionIndex = 0;

        foreach ($extension as $ext) {
            $extensionIndex++;

            if ($ext == $startExtention) {
                break;
            }
        }

        $finalSize = $size;

        while ($finalSize >= 1024 && is_numeric($finalSize)) {
            $finalSize = $finalSize / 1024;
            $extensionIndex++;
        }

        return number_format($finalSize) . $extension[$extensionIndex];
    }

    public static function LimitSize($size, $finalExtention = "Mo")
    {
        $extension = array("o", "Ko", "Mo", "Go", "To", "Po");
        $extensionIndex = 0;
        $finalSize = $size;

        while ($finalSize >= 1024 && is_numeric($finalSize)) {
            $finalSize = $finalSize / 1024;
            $extensionIndex++;
            if ($extension[$extensionIndex] == $finalExtention) {
                return $finalSize;
            }
        }

        return $finalSize;
    }
} //--- Fin de la  class FamilyFile
