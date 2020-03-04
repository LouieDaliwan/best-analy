<?php

namespace Setting\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\UploadedFile;

class BrandingController extends ApiController
{
    /**
     * Handle the incoming request
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string                        $folder
     * @return string|null
     */
    public function __invoke(UploadedFile $file, $folder = null)
    {
        $folderName = settings(
            'storage:modules', 'modules'
        ).DIRECTORY_SEPARATOR.date('Y-m-d')
        .DIRECTORY_SEPARATOR.$folder;
        $uploadPath = storage_path($folderName);
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileName = $name.'.'.$file->getClientOriginalExtension();

        if ($file->move($uploadPath, $fileName)) {
            return url("storage/$folderName/$fileName");
        }

        return null;
    }
}
