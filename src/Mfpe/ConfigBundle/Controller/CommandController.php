<?php


namespace Mfpe\ConfigBundle\Controller;


use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\ClassLoader\ClassLoader;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

class CommandController extends BaseController
{
    use ControllerTrait;


    private $entityMerger;
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage,
                                EntityMerger $entityMerger

    )
    {
        $this->entityMerger = $entityMerger;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/clear_cache",
     *     name="app_clear-cache_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Command"},
     *  summary="Get  clear cache",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */

    public function clearCacheAction($messages = 10,KernelInterface $kernel)
    {

        /**************************** First Method****************************/
//        //Remove cache
//        $dirCache = $this->container->getParameter('dir_cache');
//        $di = new \RecursiveDirectoryIterator($dirCache, \FilesystemIterator::SKIP_DOTS);
//        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
//        foreach ($ri as $file) {
//            $file->isDir() ? rmdir($file) : unlink($file);
//        }
//        rmdir($dirCache);
//        //Remove sessions
//        $dirSessionss = $this->container->getParameter('dir_sessions');
//        $di = new \RecursiveDirectoryIterator($dirSessionss, \FilesystemIterator::SKIP_DOTS);
//        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
//        foreach ($ri as $file) {
//            $file->isDir() ? rmdir($file) : unlink($file);
//        }
//        rmdir($dirSessionss);
//        //Remove logs
//        $dirLogs = $this->container->getParameter('dir_logs');
//        $di = new \RecursiveDirectoryIterator($dirLogs, \FilesystemIterator::SKIP_DOTS);
//        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
//        foreach ($ri as $file) {
//            $file->isDir() ? rmdir($file) : unlink($file);
//        }
//        rmdir($dirLogs);
//        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => Response::HTTP_OK], Response::HTTP_OK);

        /**************************** Second Method****************************/
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'cache:clear',
            // (optional) pass options to the command
            '--no-debug' => true,
        ]);
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);




        $input = new ArrayInput([
            'command' => 'cache:clear',
            '--env' => 'prod',
            '--no-warmup' => true,
            // (optional) pass options to the command
            '--no-debug' => true,
        ]);
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);



        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/drop_data_base",
     *     name="app_drop-data-base_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Command"},
     *  summary="Get drop dataBase",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */

    public function dropDataBaseAction(KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--force' => true
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
        //return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $content], Response::HTTP_OK);

    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/create_data_base",
     *     name="app_create-data-base_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Command"},
     *  summary="Get create dataBase",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */

    public function createDataBaseAction(KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:database:create',
            // '--force' => true
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
        //return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $content], Response::HTTP_OK);

    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/schema_update",
     *     name="app_schema-update_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Command"},
     *  summary="Get schema update",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */

    public function schemaUpdateAction(KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            "command" => "doctrine:schema:update",
            "--force" => true
            //'--complete' => '--force',
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
        //return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $content], Response::HTTP_OK);

    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/load_fixtures",
     *     name="app_load-fixtures_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Command"},
     *  summary="Get load_fixtures",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */

    public function loadFixturesAction(KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            "command" => "doctrine:fixtures:load",
            "--append" => true
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
        //return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $content], Response::HTTP_OK);

    }


}