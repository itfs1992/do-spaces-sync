<?php

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

class DOS_Filesystem {

  public static function get_instance ( $key, $secret, $container, $endpoint ) {

    $client = new S3Client([
      'credentials' => [
        'key'    => $key,
        'secret' => $secret,
      ],
      'endpoint' => $endpoint, 
      'version' => 'latest',
      // region means nothing for DO Spaces, but aws client may drop an error without it
      'region' => 'us-east-1',
    ]);
  
    $connection = new AwsS3V3Adapter($client, $container);
    $filesystem = new Filesystem($connection);
  
    return $filesystem;

  }

}
