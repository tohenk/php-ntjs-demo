<?php

/*
 * The MIT License
 *
 * Copyright (c) 2020-2025 Toha <tohenk@yahoo.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Demo;

use NTLAB\JS\Manager;
use NTLAB\JS\Script;

class Demo
{
    /**
     * Options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Enable/disable script minify.
     *
     * @var boolean
     */
    protected $minifyScript = false;

    /**
     * Enable/disable script debug information.
     *
     * @var boolean
     */
    protected $debugScript = true;

    /**
     * Enable/disable script embedding in response.
     *
     * When script embedding set to `false`, use an external web server
     * is a must.
     *
     * @var boolean
     */
    protected $embedScript = true;

    /**
     * Constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = (array) $options;
        $this->initialize();
    }

    /**
     * Initialize.
     */
    protected function initialize()
    {
        $manager = Manager::getInstance();
        // create backend instance
        $backend = new Backend(array_merge($this->options, ['embed_script' => $this->embedScript]));
        // set script backend
        $manager->setBackend($backend);
        // register script resolver
        $manager->addResolver($backend);
        // register script compressor
        if ($this->minifyScript) {
            $manager->setCompressor($backend);
        }
        // set script debug information
        if ($this->debugScript) {
            Script::setDebug(true);
        }
        // register script consumer
        if (!$this->embedScript) {
            $manager->setConsumer($backend);
        }
    }

    /**
     * Get the view content.
     *
     * @param string $viewName
     * @param array $vars
     * @return string
     */
    protected function useView($viewName, $vars = [])
    {
        include_once 'Helper.php';
        extract($vars);
        ob_start();
        include(__DIR__.'/../view/'.$viewName);
        $content = ob_get_clean();

        return $content;
    }

    protected function getRoute()
    {
        $route = isset($_SERVER['SCRIPT_URL']) ? $_SERVER['SCRIPT_URL'] : $_SERVER['REQUEST_URI'];
        if ($scriptName = $_SERVER['SCRIPT_NAME']) {
            if (0 === strpos($route, $scriptName)) {
                $route = substr($route, strlen($scriptName));
            }
        }
        if (false !== ($p = strpos($route, '?'))) {
            $route = substr($route, 0, $p);
        }
        return $route;
    }

    protected function executeIndex($parameters = [])
    {
        $content = $this->useView('demo.php');
        $content = $this->useView('layout.php', ['content' => $content, 'title' => 'PHP-NTJS Demo']);

        echo $content;
    }

    protected function executeJs($parameters = [])
    {
        if (isset($parameters['filename'])) {
            $rootDir = $this->options['root_dir'];
            if (is_file($filename = realpath($rootDir.'/var/script/'.basename($parameters['filename'])))) {
                echo file_get_contents($filename);
                return;
            }
        }
        header('HTTP/1.1 404 Not Found');
    }

    /**
     * Run the demo.
     */
    public function run()
    {
        $parameters = [];
        $route = $this->getRoute();
        if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }
        $matches = null;
        if (preg_match('#^/js/(?<filename>([a-zA-Z0-9]+)\.js)$#', $route, $matches)) {
            $this->executeJs(array_merge($parameters, ['filename' => $matches['filename']]));
        } else {
            $this->executeIndex($parameters);
        }
    }
}