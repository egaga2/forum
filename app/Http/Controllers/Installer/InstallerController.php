<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Http;

class InstallerController extends Controller
{
    private $requirements;
    private $minimumRequirePhpVersion;
    private $dir;

    public function __construct()
    {
        $this->minimumRequirePhpVersion = '7.2.5';
        $this->requirements = [
            'PHP Version (>= ' . $this->minimumRequirePhpVersion . ')' => version_compare(phpversion(), $this->minimumRequirePhpVersion, '>='),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'PDO Extension' => extension_loaded('PDO'),
            'PDO MySQL Extension' => extension_loaded('pdo_mysql'),
            'Mbstring Extension' => extension_loaded('mbstring'),
            'Tokenizer Extension' => extension_loaded('tokenizer'),
            'XML Extension' => extension_loaded('xml'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'JSON PHP Extension' => extension_loaded('json'),
            'GD Extension' => extension_loaded('gd'),
            'Fileinfo Extension' => extension_loaded('fileinfo')
        ];
        $store = storage_path();
        $this->dir = [
            base_path('.env') => base_path('.env'),
            base_path('storage/app') => $store . '/app',
            base_path('storage/framework/cache') => $store . '/framework/cache',
            base_path('storage/framework/sessions') => $store . '/framework/sessions',
            base_path('storage/framework/views') => $store . '/framework/views',
            base_path('storage/logs') => $store . '/logs',
            base_path('bootstrap/cache') => base_path('bootstrap/cache')
        ];
    }

    private function isRequirementPassed($requirements, $dir)
    {

        if (extension_loaded('xdebug')) {
            $requirements['Xdebug Max Nesting Level (>= 500)'] = (int)ini_get('xdebug.max_nesting_level') >= 500;
        }

        $allLoaded = true;

        foreach ($requirements as $loaded) {
            if ($loaded == false) {
                $allLoaded = false;
            }
        }
        foreach ($dir as $k => $myDir) {
            if (!is_writable($myDir)) {
                $allLoaded = false;
            }
        }

        return $allLoaded;
    }

    public function index()
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (file_exists(storage_path('installed'))) {
            return redirect()->route(404);
        } else {
            return view('installer.index', ['isRequirementPassed' => $isRequirementPassed, 'requirements' => $this->requirements, 'dir' => $this->dir]);
        }
    }

    public function configuration()
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (!$isRequirementPassed) {
            return redirect('install');
        }
        if (file_exists(storage_path('installed'))) {
            return redirect()->route(404);
        } else {
            return view('installer.configuration');
        }
    }

    public function complete()
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (!$isRequirementPassed) {
            return redirect('install');
        }
        File::put(storage_path('installed'), '');
        return view('installer.complete');
    }

    public function send(Request $request)
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (!$isRequirementPassed) {
            return redirect('install');
        }
        $APP_NAME = Str::slug($request->app_name);
        $txt = "APP_NAME=" . $APP_NAME . "
APP_ENV=production
APP_KEY=base64:j4Vytcfb9LiIeep0u8Lp9N1IZ3K125fnozPFawVFFww=
APP_DEBUG=false
APP_URL=" . $request->app_url . "
APP_CAHCE_TIME = 604800
LOG_CHANNEL=stack
DB_CONNECTION=mysql
DB_HOST=" . $request->db_host . "
DB_PORT=3306
DB_DATABASE=" . $request->db_name . "
DB_USERNAME=" . $request->db_user . "
DB_PASSWORD='" . $request->db_pass . "'\n
BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120";
        File::put(base_path('.env'), $txt);
        return "Sending Credentials";
    }


    public function check()
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (!$isRequirementPassed) {
            return redirect('install');
        }
        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName()) {
                return "Database Installing";
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

    }

    public function verify_check(Request $request)
    {
        return redirect()->route('install.configuration');
    }

    public function verify()
    {
        $isRequirementPassed = $this->isRequirementPassed($this->requirements, $this->dir);
        if (!$isRequirementPassed) {
            return redirect('install');
        }
        if (file_exists(storage_path('installed'))) {
            return redirect()->route(404);
        }
        return view('installer.verify');
    }

    public function migrate()
    {
        ini_set('max_execution_time', '0');
        $db = DB::connection()->getPdo();
        $sql = file_get_contents(public_path('theme/install/question.sql'));
        $db->exec($sql);
        return "Demo Importing";
    }

    public function seed()
    {
        return "Congratulations! Your site is ready";
    }
}
