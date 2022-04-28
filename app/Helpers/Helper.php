<?php

/* Encryption Id */

use App\Models\Module;
use App\Models\SubModule;

function getEncrypted($id){
    $encrypted_string=openssl_encrypt($id,config('services.encryption.type'),config('services.encryption.secret'));
    return base64_encode($encrypted_string);
}
/* Decryption Id */
function getDecrypted($id){
    $string=openssl_decrypt(base64_decode($id),config('services.encryption.type'),config('services.encryption.secret'));
    return $string;
}
function formatBytes($size, $precision = 2)
{
    if ($size > 0) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    } else {
        return $size;
    }
}
function get_time_ago( $time )
{
	$time_difference = time() - $time;

	if( $time_difference < 1 ) { return 'less than 1 second ago'; }
	$condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
		30 * 24 * 60 * 60       =>  'month',
		24 * 60 * 60            =>  'day',
		60 * 60                 =>  'hour',
		60                      =>  'minute',
		1                       =>  'second'
	);

	foreach( $condition as $secs => $str )
	{
		$d = $time_difference / $secs;

		if( $d >= 1 )
		{
			$t = round( $d );
			return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
		}
	}
}

function get_permission_name($module_name, $submodule_name = null)
{
	$module = Module::where('name', 'Like', '%'.$module_name.'%')->first();
	$permission_name = $module->slug;
	if(isset($submodule_name))
	{
		// if($submodule_name == 'any')
		// {
		// 	$subModules = SubModule::where('slug', 'Like', '%'.$module_name.'%')->get();
		// 	$permission_names = [];
		// 	foreach($subModules as $subModule)
		// 	{
		// 		$permission_name = $permission_name.'.'.$subModule->slug;
		// 		array_push($permission_names, $permission_name);
		// 	}
		// 	info(json_encode($permission_names));
		// 	return $permission_names;
		// }
		$subModule = SubModule::where('name', 'Like', '%'.$submodule_name.'%')->first();
		$permission_name = $permission_name.'.'.$subModule->slug;
	}

	return $permission_name;
}