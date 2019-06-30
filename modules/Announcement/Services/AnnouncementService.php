<?php

namespace Announcement\Services;

use Announcement\Models\Announcement;
use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class AnnouncementService extends Service implements AnnouncementServiceInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param  \Announcement\Models\Announcement $model
     * @param  \Illuminate\Http\Request         $request
     * @return void
     */
    public function __construct(Announcement $model, Request $request)
    {
        $this->$model = $model;
        $this->$request = $request;
    }

    /**
     * Upload single file to storage.
     *
     * @param \Illuminate\Http\UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        //
    }
}
