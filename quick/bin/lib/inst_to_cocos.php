<?php

require_once(__DIR__ . '/quick/QuickInstaller.php');

$options = array(
	"FilesCopyToTemplate" => array(
			// array("framework_precompiled.zip", "framework_quick.zip", "/quick/lib/framework_precompiled", "/res"),
		),

	"PathesCopyToTemplate" => array(
			// array("/quick/samples/coinflip/res", "/res"),
			// array("/quick/samples/coinflip/src", "/src"),
		),

	"FilesNeedModify" => array(
			array(
				// "/cocos/platform/win32/CCFileUtils-win32.cpp",
				// 's_resourcePath.append("/../../");',
				// 's_resourcePath.append("/");',
				),
		),

	"FilesNeedReplace" => array(
			// array(
			// 	'cocos2d.cpp',
			// 	"/cocos/cocos2d.cpp",
			// 	),
		),
);

function check_cocos_ver()
{
	$cocos_path = $_ENV['ORIGIN_COCOS_X_ROOT'];
	if (!$cocos_path) 
	{
		return;
	}

	// $consoleDir = DS . 'tools' . DS . 'cocos2d-console' . DS . 'bin';
	// $pos = strpos($cocos_path, $consoleDir);
	// if ($pos != false)
	// {
	// 	$cocos_path = substr($cocos_path, 0, $pos);
	// }
	// else
	// {
	// 	return;
	// }

	if (is_dir($cocos_path . '/external/lua/quick')) 
	{
		return $cocos_path;
	}
}

// ----

$cocos_root_path = check_cocos_ver();
if (!$cocos_root_path)
{
	echo "Coscos root path not found!!!!!\n\n";
	return -1;
}
echo  "Found cocos root path: $cocos_root_path\n";

$quick_root_path = $_ENV['QUICK_V3_ROOT'];
if (!$quick_root_path)
{
	echo "Please setup Quick-cocos-x before install it to cocos2dx.\n\n";
	return -1;
}

$installer = new QuickInstaller($quick_root_path, $cocos_root_path, $options);

$retval = $installer->run();

echo "install return value: $retval\n";
return($retval);
