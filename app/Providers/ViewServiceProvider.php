<?php

namespace App\Providers;

use App\Models\DatasetRegistry;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share active datasets with all views (for footer)
        View::composer('layouts.app', function ($view) {
            $activeDatasets = collect();
            
            if (Schema::hasTable('dataset_registries')) {
                $activeDatasets = DatasetRegistry::active()->get();
            }

            $view->with('activeDatasets', $activeDatasets);
        });
    }
}
