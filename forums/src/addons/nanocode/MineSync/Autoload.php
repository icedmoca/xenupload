<?php

namespace nanocode\MineSync;

class Autoload
{
    public static function autoloadComposerPackages($addOnId)
    {
        $composerDir = \XF::getAddOnDirectory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $addOnId) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'composer';
        $app = \XF::app();
        self::autoloadNamespaces($composerDir, $app);
        self::autoloadPsr4($composerDir, $app);
        self::autoloadClassmap($composerDir, $app);
        //self::autoloadFiles($composerDir, $app);
    }

    public static function autoloadNamespaces($composerDir, \XF\App $app, $prepend = false)
    {
        $namespaces = $composerDir . DIRECTORY_SEPARATOR . 'autoload_namespaces.php';
        if (!file_exists($namespaces))
        {
            $app->error()->logError('(ns) Missing vendor autoload files at ' . $namespaces);
        } else
        {
            $map = require $namespaces;
            foreach ($map as $namespace => $path)
            {
                \XF::$autoLoader->add($namespace, $path, $prepend);
            }
        }
    }

    public static function autoloadPsr4($composerDir, \XF\App $app, $prepend = false)
    {
        $psr4 = $composerDir . DIRECTORY_SEPARATOR . 'autoload_psr4.php';
        if (!file_exists($psr4))
        {
            $app->error()->logError('(psr4) Missing vendor autoload files at ' . $psr4);
        } else
        {
            $map = require $psr4;
            foreach ($map as $namespace => $path)
            {
                \XF::$autoLoader->addPsr4($namespace, $path, $prepend);
            }
        }
    }

    public static function autoloadClassmap($composerDir, \XF\App $app)
    {
        $classmap = $composerDir . DIRECTORY_SEPARATOR . 'autoload_classmap.php';
        if (!file_exists($classmap))
        {
            $app->error()->logError('(classmap) Missing vendor autoload files at ' . $classmap);
        } else
        {
            $map = require $classmap;
            if ($map)
            {
                \XF::$autoLoader->addClassMap($map);
            }
        }
    }

    public static function autoloadFiles($composerDir, \XF\App $app)
    {
        $files = $composerDir . DIRECTORY_SEPARATOR . 'autoload_files.php';
        if (!file_exists($files))
        {
            $app->error()->logError('(autoload) Missing vendor autoload files at ' . $files);
        } else
        {
            $includeFiles = require $files;
            foreach ($includeFiles as $fileIdentifier => $file)
            {
                if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier]))
                {
                    require $file;
                    $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
                }
            }
        }
    }

}