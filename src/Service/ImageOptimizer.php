<?php

namespace NormaUy\Bundle\NormaCMSBundle\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class ImageOptimizer
{
    private $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function widthResize(string $filename, int $width, string $newFilName = null): void
    {
        [$iwidth, $iheight] = getimagesize($filename);
        $ratio = $iwidth / $iheight;

        $height = $width / $ratio;

        $photo = $this->imagine->open($filename);
        $photo->resize(new Box($width, $height))->save($newFilName ? $newFilName : $filename);
    }

    public function resize(string $filename, int $width, int $height, string $newFilName = null): void
    {
        [$iwidth, $iheight] = getimagesize($filename);
        $ratio = $iwidth / $iheight;

        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $photo = $this->imagine->open($filename);
        $photo->resize(new Box($width, $height))->save($newFilName ? $newFilName : $filename);
    }

    public function gdAutoRotate($originalFile, $destinationFile = null)
    {
        if (is_file($originalFile)) {
            $originalExtension = strtolower(pathinfo($originalFile, PATHINFO_EXTENSION));
            if (isset($destinationFile) and $destinationFile != '') {
                $destinationExtension = strtolower(pathinfo($destinationFile, PATHINFO_EXTENSION));
            }

            // try to auto-rotate image by gd if needed (before editing it)
            // by imagemagik it has an easy option
            if (function_exists('exif_read_data')) {
                $exifData = exif_read_data($originalFile);
                $exifOrientation = isset($exifData['Orientation']) ? $exifData['Orientation'] : null;

                // value 1 = normal ?! skip it ?!

                if (
                    $exifOrientation &&
                    ($exifOrientation == '3' or $exifOrientation == '6' or $exifOrientation == '8')
                ) {
                    $newAngle[3] = 180;
                    $newAngle[6] = -90;
                    $newAngle[8] = 90;

                    // load the image
                    if ($originalExtension == 'jpg' or $originalExtension == 'jpeg') {
                        $originalImage = imagecreatefromjpeg($originalFile);
                    }
                    if ($originalExtension == 'gif') {
                        $originalImage = imagecreatefromgif($originalFile);
                    }
                    if ($originalExtension == 'png') {
                        $originalImage = imagecreatefrompng($originalFile);
                    }

                    $rotatedImage = imagerotate($originalImage, $newAngle[$exifOrientation], 0);

                    // if no destination file is set, then show the image
                    if (!$destinationFile) {
                        header('Content-type: image/jpeg');
                        imagejpeg($rotatedImage, null, 100);
                    }

                    // save the smaller image FILE if destination file given
                    if ($destinationExtension == 'jpg' or $destinationExtension == 'jpeg') {
                        imagejpeg($rotatedImage, $destinationFile, 100);
                    }
                    if ($destinationExtension == 'gif') {
                        imagegif($rotatedImage, $destinationFile);
                    }
                    if ($destinationExtension == 'png') {
                        imagepng($rotatedImage, $destinationFile, 9);
                    }

                    imagedestroy($originalImage);
                    imagedestroy($rotatedImage);
                }
            }
        }
    }
}
