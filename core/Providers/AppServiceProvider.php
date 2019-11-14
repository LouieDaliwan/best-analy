<?php

namespace Core\Providers;

use Core\Application\Breadcrumbs\BreadcrumbsServiceProvider;
use Core\Application\Repository\RepositoryServiceProvider;
use Core\Application\Sidebar\SidebarServiceProvider;
use Core\Application\Widget\WidgetServiceProvider;
use Core\Exceptions\RestrictedResourceException;
use Core\Providers\BaseServiceProvider;
use Core\Providers\ConsoleServiceProvider;
use Core\Providers\ThemeServiceProvider;
use Core\Repositories\AssetRepository;
use Core\Repositories\Contracts\AssetRepositoryInterface;
use Core\Repositories\Contracts\StorageRepositoryInterface;
use Core\Repositories\Contracts\ThemeRepositoryInterface;
use Core\Repositories\StorageRepository;
use Core\Repositories\ThemeRepository;
use Illuminate\Support\Facades\Blade;
use Symfony\Component\Finder\Finder;

class AppServiceProvider extends BaseServiceProvider
{
    /**
     * Array of providers to register.
     *
     * @var array
     */
    protected $providers = [
        BreadcrumbsServiceProvider::class,
        ConsoleServiceProvider::class,
        FactoryServiceProvider::class,
        ModuleServiceProvider::class,
        PermissionServiceProvider::class,
        RepositoryServiceProvider::class,
        SettingServiceProvider::class,
        SidebarServiceProvider::class,
        ThemeServiceProvider::class,
        WidgetServiceProvider::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->aliasBladeComponents();
        $this->aliasBladeFieldDirective();
        $this->aliasBladeIncludes();
        $this->loadBladeAnimationDirectives();
        $this->loadBladeDirectives();
        $this->loadBladeIllustrationDirective();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->bind(AssetRepositoryInterface::class, AssetRepository::class);
        $this->app->bind(StorageRepositoryInterface::class, StorageRepository::class);
        $this->app->bind(ThemeRepositoryInterface::class, ThemeRepository::class);
    }

    /**
     * Bootstrap any application factory files.
     *
     * @return array
     */
    public function factories(): array
    {
        return array_merge(config('database.factories', []), [
            base_path('database'.DIRECTORY_SEPARATOR.'factories'),
        ]);
    }

    /**
     * Register all view components
     * from resources/views/components folder.
     *
     * @return void
     */
    public function aliasBladeComponents()
    {
        $files = Finder::create()
                       ->in($this->app->themePath('views/components'))
                       ->name('*.blade.php');

        foreach ($files as $file) {
            if (file_exists($file->getRealPath())) {
                $component = basename($file->getRealPath(), '.blade.php');
                Blade::component("components.{$component}", $component);
            }
        }
    }

    /**
     * Register all view components
     * from resources/views/components folder.
     *
     * @return void
     */
    public function aliasBladeIncludes()
    {
        $files = Finder::create()
                       ->in($this->app->themePath('views/includes'))
                       ->name('*.blade.php');

        foreach ($files as $file) {
            if (file_exists($file->getRealPath())) {
                $component = basename($file->getRealPath(), '.blade.php');
                Blade::include("includes.{$component}", $component);
            }
        }
    }

    /**
     * Register all view fields
     * from resources/views/fields folder.
     *
     * @return void
     */
    public function aliasBladeFieldDirective()
    {
        Blade::directive('field', function ($expression) {
            list($file, $args) = explode(',', $expression, 2);
            $file = str_replace("'", '', $file);

            return "<?php echo view('theme::fields.{$file}', $args)->render(); ?>";
        });
    }

    /**
     * Register all view illustrations
     * from resources/views/illustrations folder.
     *
     * @return void
     */
    public function loadBladeIllustrationDirective()
    {
        Blade::directive('illustration', function ($expression) {
            $attributes = explode(',', $expression, 2);
            $file = str_replace("'", '', $attributes[0]);
            $params = ! empty($attributes[0]) ? "['param' => $attributes[0]]" : '[]';

            if (isset($attributes[1])) {
                return "<?php echo view('theme::illustrations.{$file}', $attributes[1])->render(); ?>";
            }

            return "<?php echo view('theme::illustrations.{$file}')->render(); ?>";
        });
    }

    /**
     * Register additional blade directives from
     * the resources/views/directives folder.
     *
     * @return void
     */
    public function loadBladeDirectives()
    {
        $files = Finder::create()
                       ->in($this->app->themePath('views/directives'))
                       ->name('*.blade.php');

        foreach ($files as $file) {
            $component = basename($file->getRealPath(), '.blade.php');
            Blade::directive($component, function ($expression) use ($component) {
                $attributes = explode(',', $expression, 2);
                $params = ! empty($attributes[0]) ? "['param' => $attributes[0]]" : '[]';

                if (isset($attributes[1])) {
                    return "<?php echo view('directives.{$component}', array_merge($attributes[1], $params))->render(); ?>";
                }

                return "<?php echo view('directives.{$component}', $params)->render(); ?>";
            });
        }
    }

    /**
     * Register a directive to display animation asset files from resources/assets/animations folder.
     *
     * @return void
     */
    public function loadBladeAnimationDirectives()
    {
        Blade::directive('animation', function ($expression) {
            $attributes = explode(',', $expression, 2);
            $file = str_replace("'", '', $attributes[0] ?? null);
            $params = ! empty($attributes[0]) ? "['param' => $attributes[0]]" : '[]';

            if (isset($attributes[1])) {
                $params = json_decode(json_encode($attributes[1]), true);

                return "<img height=\"<?php echo {$params}['height'] ?? '200px'; ?>\" width=\"<?php echo {$params}['width'] ?? '200px'; ?>\" src=\"{{ url('assets/animations/{$file}') }}\">";
            }

            return "<img src=\"{{ url('assets/animations/{$file}') }}\">";
        });
    }
}
