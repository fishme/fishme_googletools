<?php /*

[Settings]
# you get the key for all services on https://code.google.com/apis/console
# you need this key for "Google Url Shortener", "Google Translate", "Google Shopping Search"
# under "API Access" generate a "New Browser Key" and copy the "API Key"
key=XXX



################################################
# Only if you use the google_api with AUTH2
################################################

# Installation!
# you need to activate the AUTH2 in https://code.google.com/apis/console/ under API Access
# 1) and add a "New ClientID"
# 2) select Web application
# 3) input your domain
# 4) click on "more options"
# 5) in the field for "Authorized Redirect URIs" remove "/oauth2callback"
# 6) and press "Create Client ID"

# Copy your "Client ID"
clientID=XXX

# Copy your "Client Secret"
clientSecret=XXX

# under "API Access" generate a "New Server Key" and the Server IP and copy the "API Key"
developerkey=XXX


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
[GoogleWebFonts]

# include the webfont with css or js
# live example: look into fishme_tests/googlewebfonts.tpl

include_by[]
include_by[]=css
include_by[]=js


# all googlewebfonts - http://www.google.com/webfonts

# include you font about CSS
api_url=http://fonts.googleapis.com/css

# description
# family:style,nextstyle
# Tangerine:bold,bolditalic

# style
# bold          = bold or b
# italic        = italic or i or a numerical weight such as 700
# bold italic   = bolditalic or bi

# effects - this settings works only on a set of browsers please check the google documentation https://developers.google.com/webfonts/docs/getting_started?hl=de#Effects
# brick-sign or canvas-print ....

# example without effects and style
# fonts[]=family=Tangerine


# example without any effects, but with style
# fonts[]=family=Tangerine:bold,bolditalic

# exmaple with a brick effect
# just use &effect=EFFECTNAME
# fonts[]=family=Tangerine:bold,bolditalic&effect=shadow-multiple

fonts[]
fonts[]=family=Tangerine:bold,bolditalic&effect=shadow-multiple


## WEB FONT LOADER!

# load any font from your fontprovider
# Google
# Typekit               - http://typekit.com/
# Ascender              - http://www.fontslive.com/
# Fonts.com web fonts   - http://webfonts.fonts.com/
# Fontdeck              - http://fontdeck.com/

# settings for googlewebfonts Loader
# please read the Load documentation for more use  - https://developers.google.com/webfonts/docs/webfont_loader

# api url without http or https
api_url_loader=ajax.googleapis.com/ajax/libs/webfont/1/webfont.js

# example for typekit
# webfont_loader[typekit] = typekit: { id: 'myKitId'}
#
# Description               KEY
# Google                - google
# Typekit               - typekit
# Ascender              - ascender
# Fonts.com web fonts   - monotype
# Fontdeck              - fontdeck
#
# of course you can use more as one!

webfont_loader[]
webfont_loader[google]= { families: [ 'Tangerine', 'Cantarell' ] }

##################################################

*/ ?>