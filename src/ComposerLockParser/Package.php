<?php

namespace ComposerLockParser;

use DateTime;

class Package {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    /**
     * @var array
     */
    private $source;

    /**
     * @var array
     */
    private $dist;

    /**
     * @var array
     */
    private $require;

    /**
     * @var array
     */
    private $requireDev;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $autoload;

    /**
     * @var array
     */
    private $license;

    /**
     * @var array
     */
    private $authors;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var array
     */
    private $keywords;

    /**
     * @var DateTime
     */
    private $time;

    private function __construct($name, $version, array $source, array $dist, array $require,
        array $requireDev, $type, array $autoload, array $license, array $authors, $description,
        $homepage, array $keywords, DateTime $time)
    {
        $this->name = $name;
        $this->version = $version;
        $this->source = $source;
        $this->dist = $dist;
        $this->require = $require;
        $this->requireDev = $requireDev;
        $this->type = $type;
        $this->autoload = $autoload;
        $this->license = $license;
        $this->authors = $authors;
        $this->description = $description;
        $this->homepage = $homepage;
        $this->keywords = $keywords;
        $this->time = $time;
    }

    public static function factory(array $packageInfo)
    {
        return new self(
            $packageInfo['name'],
            $packageInfo['version'],
            $packageInfo['source'],
            $packageInfo['dist'],
            isset($packageInfo['require']) ? $packageInfo['require'] : [],
            isset($packageInfo['requireDev']) ? $packageInfo['requireDev'] : [],
            $packageInfo['type'],
            isset($packageInfo['autoload']) ? $packageInfo['autoload'] : [],
            isset($packageInfo['license']) ? $packageInfo['license'] : [],
            isset($packageInfo['authors']) ? $packageInfo['authors'] : [],
            isset($packageInfo['description']) ? $packageInfo['description'] : null,
            isset($packageInfo['homepage']) ? $packageInfo['homepage'] : null,
            isset($packageInfo['keywords']) ? $packageInfo['keywords'] : [],
            new DateTime($packageInfo['time'])
        );
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        $namespace = [];

        if (isset($this->autoload['psr-0'])) {
            $namespace = $this->autoload['psr-0'];
        } elseif (isset($this->autoload['psr-4'])) {
            $namespace = $this->autoload['psr-4'];
        }

        return trim(key($namespace), '\\');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getDist()
    {
        return $this->dist;
    }

    /**
     * @return array
     */
    public function getRequire()
    {
        return $this->require;
    }

    /**
     * @return array
     */
    public function getRequireDev()
    {
        return $this->requireDev;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAutoload()
    {
        return $this->autoload;
    }

    /**
     * @return array
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}
