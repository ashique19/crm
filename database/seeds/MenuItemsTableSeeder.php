<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        if (App::environment('local')) {
            \DB::table('menu_items')->delete();
            
            \DB::table('menu_items')->insert(
                array (
                0 => 
                array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Dashboard',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-boat',
                'color' => null,
                'parent_id' => null,
                'order' => 1,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 16:12:25',
                'route' => 'voyager.dashboard',
                'parameters' => null,
                ),
                1 => 
                array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => null,
                'parent_id' => null,
                'order' => 4,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.media.index',
                'parameters' => null,
                ),
                2 => 
                array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => null,
                'parent_id' => null,
                'order' => 3,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 16:12:25',
                'route' => 'voyager.users.index',
                'parameters' => null,
                ),
                3 => 
                array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => null,
                'parent_id' => null,
                'order' => 2,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 16:12:25',
                'route' => 'voyager.roles.index',
                'parameters' => null,
                ),
                4 => 
                array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Tools',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => null,
                'parent_id' => null,
                'order' => 6,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:22:11',
                'route' => null,
                'parameters' => null,
                ),
                5 => 
                array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => null,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.menus.index',
                'parameters' => null,
                ),
                6 => 
                array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => null,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.database.index',
                'parameters' => null,
                ),
                7 => 
                array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => null,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.compass.index',
                'parameters' => null,
                ),
                8 => 
                array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => null,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.bread.index',
                'parameters' => null,
                ),
                9 => 
                array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Settings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => null,
                'parent_id' => null,
                'order' => 7,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:22:11',
                'route' => 'voyager.settings.index',
                'parameters' => null,
                ),
                10 => 
                array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Hooks',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-hook',
                'color' => null,
                'parent_id' => 5,
                'order' => 5,
                'created_at' => '2018-09-16 16:12:25',
                'updated_at' => '2018-09-16 17:21:52',
                'route' => 'voyager.hooks',
                'parameters' => null,
                ),
                11 => 
                array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Case Studies',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-world',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 1,
                'created_at' => '2018-09-16 16:21:54',
                'updated_at' => '2018-09-19 12:17:08',
                'route' => 'voyager.case-studies.index',
                'parameters' => 'null',
                ),
                12 => 
                array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Employees',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 2,
                'created_at' => '2018-09-16 17:16:37',
                'updated_at' => '2018-09-19 12:13:43',
                'route' => 'voyager.employees.index',
                'parameters' => 'null',
                ),
                13 => 
                array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Faq Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 3,
                'created_at' => '2018-09-16 17:17:06',
                'updated_at' => '2018-09-19 12:16:41',
                'route' => 'voyager.faq-categories.index',
                'parameters' => 'null',
                ),
                14 => 
                array (
                'id' => 15,
                'menu_id' => 1,
                'title' => 'Faqs',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-folder',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 4,
                'created_at' => '2018-09-16 17:17:37',
                'updated_at' => '2018-09-16 17:31:21',
                'route' => 'voyager.faqs.index',
                'parameters' => 'null',
                ),
                15 => 
                array (
                'id' => 16,
                'menu_id' => 1,
                'title' => 'Features',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-star',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 5,
                'created_at' => '2018-09-16 17:19:00',
                'updated_at' => '2018-09-19 12:16:21',
                'route' => 'voyager.features.index',
                'parameters' => 'null',
                ),
                16 => 
                array (
                'id' => 17,
                'menu_id' => 1,
                'title' => 'Jobs',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-receipt',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 6,
                'created_at' => '2018-09-16 17:19:28',
                'updated_at' => '2018-09-19 12:14:47',
                'route' => 'voyager.jobs.index',
                'parameters' => 'null',
                ),
                17 => 
                array (
                'id' => 18,
                'menu_id' => 1,
                'title' => 'Plans',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-credit-cards',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 7,
                'created_at' => '2018-09-16 17:20:12',
                'updated_at' => '2018-09-19 12:14:33',
                'route' => 'voyager.plans.index',
                'parameters' => 'null',
                ),
                18 => 
                array (
                'id' => 19,
                'menu_id' => 1,
                'title' => 'Testimonials',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-smile',
                'color' => '#000000',
                'parent_id' => 20,
                'order' => 8,
                'created_at' => '2018-09-16 17:21:16',
                'updated_at' => '2018-09-19 12:15:44',
                'route' => 'voyager.testimonials.index',
                'parameters' => 'null',
                ),
                19 => 
                array (
                'id' => 20,
                'menu_id' => 1,
                'title' => 'Saas',
                'url' => '#',
                'target' => '_self',
                'icon_class' => 'voyager-credit-cards',
                'color' => '#000000',
                'parent_id' => null,
                'order' => 5,
                'created_at' => '2018-09-16 17:21:44',
                'updated_at' => '2018-09-16 17:30:48',
                'route' => null,
                'parameters' => '',
                ),
                )
            );
        }        

        
    }
}