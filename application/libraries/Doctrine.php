<?php


class Doctrine
{
    // the Doctrine entity manager
    public $em = null;

    public function __construct()
    {
        // include our CodeIgniter application's database configuration
        require APPPATH.'config/database.php';

        // include Doctrine's fancy ClassLoader class
        require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';


        // load the Doctrine classes
        $doctrineClassLoader = new \Doctrine\Common\ClassLoader('Doctrine', APPPATH.'libraries');
        $doctrineClassLoader->register();

        // load Symfony2 helpers
        // Don't be alarmed, this is necessary for YAML mapping files
        $symfonyClassLoader = new \Doctrine\Common\ClassLoader('Symfony', APPPATH.'libraries/Doctrine');
        $symfonyClassLoader->register();

        // load the entities
        $entityClassLoader = new \Doctrine\Common\ClassLoader('Entity', APPPATH.'models');

        $entityClassLoader->register();

        // load the proxy entities
        $proxyClassLoader = new \Doctrine\Common\ClassLoader('Proxies', APPPATH.'models');
        $proxyClassLoader->register();

        // set up the configuration
        $config = new \Doctrine\ORM\Configuration;


        // set up proxy configuration
        $config->setProxyDir(APPPATH.'models/Proxies');
        $config->setProxyNamespace('Proxies');


        // auto-generate proxy classes if we are in development mode
        //$config->setAutoGenerateProxyClasses(ENVIRONMENT == 'development');

        // set up annotation driver
        //$yamlDriver = new \Doctrine\ORM\Mapping\Driver\YamlDriver(APPPATH.'models/Mappings');
        //$config->setMetadataDriverImpl($yamlDriver);

        $driverImpl = $config->newDefaultAnnotationDriver(array(
            APPPATH . 'models/Entity'
        ));
        $config->setMetadataDriverImpl($driverImpl);

        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => $db['default']['username'],
            'password' => $db['default']['password'],
            'host' => $db['default']['hostname'],
            'dbname' => $db['default']['database']
        );

        // create the EntityManager
        $em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);


        $platform = $em->getConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        // store it as a member, for use in our CodeIgniter controllers.
        $this->em = $em;
    }


    /**
     * generate entity objects automatically from mysql db tables
     * @return none
     */
    function generate_classes()
    {
        $dbDriver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver($this->em->getConnection()->getSchemaManager());

        $this->em->getConfiguration()->setMetadataDriverImpl($dbDriver);

        $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($this->em);

        $metadata  = $cmf->getAllMetadata();

        $generator = new \Doctrine\ORM\Tools\EntityGenerator();
        $generator->setAnnotationPrefix('');
        $generator->setNameSpace('Entity');
        $generator->setUpdateEntityIfExists(false);
        $generator->setGenerateStubMethods(true);
        $generator->setGenerateAnnotations(true);
        $generator->generate($metadata, APPPATH . "models/Entity");

    }

}