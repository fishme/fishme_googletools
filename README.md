# eZ Publish extension: fishme_googletools

author: David Hohl

website: www.fishme.de and www.ez-publish-blog.de

The eZ Publish fishme_googletools extension includes follow tools:

- Google URL Shortener
- Google Analytics
- Google Maps (only GeoCords)


## Requirements:
- eZ Publish 4.x

## Install:
- Enable the extension in eZ Publish. Do this by opening settings/override/site.ini.append.php ,
   and add in the [ExtensionSettings] block:
   ActiveExtensions[]=fishme_googletools
- Regenerate autoloads: php bin/php/ezpgenerateautoloads.php -e
- Clear your cache
- look into extension/fishme_googletools/settings/fishme_googletools.ini.settings.php

## Examples:

### Google URL Shortener

*Features*:
- convert your long url to a short url
- convert the short url to your long url

convert your url to google short url
```bash
{def $short_url = fs_set_GoogleUrlShortener('www.fishme.de')}
```
return the shorturl for www.fishme.de

```bash
{def $short_url = fs_set_GoogleUrlShortener()}
```
return the shorturl for the current url


convert a shorturl to the default url
```bash
{def $short_url = fs_get_GoogleUrlShortener('your short url')}
```

### Google Analytics

generate google analytics code (for more options look into the fishme_googletools.ini)
```bash
{def $google_analytics = fs_get_GoogleAnalyticsCode()}
{$google_analytics}
```

### Google Maps

*Features*:
- return the lat and lng by an address
- return the address by lat and lng

return the lat and lng geo cords
```bash
{def $google_maps = fs_get_GoogleMaps_geocode_by_address('your address')}
{$google_maps.lat}
{$google_maps.lng}
{$google_maps.addtional}
```
return the address
```bash
{def $google_maps = fs_get_GoogleMaps_geocode_by_latlng('52.5153264','13.4718734')}
{$google_maps.address}
{$google_maps.addtional}
```

## Roadmap:

1. Google Sitemap
       generate google sitemap
2. Google Maps V3
       generate map

3. Google Fonts
4. Google+
5. Static Google Maps
6. Google YouTube


## Versions:
- 1.0.2
    - add Google Maps (GeoCords)
- 1.0.1
   - add Google URL Shortner
   - add Google Analytics
