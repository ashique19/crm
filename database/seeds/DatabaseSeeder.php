<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(DesignsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);

        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
        $this->call(JobsTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);

        $this->call(PlansTableSeeder::class);
        $this->call(PlanFeaturesTableSeeder::class);        

        $this->call(SubscriptionsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);

        $this->call(SettingsTableSeeder::class);

        $this->call(WebsiteSettingsTableSeeder::class);
        
        $this->call(SeoTableSeeder::class); 
        $this->call(WebsiteThemeFramesTableSeeder::class); 
        $this->call(WebsiteThemeTableSeeder::class); 
        $this->call(WebsiteThemePagesTableSeeder::class); 
        

    }
    
}
