<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FilesController extends Controller {

    protected $destinationPath;

    public function __construct() {
        $this->destinationPath = env("UPLOAD_DESTINATION_PATH");
    }

    public function upload(Request $request) {
        if ($request->hasFile('file')) {
            $path = $request->type;

            $file = Input::file('file');

            $generatedFilename = "";

            if ($file) {
                $extension         = $this->getFileExtension($file->getClientOriginalName());
                $generatedFilename = $this->generateFileName($extension);
                $file->move(public_path("{$this->destinationPath}/{$path}"), $generatedFilename);
            } else {
                return response("File invalid or no file uploaded", 500);
            }

            return [
                "generated_url" => "/{$this->destinationPath}/{$path}/{$generatedFilename}"
            ];
        } else {
            return response("No file to upload", 400);
        }
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
