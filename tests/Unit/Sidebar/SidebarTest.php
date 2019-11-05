<?php

namespace Tests\Unit\Sidebar;

use Core\Application\Sidebar\Sidebar;
use Core\Manifests\SidebarManifest;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * @package Tests\Unit
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class SidebarTest extends TestCase
{
    /** setup the module manifest instance */
    public function setUp(): void
    {
        parent::setUp();

        $manifest = $this->app->make('manifest:sidebar');
        $manifest->destroy();
        $manifest->build();
    }

    /**
     * @test
     * @group  unit
     * @group  unit:sidebar
     * @return void
     */
    public function it_initializes_with_sidebar_manifest_and_filesystem()
    {
        $sidebar = new Sidebar(app('manifest:sidebar'), app('files'));
        $this->assertInstanceOf(SidebarManifest::class, $sidebar->manifest());
        $this->assertInstanceOf(Filesystem::class, $sidebar->files());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:sidebar
     * @return void
     */
    public function it_retrieves_the_sidebar_menus()
    {
        $sidebar = new Sidebar(app('manifest:sidebar'), app('files'));

        $this->assertInternalType('array', $sidebar->menus());
    }

    /**
     * @test
     * @group  unit
     * @group  unit:sidebar
     * @return void
     */
    public function it_builds_the_sidebar_menu_as_an_adjacent_list()
    {
        $sidebar = new Sidebar(app('manifest:sidebar'), app('files'));
        $sidebar->build();

        $this->assertInternalType('array', $sidebar->get());
    }
}
