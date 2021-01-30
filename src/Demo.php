<?php

/*
 * The MIT License
 *
 * Copyright (c) 2020 Toha <tohenk@yahoo.com>
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
use NTLAB\JS\Compressor\JSMin;
use NTLAB\JS\Script;

class Demo
{
    /**
     * Enable/disable the use of CDN.
     *
     * @var boolean
     */
    protected $useCDN = true;

    /**
     * Enable/disable script minify.
     *
     * @var boolean
     */
    protected $minifyScript = true;

    /**
     * Enable/disable script debug information.
     *
     * @var boolean
     */
    protected $debugScript = true;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initialize.
     */
    protected function initialize()
    {
        $manager = Manager::getInstance();
        // create backend instance
        $backend = new Backend($this->useCDN);
        // set script backend
        $manager->setBackend($backend);
        // register script resolver
        $manager->addResolver($backend);
        // register script compressor
        if ($this->minifyScript) {
            $manager->setCompressor(new JSMin());
        }
        // set script debug information
        if ($this->debugScript) {
            Script::setDebug(true);
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

    /**
     * Run the demo.
     */
    public function run()
    {
        $content = $this->useView('demo.php');
        $content = $this->useView('layout.php', ['content' => $content, 'title' => 'PHP-NTJS Demo']);

        echo $content;
    }
}