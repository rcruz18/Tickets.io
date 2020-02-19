<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Artisan;

class CrudGenerator extends Command{
    protected $signature = 'crud:generator {name : Class (Singular) for example User}';
    protected $description = 'Create CRUD Operations';

    public function __construct(){
        parent::__construct();
    }//end function

    public function handle(){
     $name = $this->argument('name');
    $this->model($name);
    $this->controller($name);
    $this->request($name);
      $this->view($name, 'index');
      $this->view($name, 'create');
      $this->view($name, 'edit');
      $this->view($name, 'header');

    File::append(base_path('routes/web.php'), "\r\nRoute::resource('" . Str::plural(strtolower($name)) . "', '{$name}Controller');");
    Artisan::call('make:migration create_'. strtolower(Str::plural($name)) .'_table --create='. strtolower(Str::plural($name)));
   }// end function

   protected function getStub($type){
    return file_get_contents(resource_path("stubs/$type.stub"));
   }// end function

   protected function model($name){
    $plantilla = str_replace(
     ['{{modelName}}']
     ,[$name]
     ,$this->getStub('Model')
    );
    file_put_contents(app_path("/{$name}.php"), $plantilla);
   }// end function

   protected function controller($name){
    $plantilla = str_replace(
     [
      '{{modelName}}'
          ,'{{modelNamePluralLowerCase}}'
          ,'{{modelNameSingularLowerCase}}'
     ],[
      $name
      ,strtolower(Str::plural($name))
      ,strtolower($name)
     ],
     $this->getStub('Controller')
    );
    file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $plantilla);
   }// end function
   protected function request($name){
     $plantilla = str_replace(
        ['{{modelName}}']
        ,[$name]
        ,$this->getStub('Request')
     );

     if(!file_exists($path = app_path('/Http/Requests'))){
        mkdir($path, 0777, true);
      }//end if
     file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $plantilla);
   }// end function

    protected function view($name, $view){
      $plantilla = str_replace([
          '**modelName**'
          ,'**modelNamePluralLowerCase**'
          ,'**modelNamePluralucFirst**'
          ,'**modelNameSingularLowerCase**'
        ],[
          $name
          ,strtolower(Str::plural($name))
          ,ucfirst(strtolower(Str::plural($name)))
          ,strtolower($name)
        ],
        $this->getStub(ucfirst($view))
      );

      $name_dir = strtolower(Str::plural($name));
      if ($view === 'header'){
        if(!file_exists($path = (resource_path("views/{$name_dir}/partials")))){
          mkdir($path, 0777, true);
        }//end if
        file_put_contents(resource_path("views/{$name_dir}/partials/{$view}.blade.php"), $plantilla);
      }else{
        if(!file_exists($path = (resource_path("views/{$name_dir}")))){
          mkdir($path, 0777, true);
        }//end if
        file_put_contents(resource_path("views/{$name_dir}/{$view}.blade.php"), $plantilla);
      }//end if
    }// end function
}//end class
