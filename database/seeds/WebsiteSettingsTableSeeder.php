<?php

use Illuminate\Database\Seeder;

class WebsiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (App::environment('local')) {
            \DB::table('website_settings')->delete();        
            
            $website_settings = [
            ['name' => 'elements_dir',
            'value' => 'elements',
            'default_value' => 'elements',
            'description' => '<h4>Elements Directory</h4><p>The directory where all your element HTML files are stored. This value is relative to the directory in which you installed the application. Do not add a trailing "/" </p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'images_dir',
            'value' => 'elements/images',
            'default_value' => 'elements/images',
            'description' => '<h4>Image Directory</h4><p>This is the main directory for the images used by your elements. The images located in this directory belong to the administrator and can not be deleted by regular users. This directory needs to have <b>full read and write permissions!</b></p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'images_uploadDir',
            'value' => 'elements/images/uploads',
            'default_value' => 'elements/images/uploads',
            'description' => '<h4>Image Upload Directory</h4><p>This directory is used to store images uploaded by regular users. Each user will have his/her own directory within this directory. This directory needs to have <b>full read and write permissions!</b>.</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'upload_allowed_types',
            'value' => 'gif|jpg|png',
            'default_value' => 'gif|jpg|png',
            'description' => '<h4>Allowed Image Types</h4><p>The types of images users are allowed to upload, separated by "|".</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'upload_max_size',
            'value' => '1000',
            'default_value' => '1000',
            'description' => '<h4>Maximum Upload Filesize</h4><p>The maximum allowed filesize for images uploaded by users. This number is represents the number of kilobytes. Please note that this number of overruled by possible server settings.</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'upload_max_width',
            'value' => '1024',
            'default_value' => '1024',
            'description' => '<h4>Maximum Upload Width</h4><p>The maximum allowed width for images uploaded by users.</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'upload_max_height',
            'value' => '768',
            'default_value' => '768',
            'description' => '<h4>Maximum Upload Height</h4><p>The maximum allowed height for images uploaded by users.</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'images_allowedExtensions',
            'value' => 'jpg|png|gif|svg',
            'default_value' => 'jpg|png|gif|svg',
            'description' => '<h4>Allowed Extensions</h4><p>These allowed extensions are used when displayed the image library to the user, only these file types will be visible.</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'export_pathToAssets',
            'value' => 'elements/bootstrap|elements/css|elements/fonts|elements/images|elements/js',
            'default_value' => 'elements/bootstrap|elements/css|elements/fonts|elements/images|elements/js',
            'description' => '<h4>Assets Included in the export</h4><p>The collection of asset paths included in the export function. These paths are relative to the folder in which the application was installed and should have NO trailing "/". The paths are separated by "|".</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'export_fileName',
            'value' => 'website.zip',
            'default_value' => 'website.zip',
            'description' => '<h4>The Export File Name</h4><p>The name of the ZIP archive file downloaded when exporting a site. We recommend using the ".zip" file extension (others might work, but have not been tested).</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'index_page',
            'value' => 'index.php',
            'default_value' => 'index.php',
            'description' => '<h4>Index Page</h4><p>Set to "index.php" by default. If you\'d like to use pretty URLs (without "index.php" in them) leave this setting empty. If you want to use pretty URLs, don\'t forget to update your ".htaccess" file as well (more information can be found in the provided documentation).</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'language',
            'value' => 'english',
            'default_value' => 'english',
            'description' => '<h4>Application Language</h4><p>"english" by default. If you\'re changing this to anything else, please be sure to have all required language files translated and located in the correct folder inside "/application/languages/yourlanguage".</p>',
            'required' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')],
            ];

            DB::table('website_settings')->insert($website_settings);
        }        
        

    }
}
