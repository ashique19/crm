<?php

namespace App\Http\Controllers\Account;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\{CreateEmailRequest, ChangeEmailAccountPasswordRequest};
use App\Providers\CpanelServiceProvider;
use Illuminate\Http\Request;
use App\Models\Email;
use File;
use Session;

class CpanelController extends Controller
{
 
    protected $cpanel;
    
    public function __construct()
    {
        $this->cpanel = new CpanelServiceProvider;
    }
    
    protected function getPrimaryDomain()
    {
        return Auth::user()->website->primary_domain? 
            Auth::user()->website->primary_domain: 
            $_SERVER['SERVER_NAME'];
    }

    /**
     * Documentation: https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+Email%3A%3Alistpopswithdisk
     * 
     * @return type
     */
    public function emails()
    {
        $params = array(
            'domain' => $this->getPrimaryDomain(),
            'regex' => ''
        );

        $response = $this->cpanel->api2->Email->listpopswithdisk($params);

        $emails = $response->cpanelresult->data;

        return view('account.email.index', compact('emails'))
            ->with('primaryDomain', $this->getPrimaryDomain());         
            
    }

    /**
     * @doc:   https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+Email%3A%3Aaddpop
     * @param  type $request
     * @return type
     */
    public function add_email(CreateEmailRequest $request)
    {
        $primaryDomain = $this->getPrimaryDomain();
        $email = "{$request->email}@{$primaryDomain}";
        
        $params = array(
            'domain' => $primaryDomain,
            'email' => $email,
            'password' => $request->password,
            'quota' => '250'
        );

        $response = $this->cpanel->api2->Email->addpop($params);

        if (isset($response->cpanelresult->error)) {
            $alerts[] = [
                'class' => 'alert-danger',            
                'status' => 'error',
                'message' => $response->cpanelresult->error
            ];
        } else {
            
            Email::create(
                [
                'user_id' => Auth::user()->id,
                'email' => $email,
                'domain' => $primaryDomain,
                ]
            );
            
            $alerts[] = [
                'class' => 'alert-success',                
                'status' => 'success',
                'message' => 'New email account ('.$email.') created successfully.'
            ];
        }
        
        Session::flash('alerts', $alerts);
        
        return redirect()->back();
    }

    /**
     * @doc    https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+Email%3A%3Adelpop
     * @param  type $request
     * @return type
     */
    public function delete_email(Request $request)
    {
        $user = Auth::user();
        $query = Email::where('email', $request->email);
        $email = $query->firstOrFail();
            
        $params = array(
            'domain' => $email->domain,
            'email' => $email->email
        );

        $response = $this->cpanel->api2->Email->delpop($params);

        if (isset($response->cpanelresult->error)) {
            return response()->json($response->cpanelresult->error, 400);
        } else {
            
            $query->delete();
            
            return response()->json('Delete email success', 200);
        }
    }
    
    /**
     * Documentation: https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+Email%3A%3Apasswdpop
     * 
     * @return type
     */
    public function change_email_password(ChangeEmailAccountPasswordRequest $request)
    {
        $user = Auth::user();
        $query = Email::where('email', $request->email);
        $email = $query->firstOrFail();
        
        $primaryDomain = $this->getPrimaryDomain();
        
        $params = [
            'domain' => $primaryDomain,
            'email' => $email->email,
            'password' => $request->password,
        ];

        $response = $this->cpanel->api2->Email->passwdpop($params);

        if (isset($response->cpanelresult->error)) {
            $alerts[] = [
                'class' => 'alert-danger',                
                'status' => 'error',
                'message' => $response->cpanelresult->error
            ];
        } else {
            $email->touch();
            
            $alerts[] = [
                'class' => 'alert-success',                
                'status' => 'success',
                'message' => 'Email password has been updated.'
            ];
        }
        
        Session::flash('alerts', $alerts);
        
        return redirect()->back();
    }

    public function add_subdomain($website_id)
    {

        // https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+SubDomain%3A%3Aaddsubdomain

        $path = storage_path('app/public/sites');
       
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
            File::makeDirectory($path.'/'.$website_id, 0777, true, true);
        }else{
            File::makeDirectory($path.'/'.$website_id, 0777, true, true);
        }
        
        $params = array(
            'domain' => 'subdomain',
            'rootdomain' => $_SERVER['SERVER_NAME'],
            'dir' =>  storage_path('/app/public/sites/'.$website_id),
            'disallowdot' => '1',
        );
     
        $response = $this->cpanel->api2->SubDomain->addsubdomain($params);
        return $response;
    }

    public function delete_subdomain()
    {

        // https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+SubDomain%3A%3Adelsubdomain

        $params = array(
            'domain' => 'subdomain.example.com'
        );

        $response = $this->cpanel->api2->SubDomain->delsubdomain($params);

        return $response;
    }

    public function add_domain($website_id)
    {

        // https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+AddonDomain%3A%3Aaddaddondomain

        $path = storage_path('app/public/sites');
       
        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
            File::makeDirectory($path.'/'.$website_id, 0777, true, true);
        }else{
            File::makeDirectory($path.'/'.$website_id, 0777, true, true);
        }
        
        $params = array(
            'dir' =>  storage_path('/app/public/sites/'.$website_id),
            'newdomain' => 'addondomain.com',
            'subdomain' => 'subdomain',
        );

        $response = $this->cpanel->api2->AddonDomain->addaddondomain($params);

        return $response;
    }

    public function delete_domain()
    {

        // https://documentation.cpanel.net/display/DD/cPanel+API+2+Functions+-+AddonDomain%3A%3Adeladdondomain

        $params = array(
            'domain' => 'addondomain.com',
            'subdomain' => 'addondomain_example.com',
        );

        $response = $this->cpanel->api2->AddonDomain->deladdondomain($params);

        return $response;
    }

}