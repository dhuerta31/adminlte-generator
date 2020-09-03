<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

       $pdocrud = new_PDOCrud();
       $pdomodel = $pdocrud->getPDOModelObj();
       $data = $pdomodel->executeQuery("SELECT count(*) as Total FROM users");
       $value = $pdomodel->executeQuery("SELECT count(*) as Total FROM rol");

       $pdocrud->addChart("chart3", "google-chart", "SELECT users.name, users.id,  users.rol FROM users", "id_company", "total", "sql", array("title" => "Usuarios registrados","width"=>"100%", "height"=>"500","google-chart-type"=>"PieChart"));
       
        return view('home',[
            'data'=>$data,
            'value'=>$value,
            'pdocrud'=>$pdocrud
        ]);
    }
    public function profile(){
        $pdocrud = new_PDOCrud();
        $pdocrud->setSettings("showUploadedImage", false);
        $urls[] = array("url"=>"#profile","text" => "Perfil", "icon" =>"fa fa-user", "data"=>"", "attr" =>array("data-profile"=>"user_id"),"class" => array("parent-sidebar"));
        $urls[] = array("url"=>"#recent-activity","text" => "Actividad Reciente", "icon" =>"fa fa-history", "data"=>"12/12/2017", "attr" =>array(),"class" => array("parent-sidebar"));
        $pdocrud->fieldCssClass("password", array("password"));
        $pdocrud->addPlugin("bootstrap-pwstrength");
        $pdocrud->setPK("id");
        $pdocrud->dbTable("users");
        $pdocrud->addCallback("before_update", "hash_password_update");
        //$pdocrud->fieldValidationType("password", "data-minlength", "9", "Porfavor ingrese al menos 9 caracteres");
        $pdocrud->formFields(array("name","image","email","password"));
        $pdocrud->fieldRenameLable("password", "Contraseña");
        $pdocrud->fieldDataAttr("password", array("value"=>"","placeholder"=>"******"));
        $pdocrud->fieldTypes("image","FILE_NEW");
        $pdocrud->fieldGroups("Name",array("name","image"));
        $pdocrud->fieldGroups("Name2",array("email","password"));
        $pdocrud->formRedirection(route('profile'));
        $params["ui"] = array("showProgressBar"=> "true");
        $params["common"] = array("showVerdictsInsideProgressBar"=> "true");
        $params["rules"] = array("wordRepetitions"=> "true");

        $pdocrud->addSidebar("image","name","email",$urls,"left");

        return view('profile',[
           'pdocrud'=>$pdocrud,
           'params'=>$params
        ]);
    }

    public function users(){

        $user = \Auth::user();

        $date = date('Y-m-d H:i:s');
        $pdocrud = new_PDOCrud();
        $pdocrud->fieldCssClass("password", array("password"));
        $pdocrud->addPlugin("bootstrap-pwstrength");
        $pdocrud->tableColFormatting("created_at", "date",array("format" =>"d-m-Y H:i:s"));
        $pdocrud->tableColFormatting("updated_at", "date",array("format" =>"d-m-Y H:i:s"));
        $pdocrud->viewColFormatting("created_at", "date",array("format" =>"d-m-Y H:i:s"));
        $pdocrud->viewColFormatting("updated_at", "date",array("format" =>"d-m-Y H:i:s"));
        $pdocrud->setSearchCols(array("name","email","rol"));
        $pdocrud->dbTable("users");
        $pdocrud->setSettings("actionBtnPosition", "left");
        $pdocrud->formDisplayInPopup();
        $pdocrud->tableColFormatting("image", "image", array("width"=>"50px"));
        $pdocrud->viewColFormatting("image", "image", array("width"=>"200px"));
        $pdocrud->relatedData('rol','rol','id_rol','name');
        $pdocrud->crudRemoveCol(array("id","password","email_verified_at","remember_token"));
        $pdocrud->fieldTypes("image","FILE_NEW");
        $pdocrud->formFields(array("name","image","email","password","created_at","updated_at","rol","permits"));
        $pdocrud->fieldDataAttr("password", array("value"=>"","placeholder"=>"******"));
        $pdocrud->fieldRenameLable("password", "Contraseña");
        $pdocrud->addCallback("before_insert", "hash_password_insert");
        $pdocrud->addCallback("before_update", "hash_password_update");
        $pdocrud->formFieldValue("created_at", $date);
        $pdocrud->formFieldValue("updated_at", $date);
        $pdocrud->fieldDataAttr("created_at", array("style"=>"display: none","value"=>$date));
        $pdocrud->fieldDataAttr("updated_at", array("style"=>"display: none","value"=>$date));
        $pdocrud->fieldHideLable("created_at");
        $pdocrud->fieldHideLable("updated_at");
        $pdocrud->fieldGroups("Name",array("email","password"));
        $pdocrud->fieldGroups("Name2",array("name","image"));
        $pdocrud->fieldNotMandatory("created_at");
        $pdocrud->fieldNotMandatory("updated_at");
        $pdocrud->setViewColumns(array("name","image","email","created_at","updated_at","rol"));
        $pdocrud->fieldAddOnInfo("name", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>');
        $pdocrud->fieldAddOnInfo("email", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>');
        //$pdocrud->fieldAddOnInfo("password", "before", '<span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>');

        $pdocrud->addFilter("NameFilter", "Filtrar por Nombre", "name", "dropdown");
        $pdocrud->setFilterSource("NameFilter", "users", "name", "name as pl", "db");
        $pdocrud->addFilter("EmailFilter", "Filtrar por Email", "email", "dropdown");
        $pdocrud->setFilterSource("EmailFilter", "users", "email", "email as pl", "db");
        $pdocrud->fieldRenameLable("name", "Nombre");
        $pdocrud->fieldRenameLable("image", "Imagen");
        $pdocrud->fieldRenameLable("email", "Correo Electrónico");
        $pdocrud->fieldRenameLable("rol", "Grupo");
        $pdocrud->fieldRenameLable("permits", "Permisos");

        $pdocrud->colRename("name", "Nombre");
        $pdocrud->colRename("image", "Imagen");
        $pdocrud->colRename("email", "Correo Electrónico");
        $pdocrud->colRename("rol", "Grupo");
        $pdocrud->colRename("permits", "Permisos");
        $pdocrud->colRename("created_at", "Creado en");
        $pdocrud->colRename("updated_at", "Actualizado en");

        $pdocrud->fieldTypes("permits", "radio");
        $pdocrud->fieldDataBinding("permits", array("Bloquear acceso a usuarios"=>"Bloquear acceso a usuarios","Activar acceso a usuarios"=>"Activar acceso a usuarios"), "", "","array");

        $params["ui"] = array("showProgressBar"=> "true");
        $params["common"] = array("showVerdictsInsideProgressBar"=> "true");
        $params["rules"] = array("wordRepetitions"=> "true");

        
        if($user['permits'] == "Bloquear acceso a usuarios"){
           return redirect()->route('home');
        }

        return view('users',[
            'pdocrud'=>$pdocrud,
            'params' =>$params
        ]);
    }

    public function valor_uf(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_URL, "https://mindicador.cl/api/uf/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);                                         
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        $value = json_decode($result, true);

        //print_r($value);

        $pdocrud = new_PDOCrud();
        $pdomodel = $pdocrud->getPDOModelObj();

        $pdocrud->addChart("chart2", "google-chart", "SELECT data.date, data.id_data,  data.value FROM data", "id_company", "total", "sql", array("title" => "Valores uf","width"=>"100%", "height"=>"500","google-chart-type"=>"BarChart"));

        $insertEmpData[0]["date"] = $value['serie'][0]['fecha'];
        $insertEmpData[0]["value"] = $value['serie'][0]['valor'];
        $insertEmpData[1]["date"] = $value['serie'][1]['fecha'];
        $insertEmpData[1]["value"] = $value['serie'][1]['valor'];
        $insertEmpData[2]["date"] = $value['serie'][2]['fecha'];
        $insertEmpData[2]["value"] = $value['serie'][2]['valor'];
        $insertEmpData[3]["date"] = $value['serie'][3]['fecha'];
        $insertEmpData[3]["value"] = $value['serie'][3]['valor'];
        $insertEmpData[4]["date"] = $value['serie'][4]['fecha'];
        $insertEmpData[4]["value"] = $value['serie'][4]['valor'];
        $insertEmpData[5]["date"] = $value['serie'][5]['fecha'];
        $insertEmpData[5]["value"] = $value['serie'][5]['valor'];
        $insertEmpData[6]["date"] = $value['serie'][6]['fecha'];
        $insertEmpData[6]["value"] = $value['serie'][6]['valor'];
        $insertEmpData[7]["date"] = $value['serie'][7]['fecha'];
        $insertEmpData[7]["value"] = $value['serie'][7]['valor'];
        $insertEmpData[8]["date"] = $value['serie'][8]['fecha'];
        $insertEmpData[8]["value"] = $value['serie'][8]['valor'];
        $insertEmpData[9]["date"] = $value['serie'][9]['fecha'];
        $insertEmpData[9]["value"] = $value['serie'][9]['valor'];
        $insertEmpData[10]["date"] = $value['serie'][10]['fecha'];
        $insertEmpData[10]["value"] = $value['serie'][10]['valor'];


        $pdomodel->insertBatch("data", $insertEmpData);

        $pdocrud->formDisplayInPopup();
        $pdocrud->addFilter("DateFilter", "Filtrar por fecha", "date", "dropdown");
        $pdocrud->setFilterSource("DateFilter", "data", "date", "date as pl", "db");

        $pdocrud->addFilter("ValueFilter", "Filtrar por valor uf", "value", "dropdown");
        $pdocrud->setFilterSource("ValueFilter", "data", "value", "value as pl", "db");
        $pdocrud->crudRemoveCol(array("id_data"));
        $pdocrud->tableColFormatting("date", "date",array("format" =>"d-m-Y"));
        $pdocrud->viewColFormatting("date", "date",array("format" =>"d-m-Y"));
        $pdocrud->setSettings("clonebtn", true);
        $pdocrud->dbTable("data");

        return view('valor_uf',[
            'pdocrud'=> $pdocrud,
        ]);
    }
}
