<?php

namespace Announcement\Services;

use Core\Application\Service\ServiceInterface;
use Illuminate\Http\UploadedFile;

interface AnnouncementServiceInterface extends ServiceInterface
{
    /**
     * Upload single file to storage.
     *
     * @param \Illuminate\Http\UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file);
}
