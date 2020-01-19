<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait CanUploadFile
{
    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        $folderName = settings('storage:modules', 'modules/'.$this->getTable()).DIRECTORY_SEPARATOR.date('Y-m-d');
        $uploadPath = storage_path($folderName);
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileName = $name.'-'.date('mdYHis').'.'.$file->getClientOriginalExtension();
        $fullFilePath = "$uploadPath/$fileName";

        if ($file->move($uploadPath, $fileName)) {
            return url("storage/$folderName/$fileName");
        }

        return null;
    }
}