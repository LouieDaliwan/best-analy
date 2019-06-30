<?php

namespace Announcement\Unit\Services;

use Announcement\Services\AnnouncementServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * @package Announcement\Unit\Services
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class AnnouncementServiceTest extends TestCase
{
    /**
     * @test
     * @group  unit
     * @group  unit:service
     * @group  service:announcement
     * @return void
     */
    public function it_should_accept_an_uploaded_file_class_on_upload()
    {
        // Arrangements
        $service = $this->app->make(AnnouncementServiceInterface::class);
        $dummyFile = UploadedFile::fake()->image('anncmt-details.pdf');

        // Actions
        $actual = $service->upload($dummyFile);

        // Assertions
        $this->assertInstanceOf(UploadedFile::class, $dummyFile);
    }
}
