<?php

function formatRequestFilter ($request, $defaultSort = 'id', $defaultSortDirection = 'desc', $sortOptions = false) {
    
    $_filters = $request->input('filter');
    $formatedFilters = [];

    if ($_filters) {
        $_filters = explode(',',$_filters);
        foreach($_filters as $filter) {
            $filter = explode(':', $filter);
            if(!empty($filter[1]) || $filter[1] == 0) {
                $formatedFilters[$filter[0]] = $filter[1];
            }
        }
    }

    $page = $request->input('page',1);
    $limit = $request->input('limit',10);
    $sortBy = $request->input('sort_by', $defaultSort);
    $sortDirection = $request->input('sort_direction', $defaultSortDirection);
    $offset = ($page - 1)* $limit;

    if($sortOptions) {
        $_sortBy = false;

        foreach($sortOptions as $alias => $field) {
            if ($alias == $sortBy) {
                $_sortBy = $field;
            }
        }

        if ($_sortBy) {
            $sortBy = $_sortBy;
        } else {
            $sortBy = $defaultSort;
        }
    }

    return [
        'filter' => $formatedFilters,
        'page' => $page,
        'limit' => $limit,
        'sort_by' => $sortBy,
        'sort_direction' => $sortDirection,
        'offset' => $offset
    ];
}