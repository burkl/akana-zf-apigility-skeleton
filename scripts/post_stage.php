<?php
/* The script post_stage.php will be executed after the staging process ends. This will allow
 * users to perform some actions on the source tree or server before an attempt to
 * activate the app is made. 
 */  

/**
 * Get environment variable
 *
 * @return string
 */
function getEnvVar($name) {
	$envVar = getenv($name);
	if (! $envVar) {
		exit_with_error($name . ' env var undefined');
	}

	return $envVar;
}

$appBaseDir = getEnvVar('ZS_APPLICATION_BASE_DIR');

// Add write permission to group
if (stripos(PHP_OS, 'win') !== 0) {
	exec("chmod -R a+w ". escapeshellcmd($appBaseDir . DIRECTORY_SEPARATOR . 'config'));
	exec("chmod -R a+w ". escapeshellcmd($appBaseDir . DIRECTORY_SEPARATOR . 'module'));
}

echo 'Post Stage Successful';
exit(0);