<?php

Route::middleware(['breadcrumbs:announcement,name'])->group(function () {
    Route::softDeletes('announcements', 'AnnouncementController');
    Route::resource('announcements', 'AnnouncementController');
});
