<?php

/**
 * @author BRAMILLE Sébastien <contact@oktapodia.com>
 */

namespace Maxmind\Bundle\GeoipBundle\Twig;

use Maxmind\Bundle\GeoipBundle\Service\GeoipManager;
use Twig\Environment;
use Twig\Error\RuntimeError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
/**
 * Class GeoipExtension.
 */
class GeoipExtension extends AbstractExtension
{
    /**
     * @var GeoipManager
     */
    private $geoipManager;

    /**
     * GeoipExtension constructor.
     *
     * @param GeoipManager $geoipManager
     */
    public function __construct(GeoipManager $geoipManager)
    {
        $this->geoipManager = $geoipManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('geoip', array($this, 'geoipFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction(
                'code',
                array($this, 'getCode'),
                array(
                    'is_safe' => array('html'),
                    'needs_environment' => true,
                )
            ),
        );
    }

    /**
     * @param string $ip
     *
     * @return false|GeoipManager
     */
    public function geoipFilter($ip)
    {
        return $this->geoipManager->lookup($ip);
    }

    /**
     * @param Environment $env
     * @param $template
     *
     * @return bool|mixed
     *
     * @throws RuntimeError
     */
    public function getCode(Environment $env, $template)
    {
        if ($env->hasExtension('demo')) {
            $functions = $env->getExtension('demo')->getFunctions();
            foreach ($functions as $function) {
                if ($function->getName() === 'code') {
                    return call_user_func($function->getCallable(), $template);
                }
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'geoip_extension';
    }
}
