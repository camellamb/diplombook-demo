<?php

class Image
{
    public function generate_filename($length)
    {
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $text = "";

        for ($x = 0; $x < $length; $x++) {
            $random = rand(0, 61);
            $text .= $array[$random];
        }
        return $text;
    }

    public function crop_image($orig_file, $crop_file, $max_width, $max_heigth)
    {
        if (file_exists($orig_file)) {
            $orig_img = imagecreatefromjpeg($orig_file);

            $orig_width = imagesx($orig_img);
            $orig_heigth = imagesy($orig_img);

            if ($orig_heigth > $orig_width) {
                //make width equal to max width
                $ratio = $max_width / $orig_width;

                $new_width = $max_width;
                $new_heigth = $orig_heigth * $ratio;
            } else {
                //make heigth equal to max heigth
                $ratio = $max_heigth / $orig_heigth;

                $new_heigth = $max_heigth;
                $new_width = $orig_width * $ratio;
            }
        }

        //adjust incase max width and height are different
        if ($max_width != $max_heigth) {
            if ($max_heigth > $max_width) {
                if ($max_heigth > $new_heigth) {
                    $adjustment = $max_heigth / $new_heigth;
                } else {
                    $adjustment = $new_heigth / $max_heigth;
                }

                $new_width = $new_width * $adjustment;
                $new_heigth = $new_heigth * $adjustment;
            } else {
                if ($max_width > $new_width) {
                    $adjustment = $max_width / $new_width;
                } else {
                    $adjustment = $new_width / $max_width;
                }

                $new_width = $new_width * $adjustment;
                $new_heigth = $new_heigth * $adjustment;
            }
        }

        $new_image = imagecreatetruecolor($new_width, $new_heigth);
        imagecopyresampled($new_image, $orig_img, 0, 0, 0, 0, $new_width, $new_heigth, $orig_width, $orig_heigth);

        imagedestroy($orig_img);

        if ($max_width != $max_heigth) {

            if ($max_width > $max_heigth) {

                $diff = $new_heigth - $max_heigth;
                if ($diff < 0) {
                    $diff = $diff * -1;
                }
                $y = round($diff / 2);
                $x = 0;
            } else {

                $diff = $new_width - $max_heigth;
                if ($diff < 0) {
                    $diff = $diff * -1;
                }
                $x = round($diff / 2);
                $y = 0;
            }
        } else {

            if ($new_heigth > $new_width) {
                $diff = $new_heigth - $new_width;
                $y = round($diff / 2);
                $x = 0;
            } else {
                $diff = $new_width - $new_heigth;
                $x = round($diff / 2);
                $y = 0;
            }
        }

        $new_crop_img = imagecreatetruecolor($max_width, $max_heigth);
        imagecopyresampled($new_crop_img, $new_image, 0, 0, $x, $y, $max_width, $max_heigth, $max_width, $max_heigth);
        imagedestroy($new_image);

        imagejpeg($new_crop_img, $crop_file, 90);
        imagedestroy($new_crop_img);
    }

    //resize the image
    public function resize_image($orig_file, $resize_file, $max_width, $max_heigth)
    {
        if (file_exists($orig_file)) {
            $orig_img = imagecreatefromjpeg($orig_file);

            $orig_width = imagesx($orig_img);
            $orig_heigth = imagesy($orig_img);

            if ($orig_heigth > $orig_width) {
                //make width equal to max width
                $ratio = $max_width / $orig_width;

                $new_width = $max_width;
                $new_heigth = $orig_heigth * $ratio;
            } else {
                //make heigth equal to max heigth
                $ratio = $max_heigth / $orig_heigth;

                $new_heigth = $max_heigth;
                $new_width = $orig_width * $ratio;
            }
        }

        //adjust incase max width and height are different
        if ($max_width != $max_heigth) {
            if ($max_heigth > $max_width) {
                if ($max_heigth > $new_heigth) {
                    $adjustment = $max_heigth / $new_heigth;
                } else {
                    $adjustment = $new_heigth / $max_heigth;
                }

                $new_width = $new_width * $adjustment;
                $new_heigth = $new_heigth * $adjustment;
            } else {
                if ($max_width > $new_width) {
                    $adjustment = $max_width / $new_width;
                } else {
                    $adjustment = $new_width / $max_width;
                }

                $new_width = $new_width * $adjustment;
                $new_heigth = $new_heigth * $adjustment;
            }
        }

        $new_image = imagecreatetruecolor($new_width, $new_heigth);
        imagecopyresampled($new_image, $orig_img, 0, 0, 0, 0, $new_width, $new_heigth, $orig_width, $orig_heigth);

        imagedestroy($orig_img);

        imagejpeg($new_image, $resize_file, 90);
        imagedestroy($new_image);
    }

    //create thumbnail for cover image
    public function get_thumb_cover($filename) {
        $thumbnail = $filename . "_cover_thumb.jpg";

        if(file_exists($thumbnail)) {
            return $thumbnail;
        }

        $this->crop_image($filename, $thumbnail, 1366, 488);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }

    //create thumbnail for profile image
    public function get_thumb_profile($filename) {
        $thumbnail = $filename . "_profile_thumb.jpg";

        if(file_exists($thumbnail)) {
            return $thumbnail;
        }

        $this->crop_image($filename, $thumbnail, 600, 600);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }

    //create thumbnail for post image
    public function get_thumb_post($filename) {
        $thumbnail = $filename . "_post_thumb.jpg";

        if(file_exists($thumbnail)) {
            return $thumbnail;
        }

        $this->crop_image($filename, $thumbnail, 600, 600);

        if(file_exists($thumbnail)) {
            return $thumbnail;
        } else {
            return $filename;
        }
    }
}