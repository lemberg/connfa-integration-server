<?php

/**
 * Breadcrumbs
 */
Breadcrumbs::register('breadcrumbs', function ($breadcrumbs, $items) {
    $breadcrumbs->push('Dashboard', route('dashboard', ['conference_alias' => request()->route()->getParameter('conference_alias')]));
    if (is_array($items)) {
        if (!isset($items['label'])) {
            foreach ($items as $item) {
                $breadcrumbs->push($item['label'], route($item['route'], isset($item['params']) ? $item['params'] : []));
            }
        }else{
            $breadcrumbs->push($items['label'], route($items['route'], isset($items['params']) ? $items['params'] : []));
        }
    }
});

