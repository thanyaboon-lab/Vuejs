<?php

namespace App\Http\Controllers\Configuration\v1;
// use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected $masterData;


    public function __construct(Request $request)
    {
        $this->masterData = $request->master;
    }


    public function getModuleMenu(Request $request)
    {
        $data = [
            [
                'name' => 'Dashboard',
                'url' => '/dashboard',
                'icon' => 'icon-speedometer',
                'badge' => [
                    'variant' => 'primary',
                    'text' => 'NEW'
                ]
            ],
            [
                'name' => 'paAek',
                'url' => '/paAek',
                'icon' => 'cui-people',
                'children' => [
                    [
                        'name' => 'BootstrapTables',
                        'url' => '/paAek/bootstrapTables',
                        'icon' => 'icon-puzzle'
                    ],
                ]
            ],
            /*
            [
                'name' => 'Colors',
                'url' => '/theme/colors',
                'icon' => 'icon-drop'
            ],
            [
                'name' => 'Typography',
                'ur' => '/theme/typography',
                'icon' => 'icon-pencil'
            ],
            */
            [
                'name' => 'Base',
                'url' => '/base',
                'icon' => 'icon-puzzle',
                'children' => [
                    [
                        'name' =>  'Breadcrumbs',
                        'url' =>  '/base/breadcrumbs',
                        'icon' =>  'icon-puzzle'
                    ],
                    [
                        'name' =>  'Cards',
                        'url' =>  '/base/cards',
                        'icon' =>  'icon-puzzle'
                    ],
                    [
                        'name' => 'Carousels',
                        'url' => '/base/carousels',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Collapses',
                        'url' => '/base/collapses',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Forms',
                        'url' => '/base/forms',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Jumbotrons',
                        'url' => '/base/jumbotrons',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'List Groups',
                        'url' => '/base/list-groups',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Navs',
                        'url' => '/base/navs',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Navbars',
                        'url' => '/base/navbars',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Paginations',
                        'url' => '/base/paginations',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Popovers',
                        'url' => '/base/popovers',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Progress Bars',
                        'url' => '/base/progress-bars',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Switches',
                        'url' => '/base/switches',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Tables',
                        'url' => '/base/tables',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Tabs',
                        'url' => '/base/tabs',
                        'icon' => 'icon-puzzle'
                    ],
                    [
                        'name' => 'Tooltips',
                        'url' => '/base/tooltips',
                        'icon' => 'icon-puzzle'
                    ]
                ]
            ],
            [
                'name' => 'Buttons',
                'url' => '/buttons',
                'icon' => 'icon-cursor',
                'children' => [
                    [
                        'name' => 'Buttons',
                        'url' => '/buttons/standard-buttons',
                        'icon' => 'icon-cursor'
                    ],
                    [
                        'name' => 'Button Dropdowns',
                        'url' => '/buttons/dropdowns',
                        'icon' => 'icon-cursor'
                    ],
                    [
                        'name' => 'Button Groups',
                        'url' => '/buttons/button-groups',
                        'icon' => 'icon-cursor'
                    ],
                    [
                        'name' => 'Brand Buttons',
                        'url' => '/buttons/brand-buttons',
                        'icon' => 'icon-cursor'
                    ]
                ]
            ],
            [
                'name' => 'Charts',
                'url' => '/charts',
                'icon' => 'icon-pie-chart'
            ],
            [
                'name' => 'Icons',
                'url' => '/icons',
                'icon' => 'icon-star',
                'children' => [
                    [
                        'name' => 'CoreUI Icons',
                        'url' => '/icons/coreui-icons',
                        'icon' => 'icon-star',
                        'badge' =>  [
                            'variant' => 'info',
                            'text' => 'NEW'
                        ],
                    ],
                    [
                        'name' => 'Flags',
                        'url' => '/icons/flags',
                        'icon' => 'icon-star'
                    ],
                    [
                        'name' => 'Font Awesome',
                        'url' => '/icons/font-awesome',
                        'icon' => 'icon-star',
                        'badge' =>  [
                            'variant' => 'secondary',
                            'text' => '4.7'
                        ],
                    ],
                    [
                        'name' => 'Simple Line Icons',
                        'url' => '/icons/simple-line-icons',
                        'icon' => 'icon-star'
                    ],
                ]
            ],
            [
                'name' => 'Notifications',
                'url' => '/notifications',
                'icon' => 'icon-bell',
                'children' => [
                    [
                        'name' => 'Alerts',
                        'url' => '/notifications/alerts',
                        'icon' => 'icon-bell',
                    ],
                    [
                        'name' => 'Badges',
                        'url' => '/notifications/badges',
                        'icon' => 'icon-bell'
                    ],
                    [
                        'name' => 'Modals',
                        'url' => '/notifications/modals',
                        'icon' => 'icon-bell'
                    ]
                ]
            ],
            [
                'name' => 'Widgets',
                'url' => '/widgets',
                'icon' => 'icon-calculator',
                'badge' =>  [
                    'variant' => 'primary',
                    'text' => 'NEW'
                ]
            ],
            [
                'name' => 'Pages',
                'url' => '/pages',
                'icon' => 'icon-star',
                'children' => [
                    [
                        'name' => 'Login',
                        'url' => '/pages/login',
                        'icon' => 'icon-star'
                    ],
                    [
                        'name' => 'Register',
                        'url' => '/pages/register',
                        'icon' => 'icon-star'
                    ],
                    [
                        'name' => 'Error 404',
                        'url' => '/pages/404',
                        'icon' => 'icon-star'
                    ],
                    [
                        'name' => 'Error 500',
                        'url' => '/pages/500',
                        'icon' => 'icon-star'
                    ]
                ]
            ], [
                'name' => 'Disabled',
                'url' => '/dashboard',
                'icon' => 'icon-ban',
                'badge' => [
                    'variant' => 'secondary',
                    'text' => 'NEW'
                ],
                'attributes' => ['disabled' => true],
            ]
        ];

        return responder()->success($data)->respond(200);
        //  print_r($response);
    }
}
