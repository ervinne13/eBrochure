<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

/**
 * TODO: put other functions to a service instead
 */
class FileController extends Controller {

    protected $destinationPath;

    public function __construct() {
        $this->destinationPath = env("UPLOAD_DESTINATION_PATH");
    }

    public function upload() {
        $file = Input::file('file');

        $generatedFilename = "";

        if ($file) {
            $extension         = $this->getFileExtension($file->getClientOriginalName());
            $generatedFilename = $this->generateFileName($extension);
            $file->move(public_path($this->destinationPath), $generatedFilename);
        } else {
            return response("File invalid or no file uploaded", 500);
        }

        return $generatedFilename;
    }

    private function getFileExtension($fileName) {
        $splittedFileName = explode(".", $fileName);
        return $splittedFileName[count($splittedFileName) - 1];
    }

    private function generateFileName($extension) {
        $fileName = date('Y_m_d_His');
        return "{$fileName}.{$extension}";
    }

}
