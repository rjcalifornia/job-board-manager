<?php
$autoload_path = __DIR__ . '/../vendor/autoload.php';
require_once($autoload_path);
use Ramsey\Uuid\Uuid;

class JobUtils{

  public function generateIdentifier(){
        $uuid = Uuid::uuid4()->toString();
        return $uuid;
    }

}