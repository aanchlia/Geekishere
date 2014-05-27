<?php
// bootstrap.php
//require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Bootstrap{
    public function __construct(){
        $paths = array("models");
        $isDevMode = false;

// the connection configuration
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'Property',
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);

        $dbDriver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver($entityManager->getConnection()->getSchemaManager());

        $entityManager->getConfiguration()->setMetadataDriverImpl($dbDriver);

        $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($entityManager);

        $metadata  = $cmf->getAllMetadata();

        $generator = new \Doctrine\ORM\Tools\EntityGenerator();
        $generator->setAnnotationPrefix('');
        //$generator->setNameSpace('Entity');
        $generator->setUpdateEntityIfExists(false);
        $generator->setGenerateStubMethods(true);
        $generator->setGenerateAnnotations(true);
        $generator->generate($metadata, "models");

    }

}


