<?php

global $routing;

$routing = [
    'songs' =>
        [
            'controller' => 'SongController',
            'actions' =>  ['view' => 'viewAction']
        ],
    'playlists' =>
        [
            'controller' => 'PlaylistController',
            'actions' =>  [
                'view' => 'viewAction',
                'edit' => 'editAction'
            ],
        ],
    'users' =>
        [
            'controller' => 'UserController',
            'actions' =>  ['view' => 'viewAction']
        ]
];