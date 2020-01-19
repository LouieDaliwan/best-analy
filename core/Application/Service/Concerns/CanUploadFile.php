<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Http\UploadedFile;

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
        $filePath = $this->getStoragePath();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = sprintf('%s-%s.%s', $fileName, date('YmdHis'), $file->getClientOriginalExtension());
        $fullPath = $filePath.'/'.$fileName;

        if ($file->move($filePath, $fileName)) {
            return route('storage:fetch', "storage/$fullPath");
        }

        return null;
    }
}
