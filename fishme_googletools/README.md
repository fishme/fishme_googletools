# eZ Publish extension: fishme_googletools

from David Hohl - feel free and contact me about www.ez-publish-blog.de or www.fishme.de

The eZ Publish fishme_googletools extension includes follow tools:

- Google URL Shortener
- Google Analytics
- Google Maps (only GeoCords)
- Google Translate
- Google ShoppingSearch
- Google Youtube
- Google Webfonts


## Requirements:
- eZ Publish 4.x
- Google API Key https://code.google.com/apis/console for
    - Google URL Shortener
    - Google Translate
    - Google Shopping Search

## Install:
- Enable the extension in eZ Publish. Do this by opening settings/override/site.ini.append.php ,
   and add in the [ExtensionSettings] block:
   ActiveExtensions[]=fishme_googletools
- Regenerate autoloads: php bin/php/ezpgenerateautoloads.php -e
- Clear your cache
- look into extension/fishme_googletools/settings/fishme_googletools.ini.settings.php

## Examples:

### Google URL Shortener

**Features**:
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

**Features:**
- output default google anayltics code

generate google analytics code (for more options look into the fishme_googletools.ini)
```bash
{def $google_analytics = fs_get_GoogleAnalyticsCode()}
{$google_analytics}
```

### Google Maps

**Features:**
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
params:
    - lat
    - lng
```bash
{def $google_maps = fs_get_GoogleMaps_geocode_by_latlng('52.5153264','13.4718734')}
{$google_maps.address}
{$google_maps.addtional}
```

### Google Translate

**Features:**
- translate text from X language to Y language

info: Google Translate is not a free service, please check the pricing https://developers.google.com/translate/v2/pricing?hl=de

params:
    - your text
    - source language
    - target language
```bash
{def $google_translation = fs_get_GoogleTranslate('Hello World!', 'en', 'de')}
{$google_translation}
```

### Google Shopping Search

**Features:**
- product search
- price filter
- brand filter
- paging
- boosting
- sort
- availability
- currency, country and language support

you need a google

include follow Template in your layout:
```bash
{include uri='design:googleshopping/list.tpl'}
```
search for products:
```bash
{def    $filter = fs_get_GoogleShoppingSearch_filter()
        $products = fs_get_GoogleShoppingSearch($search_text, $offset, $filter)
}
```
for informations look into the operator class /extension/fishme_googletools/classes/operators/GoogleShoppingSearch.php or into /extension/fishme_googletools/design/standard/templates/googleshopping/list.tpl
Settings: (fishme_googletools.ini.settings.php)

### Google YouTube Player

**Features**
- as customtag in ezoe (ezxml)
- you can include it

```bash
{include uri='design:googleyoutube/player.tpl' googleyoutube_code='0_lFJW-ULMo'}
```

### Google Webfonts

**Features:**
- use a google webfont in your site
- and/or Typekit http://typekit.com/
- and/or Ascender http://www.fontslive.com/
- and/or Fonts.com web fonts http://webfonts.fonts.com/
- and/or Fontdeck http://fontdeck.com/

Include in your page_head_style.tpl about any eZ Includes follow line

```bash
    {include uri='design:googlewebfonts/set_fonts.tpl'}
```

for examples - include in your content
```bash
    {include uri='design:fishme_tests/googlewebfonts.tpl'}
```
or look into extension/fishme_googletools/settings/fishme_googletools.ini.settings.php


## Roadmap:

1. Google Sitemap (generate google sitemap)
2. Google Maps V3 (generate map)
3. Google+
4. Static Google Maps
5. Google Shopping search (facets)


## Versions:
- 1.0.6
    - add Google Webfonts (load font by CSS or JS)
- 1.0.5
    - add Google YouTube Player as Customtag
- 1.0.4
    - add Google Shopping Search
- 1.0.3
    - add Google Translate
- 1.0.2
    - add Google Maps (GeoCords)
- 1.0.1
   - add Google URL Shortner
   - add Google Analytics
