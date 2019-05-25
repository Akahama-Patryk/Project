<?php


class Upload
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function uploadFile()
    {
        if (!empty($this->file)) {
            $filename = $this->file['name'];
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $filesize = $this->file['size'];
            $allowed_file_types = array('.jpg', '.tif', '.gif', '.png');
            if ($filesize <= 200000) {
                if (in_array($file_ext, $allowed_file_types)) {
                    $newfilename = md5($file_basename) . $file_ext;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/Projects2019/helden/Project/img/' . $newfilename)){
                        echo "You have already uploaded this file.";
                    }else{
                        move_uploaded_file($this->file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Projects2019/helden/Project/img/' . $newfilename);
                        return $newfilename;
                    }
                } else {
                    echo "Extension or size is not ALLOWED!!!";
                }
            } else {
                echo "File size is too large!!!";
            }
        } else {
            echo "DEAD MEAT";
        }
    }
}