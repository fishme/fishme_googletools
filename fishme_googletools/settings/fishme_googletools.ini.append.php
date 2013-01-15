<?php /*

[Settings]
# you get the key for all services on https://code.google.com/apis/console
# you need this key for "Google Url Shortener", "Google Translate", "Google Shopping Search"
key=XXX

##################################################

[GoogleUrlShortener]
api_url=https://www.googleapis.com/urlshortener/v1/url

##################################################

[GoogleAnalytics]
key=UA-XXXXX-1
# Example for anonymize the userIP
# extra_code=_gaq.push (['_gat._anonymizeIp']);
extra_code=_gaq.push (['_gat._anonymizeIp']);

##################################################

[GoogleMaps]
geocode_api_url=http://maps.googleapis.com/maps/api/geocode/json
sensor=true

##################################################

[GoogleTranslate]
api_url=https://www.googleapis.com/language/translate/v2


##################################################
[GoogleShoppingSearch]
api_url=https://www.googleapis.com/shopping/search/v1/public/products

#default settings
language=en
currency=USD
country=US
#integer 1...1000
maxResults=20

thumbnails=125:*,200:*

#example for (brand=Nike|Puma):value:1.5,(price=[30,*]):value:0.8
boostBy=

# Comma separated list of availabilities to return
# unknown, outOfStock, limited, inStock, backorder, preorder, onDisplayToOrder
availability=limited,inStock

# sortby: price, modificationTime or relevancy
# price ascending|descending
# modificationTime ascending|descending
# relevancy
sortBy=price:ascending

# It is possible to specify multiple crowding rules, separated via comma. The following crowding rules are supported:
# use "disabled" -> don't use it :)
# accountId:XXXXXX
# brand:XXXX
# just select between used, refurbished or new
# condition: used|refurbished|new
# price:12.33

crowdBy=disabled

##################################################
[GoogleYouTube]
api_url=https://www.youtube.com/v/

# player settings
width=640
height=390

# 0 = off
# 1 = on
autoplay=0

#API Version
version=3

#options: white, red, black, default
color=white

# 0 = Player controls do not display in the player. For AS3 players, the Flash player loads immediately.
# 1 = Player controls display in the player. For AS3 players, the Flash player loads immediately.
# 2 = Player controls display in the player. For AS3 players, the Flash player loads afer the user initiates the video playback.
controls=1

# Setting to 1 will disable the player keyboard controls.
disablekb=0

# Values: 1 or 3. Default is 1. Setting to 1 will cause video annotations to be shown by default, whereas setting to 3 will cause video annotation to not be shown by default.
iv_load_policy=1

# This parameter indicates whether the player should show related videos when playback of the initial video ends.
rel=1

#dark and light
theme=light


##################################################

*/ ?>