Maxmind GeoIp Library
=====================

Symfony bundle to easily use maxmind geoip bundle.

**Updated for Symfony 5**

[![SensioLabsInsight][insight-image]][insight-url]
[![Build][build-image]][build-url]

Installation
------------

To install this library please follow the next steps:

First add the dependencie to your `composer.json` file:

```json
"require": {
    ...
    "maxmind/geoip": "dev-master"
},
```

Then install the bundle with the command:

```sh
php composer update
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Maxmind\Bundle\GeoipBundle\MaxmindGeoipBundle(),
    );
}
```

Now the library is installed.

To get the maxmind data source file (in '.dat' format), you can choose between
one of the two following purposed methods:

You can go on the maxmind free download data page:
http://dev.maxmind.com/geoip/geolite
And get the needed version. Then you have to unzip the downloaded file in the data
directory located in 'vendor/maxmind/geoip/data'.

Or you can simply execute this command:

```sh
php app/console maxmind:geoip:update-data %url-data-source%
```

Replace %url-data-source% with the url of the needed data source.
ex: http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz

If you want to use your data file in another directory, you can configure it on `app\config\config.yml`

```yaml
# app/config/config.yml
maxmind_geoip:
	data_file_path: "%kernel.root_dir%/../web/GeoIPCity.dat"
```

Now can use the Maxmind GeoIp Library everywhere in your Symfony2 application.

Usage
-----

The following examples are available if you are in a controller

```php
$geoip = $this->get('maxmind.geoip')->lookup(%IP_ADDR%);

$geoip->getCountryCode();
$geoip->getCountryCode3();
$geoip->getCountryName();
$geoip->getRegion();
$geoip->getCity();
$geoip->getPostalCode();
$geoip->getLatitude();
$geoip->getLongitude();
$geoip->getAreaCode();
$geoip->getMetroCode();
$geoip->getContinentCode();
```

Or in twig file

```twig
{{ ip|geoip.countryCode }}
{{ ip|geoip.countryCode3 }}
{{ ip|geoip.countryName }}
{{ ip|geoip.regionCode }}
{{ ip|geoip.region }}
{{ ip|geoip.city }}
{{ ip|geoip.postalCode }}
{{ ip|geoip.latitude }}
{{ ip|geoip.longitude }}
{{ ip|geoip.areaCode }}
{{ ip|geoip.metroCode }}
{{ ip|geoip.continentCode }}
```

You can add a demo route in your 'routing_dev' to get an example on how
this bundle work for example:

```yaml
_maxmind_geoip:
    resource: "@MaxmindGeoipBundle/Controller/DemoController.php"
    type:     annotation
    prefix:   /demo
```

Get a lookup at /demo/geoip

This library is an import of Maxmind GeoIp Free Library,
you can find at http://www.maxmind.com/

[build-image]: https://img.shields.io/travis/IDCI-Consulting/Maxmind-GeoIp.svg?style=flat
[build-url]: https://travis-ci.org/IDCI-Consulting/Maxmind-GeoIp
[insight-image]: https://insight.sensiolabs.com/projects/f853833b-1b46-4280-a3aa-3c9a8b7c7ed7/mini.png
[insight-url]: https://insight.sensiolabs.com/projects/f853833b-1b46-4280-a3aa-3c9a8b7c7ed7
