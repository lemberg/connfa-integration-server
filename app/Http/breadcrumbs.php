<?php

/**
 * Breadcrumbs
 */
Breadcrumbs::register('breadcrumbs', function ($breadcrumbs, $items) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
    if (is_array($items)) {
        if (!isset($items['label'])) {
            foreach ($items as $item) {
                $breadcrumbs->push($item['label'], route($item['route']));
            }
        }else{
            $breadcrumbs->push($items['label'], route($items['route']));
        }
    }
});
