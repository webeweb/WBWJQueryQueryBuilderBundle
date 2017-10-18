<?php

/*
 * This file is part of the WBWJQueryQueryBuilderBundle package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Bundle\JQuery\QueryBuilderBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use WBW\Bundle\JQuery\QueryBuilderBundle\API\JQueryQueryBuilderOptions;
use WBW\Bundle\JQuery\QueryBuilderBundle\Exception\JQueryQueryBuilderFileNotFoundException;

/**
 * jQuery QueryBuilder Twig extension.
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Bundle\JQuery\QueryBuilderBundle\Twig\Extension
 * @version 2.4.3
 * @final
 */
final class QueryBuilderTwigExtension extends Twig_Extension {

    /**
     * Service name.
     */
    const SERVICE_NAME = "webeweb.jquery-querybuilder-bundle.twig.extension.querybuilder";

    /**
     * Directory.
     *
     * @var string
     */
    private $directory;

    /**
     * Environment.
     *
     * @var string
     */
    private $environment;

    /**
     * Constructor.
     *
     * @param string $directory The directory.
     * @param string $environment The environment.
     */
    public final function __construct($directory, $environment) {
        $this->directory   = $directory;
        $this->environment = $environment;
    }

    /**
     * Get the Twig functions.
     *
     * @return array Returns the Twig functions.
     */
    public function getFunctions() {
        return [
            new Twig_SimpleFunction('queryBuilderScript', [$this, 'queryBuilderScriptFunction'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('queryBuilderStyle', [$this, 'queryBuilderStyle'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Get the resources directory.
     *
     * @return string Returns the resources directory.
     */
    private function getResourcesDirectory() {
        return $this->directory . "/Resources";
    }

    /**
     * Displays a jQuery QueryBuilder resource.
     *
     * @param string $open The open.
     * @param string $filename The filename.
     * @param string $close The close.
     */
    private function queryBuilderResourceFunction($open, $filename, $close) {

        // Initialize and check the filepath.
        $filepath = $this->getResourcesDirectory() . "/public/" . $filename;
        if (!file_exists($filepath)) {
            throw new QueryBuilderFileNotFoundException($filename);
        }

        // Return the output.
        return $open . $filename . $close;
    }

    /**
     * Displays an jQuery QueryBuilder script.
     *
     * @param string $script The script name.
     * @param string $subdirectory The sub directory.
     * @return string Returns the JQueryQueryBuilder script.
     * @throws QueryBuilderFileNotFoundException Throws an QueryBuilder file not found exception if the script is not found.
     */
    public function queryBuilderScriptFunction($script) {

        // Initialize the filename.
        $filename = implode("/", ["js", $script . ".js"]);

        // Return the output.
        return $this->queryBuilderResourceFunction("<script src=\"/bundles/wbwjquery-querybuiler/", $filename, "\" type=\"text/javascript\"></script>");
    }

    /**
     * Determines if the environement is dev.
     *
     * @return boolean Returns true in case of success, false otherwise.
     */
    private function isDevEnvironment() {
        return $this->environment === "dev";
    }

}
