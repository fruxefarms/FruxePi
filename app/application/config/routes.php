<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

// Users
$route['users'] = 'auth/index';
$route['user/edit/(:num)'] = 'auth/edit_user/$1';
$route['user/delete/(:num)'] = 'auth/delete_user/$1';
$route['reset'] = 'dashboard/reset';

// Dashboard
$route['dashboard'] = 'dashboard/index';
$route['dashboard/settings'] = 'dashboard/editGrowRoomSettings';

// Crop
$route['crop'] = 'crop/index';
$route['crop/new'] = 'crop/createCrop';
$route['crop/edit/(:any)'] = 'crop/editCrop/$1';
$route['crop/delete/(:any)'] = 'crop/deleteCrop/$1';

// Crop Activity
$route['crop/activity/new'] = 'crop/addCropActivityEntry';
$route['crop/activity/edit/(:any)'] = 'crop/editCropActivityEntry/$1';
$route['crop/activity/delete/(:any)'] = 'crop/deleteCropActivityEntry/$1';

// Technical
$route['technical'] = 'sensors/index';

// Climate
$route['technical/climate'] = 'sensors/climateSettings';
$route['technical/climate/enable'] = 'sensors/enableClimateSensor';
$route['technical/climate/disable'] = 'sensors/disableClimateSensor';
$route['technical/climate/edit/GPIO'] = 'sensors/editClimateGPIO';
$route['technical/climate/edit/format'] = 'sensors/editTemperatureFormat';
$route['technical/climate/diagnostics'] = 'sensors/climateDiagnostics';

// Lights
$route['technical/lights'] = 'sensors/lightSettings';
$route['technical/lights/ON'] = 'sensors/lightsON';
$route['technical/lights/OFF'] = 'sensors/lightsOFF';
$route['technical/lights/enable'] = 'sensors/enableLights';
$route['technical/lights/disable'] = 'sensors/disableLights';
$route['technical/lights/edit/settings'] = 'sensors/editLightsSettings';
$route['technical/lights/edit/schedule'] = 'sensors/editLightSchedule';
$route['technical/lights/diagnostics'] = 'sensors/lightsDiagnostics';

// Fans
$route['technical/fans'] = 'sensors/fanSettings';
$route['technical/fans/ON'] = 'sensors/fanON';
$route['technical/fans/OFF'] = 'sensors/fanOFF';
$route['technical/fans/enable'] = 'sensors/enableFan';
$route['technical/fans/disable'] = 'sensors/disableFan';
$route['technical/fans/edit/settings'] = 'sensors/editFanSettings';
$route['technical/fans/edit/schedule'] = 'sensors/editFanSchedule';
$route['technical/fans/diagnostics'] = 'sensors/fanDiagnostics';

// Heater
$route['technical/heater'] = 'sensors/heaterSettings';
$route['technical/heater/ON'] = 'sensors/heaterON';
$route['technical/heater/OFF'] = 'sensors/heaterOFF';
$route['technical/heater/enable'] = 'sensors/heaterFan';
$route['technical/heater/disable'] = 'sensors/heaterFan';
$route['technical/heater/edit/GPIO'] = 'sensors/editHeaterGPIO';
$route['technical/heater/edit/schedule'] = 'sensors/editHeaterSchedule';
$route['technical/heater/diagnostics'] = 'sensors/heaterDiagnostics';

// Camera
$route['technical/camera'] = 'sensors/cameraSettings';
$route['technical/camera/enable'] = 'sensors/enableCamera';
$route['technical/camera/disable'] = 'sensors/disableCamera';
$route['technical/camera/capture'] = 'sensors/capturePhoto';
$route['technical/camera/diagnostics'] = 'sensors/cameraDiagnostics';

// Pump
$route['technical/pump'] = 'sensors/pumpSettings';
$route['technical/pump/ON'] = 'sensors/pumpON';
$route['technical/pump/OFF'] = 'sensors/pumpOFF';
$route['technical/pump/enable'] = 'sensors/enablePump';
$route['technical/pump/disable'] = 'sensors/disablePump';
$route['technical/pump/edit/settings'] = 'sensors/editPumpSettings';
$route['technical/pump/edit/schedule'] = 'sensors/editPumpSchedule';
$route['technical/pump/diagnostics'] = 'sensors/pumpDiagnostics';

// Moisture Probe
$route['technical/moisture'] = 'sensors/moistureSettings';
$route['technical/moisture/enable'] = 'sensors/enableMoistureSensor';
$route['technical/moisture/disable'] = 'sensors/disableMoistureSensor';
$route['technical/moisture/edit/GPIO'] = 'sensors/editMoistureGPIO';
$route['technical/moisture/diagnostics'] = 'sensors/moistureDiagnostics';

