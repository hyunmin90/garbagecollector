<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
DB 정보
총 2개의 DB를 접근합니다.
1. openapi
- openapi, 제휴, DNA사이트 관련 DB
- 접근 ID : openapi

2. cloudstack
- cloudstack 기본, 위클 확장 기능
- 2-1 cloudstack 기본 DB 접근 ID : cloud
- 2-2 cloudstack Daum 확장 DB 접근 ID : cloud_daum


host 설정 필요
192.168.161.45	dna-whycle-db1
10.253.2.53 	dna-openapi-db2
*/

//1. openapi DB
$cloud_openapi_db_name = 'dna-openapi-db2';
$cloud_openapi_db_user = 'openapi';
$cloud_openapi_db_password = '!api!';

//1-1. openapi 기본 DB
$active_group = 'openapi';
$active_record = TRUE;
$db['openapi']['hostname'] = $cloud_openapi_db_name;
$db['openapi']['username'] = $cloud_openapi_db_user;
$db['openapi']['password'] = $cloud_openapi_db_password;
$db['openapi']['database'] = 'openapi';
$db['openapi']['dbdriver'] = 'mysql';
$db['openapi']['dbprefix'] = '';
$db['openapi']['pconnect'] = TRUE;
$db['openapi']['db_debug'] = TRUE;
$db['openapi']['cache_on'] = FALSE;
$db['openapi']['cachedir'] = '';
$db['openapi']['char_set'] = 'utf8';
$db['openapi']['dbcollat'] = 'utf8_general_ci';
$db['openapi']['swap_pre'] = '';
$db['openapi']['autoinit'] = TRUE;
$db['openapi']['stricton'] = FALSE;

//2. Cloudstack DB
$cloud_whycle_db_name = 'dna-whycle-db1';
$cloud_whycle_db_user = 'cloud';
$cloud_whycle_db_password = 'daumdna';

//2-1. Cloudstack DB의 기본 DB
$active_group = 'cloud';
$active_record = TRUE;
$db['cloud']['hostname'] = $cloud_whycle_db_name;
$db['cloud']['username'] = $cloud_whycle_db_user;
$db['cloud']['password'] = $cloud_whycle_db_password;
$db['cloud']['database'] = 'cloud';
$db['cloud']['dbdriver'] = 'mysql';
$db['cloud']['dbprefix'] = '';
$db['cloud']['pconnect'] = TRUE;
$db['cloud']['db_debug'] = TRUE;
$db['cloud']['cache_on'] = FALSE;
$db['cloud']['cachedir'] = '';
$db['cloud']['char_set'] = 'utf8';
$db['cloud']['dbcollat'] = 'utf8_general_ci';
$db['cloud']['swap_pre'] = '';
$db['cloud']['autoinit'] = TRUE;
$db['cloud']['stricton'] = FALSE;

//2-2. Cloudstack DB의 Daum 확장 DB
$active_group = 'cloud_daum';
$active_record = TRUE;
$db['cloud_daum']['hostname'] = $cloud_whycle_db_name;
$db['cloud_daum']['username'] = $cloud_whycle_db_user;
$db['cloud_daum']['password'] = $cloud_whycle_db_password;
$db['cloud_daum']['database'] = 'cloud_daum';
$db['cloud_daum']['dbdriver'] = 'mysql';
$db['cloud_daum']['dbprefix'] = '';
$db['cloud_daum']['pconnect'] = TRUE;
$db['cloud_daum']['db_debug'] = TRUE;
$db['cloud_daum']['cache_on'] = FALSE;
$db['cloud_daum']['cachedir'] = '';
$db['cloud_daum']['char_set'] = 'utf8';
$db['cloud_daum']['dbcollat'] = 'utf8_general_ci';
$db['cloud_daum']['swap_pre'] = '';
$db['cloud_daum']['autoinit'] = TRUE;
$db['cloud_daum']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */