<?php

use artsoft\db\PermissionsMigration;

class m190607_094056_add_slides_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('slidesManagement', 'Slides Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('slidesManagement');
    }

    public function getPermissions()
    {
        return [
            'slidesManagement' => [
                'links' => [
                    '/admin/slides/*',
                    '/admin/slides/default/*',
                    '/admin/slides/slides-layers/*',
                ],
                'viewSlides' => [
                    'title' => 'View Slides',
                    'links' => [
                        '/admin/slides/default/index',
                        '/admin/slides/default/view',
                        '/admin/slides/default/grid-sort',
                        '/admin/slides/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                ],
                'editSlides' => [
                    'title' => 'Edit Slides',
                    'links' => [
                        '/admin/slides/default/update',
                        '/admin/slides/slides-layers/update-layers',
                        '/admin/slides/default/bulk-activate',
                        '/admin/slides/default/bulk-deactivate',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewSlides',
                    ],
                ],
                'createSlides' => [
                    'title' => 'Create Slides',
                    'links' => [
                        '/admin/slides/default/create',
                        '/admin/slides/default/copy',
                        '/admin/slides/slides-layers/init-layers',
                        '/admin/slides/slides-layers/create-layers',
                        
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewSlides',
                    ],
                ],
                'deleteSlides' => [
                    'title' => 'Delete Slides',
                    'links' => [
                        '/admin/slides/default/delete',
                        '/admin/slides/slides-layers/remove',
                        '/admin/slides/default/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewSlides',
                    ],
                ],
                'fullSlidesAccess' => [
                    'title' => 'Full Slides Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
            ],
        ];
    }

}
