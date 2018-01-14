<?php

use mrcnpdlk\Psr16Cache\Adapter;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\SimpleCache\CacheInterface;

/**
 * Class ClientAbstract
 */
abstract class ClientAbstract
{
    /**
     * Cache handler
     *
     * @var \Psr\SimpleCache\CacheInterface
     */
    private $oCache;
    /**
     * @var \mrcnpdlk\Psr16Cache\Adapter
     */
    private $oCacheAdapter;
    /**
     * Logger handler
     *
     * @var \Psr\Log\LoggerInterface
     */
    private $oLogger;


    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->setLoggerInstance();
        $this->setCacheInstance();
    }


    /**
     * @return \mrcnpdlk\Psr16Cache\Adapter
     */
    public function getCacheAdapter(): Adapter
    {
        return $this->oCacheAdapter;
    }

    /**
     * Get logger instance
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->oLogger;
    }

    /**
     * Setting Cache Adapter
     *
     * @return $this
     */
    private function setCacheAdapter()
    {
        $this->oCacheAdapter = new Adapter($this->oCache, $this->oLogger);

        return $this;
    }

    /**
     * Set Cache handler (PSR-16)
     *
     * @param \Psr\SimpleCache\CacheInterface|null $oCache
     *
     * @return $this
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md PSR-16
     */
    public function setCacheInstance(CacheInterface $oCache = null)
    {
        $this->oCache = $oCache;
        $this->setCacheAdapter();

        return $this;
    }

    /**
     * Set Logger handler (PSR-3)
     *
     * @param LoggerInterface|null $oLogger
     *
     * @return $this
     */
    public function setLoggerInstance(LoggerInterface $oLogger = null)
    {
        $this->oLogger = $oLogger ?: new NullLogger();
        $this->setCacheAdapter();

        return $this;
    }
}
