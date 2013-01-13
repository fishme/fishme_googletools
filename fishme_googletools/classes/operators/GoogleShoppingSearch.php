<?php
/**
 * Operator for Google Shopping Search
 *
 * @author David Hohl <info@fishme.de>
 * @copyright Copyright (C) 2005-2013 fishme.de All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version 1.0.4
 */

class fs_GoogleShoppingSearch_operator
{

    var $Operators;

    var $fs_settings = '';

    var $api_url = '';

    function fs_GoogleShoppingSearch_operator()
    {
        $this->Operators = array(
            'fs_get_GoogleShoppingSearch',
            'fs_get_GoogleShoppingSearch_spellchecking',
            'fs_get_GoogleShoppingSearch_facet',
            'fs_get_GoogleShoppingSearch_filter'
        );
    }

    function &operatorList()
    {
        return $this->Operators;
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'fs_get_GoogleShoppingSearch' => array(
                'text' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'startIndex' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
                'filter' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
                'sortby' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
                'boostBy' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
                'maxResults' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),

            ),
            'fs_get_GoogleShoppingSearch_filter' => array(
                'filter' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => false
                ),
            ),
            'fs_get_GoogleShoppingSearch_facet' => array(
                'text' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'by' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
            ),

        );
    }

    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        $this->fs_settings = array(
                    'key'       =>  eZINI::instance('fishme_googletools.ini')->variable( 'Settings', 'key' ),
                    'api_url'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'api_url' ),
                    'language'  =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'language' ),
                    'currency'  =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'currency' ),
                    'country'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'country' ),
                    'maxResults'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'maxResults' ),
                    'sortBy'    =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'sortBy' ),
                    'crowdBy'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'crowdBy' ),
                    'thumbnails'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'thumbnails' ),
                    'boostBy'   =>  eZINI::instance('fishme_googletools.ini')->variable( 'GoogleShoppingSearch', 'boostBy' )
        );

        switch ( $operatorName ) {
            case 'fs_get_GoogleShoppingSearch':
                $operatorValue = $this->fs_get_GoogleShoppingSearch($namedParameters);
                break;
            case 'fs_get_GoogleShoppingSearch_filter':
                $operatorValue = $this->fs_get_GoogleShoppingSearch_filter($namedParameters);
                break;
            case 'fs_get_GoogleShoppingSearch_facet':
                $operatorValue = $this->fs_get_GoogleShoppingSearch_facet($namedParameters);
                break;
        }
    }

    public function fs_get_GoogleShoppingSearch($namedParameters) {

        $url_params = '';

        // Sort by
        $sort_by = $namedParameters['sortby'];
        if(!$namedParameters['sortby']) {
            $sort_by = $this->fs_settings['sortBy'];
        }

        $url_params = '&sortby=' . urlencode($sort_by);

        // max results
        $max_results = $namedParameters['maxResults'];
        if(!$max_results) {
            $max_results = $this->fs_settings['maxResults'];
        }

        $url_params .= '&maxResults=' . $max_results;

        // Start Index
        $startIndex = $namedParameters['startIndex'];
        if(!$startIndex) {
            $startIndex = '1';
        }

        $url_params .= '&startIndex=' . $startIndex;

        // Boost by
        // GET boostBy=(brand=Nike|Puma):value:1.5,(price=[30,*]):value:0.8

        $boostBy = '';
        if($this->fs_settings['boostBy']) {
            $boostBy = '&boostBy=' . $this->fs_settings['boostBy'];
        }

        // rewrite with boostby params
        if($namedParameters['boostBy']) {
            $boostBy = '&boostBy=' . $namedParameters['boostBy'];
        }
        $url_params .= $boostBy;

        // add Filter
        //restrictBy=brand=Nike|Calvin+Klein,price=[10,20]
        if($namedParameters['filter']) {
           $url_params .= '&restrictBy=' . $namedParameters['filter'];
        }

        // image size for thumbnails
        $url_params .= '&thumbnails=' . $this->fs_settings['thumbnails'];

        // spelling tip
        $url_params .= '&spelling.enabled=true';

        // get products from google
        $products = $this->get_Products($namedParameters, $url_params);

        $items = array();
        // get next index
        if($products->totalItems > 0) {
            foreach($products->items as $item_key => $item) {

                // add inventories (price, availabe..)
                $inventories = array();
                if(is_array($item->product->inventories) && count($item->product->inventories) > 0)  {
                    foreach($item->product->inventories as $key => $value) {
                        $inventories[$key] = array(
                                'channel'           => $value->channel,
                                'availability'      => $value->availability,
                                'price'             => $value->price,
                                'shipping'          => $value->shipping,
                                'currency'          => $value->currency,
                                'originalPrice'     => $value->originalPrice,
                                'saleEndDate'       => $value->saleEndDate,
                                'tax'               => $value->tax,

                        );

                    }
                }

                // add images
                $images = array();
                if(is_array($item->product->images) && count($item->product->images) > 0)  {
                    foreach($item->product->images as $key => $value) {
                        $images[$key] = array(
                                'link'           => $value->link,
                                'status'         => $value->status,
                        );
                        if(is_array($value->thumbnails) && count($value->thumbnails) > 0) {
                            foreach($value->thumbnails as $t_key => $t_value) {
                                $images[$key]['thumbnails'][$t_key] = array(
                                    'width'     => $t_value->width,
                                    'height'    => $t_value->height,
                                    'link'      => $t_value->link,

                                );
                            }

                        }

                    }
                }

                // product attributes
                $attributes = array();
                if(is_array($item->product->attributes) && count($item->product->attributes) > 0)  {
                    foreach($item->product->attributes as $key => $value) {
                        $attributes[$key] = array(
                                'displayName'           => $value->displayName,
                                'status'                => $value->name,
                                'type'                => $value->type,
                                'unit'                => $value->unit,
                                'value'                => $value->value
                        );

                    }
                }

                // add product informations
                $items[$item_key] = array(
                            'kind'      =>  $item->kind,
                            'id'        =>  $item->id,
                            'selfLink'  => $item->selfLink,
                            'data_map'  => array(
                                    'googleId'          => $item->product->googleId,
                                    'providedId'          => $item->product->providedId,
                                    'author'            => array(
                                                            'name'          => $item->product->author->name,
                                                            'uri'           => $item->product->author->uri,
                                                            'email'         => $item->product->author->email,
                                                            'accountId'     => $item->product->author->accountId,
                                                            'aggregatorId'  => $item->product->author->aggregatorId

                                    ),
                                    'creationTime'      =>  $item->product->creationTime,
                                    'modificationTime'  =>  $item->product->modificationTime,
                                    'country'           =>  $item->product->country,
                                    'language'           =>  $item->product->language,
                                    'categories'        => $item->product->categories,
                                    'title'           =>  $item->product->title,
                                    'description'           =>  $item->product->description,
                                    'link'           =>  $item->product->link,
                                    'brand'           =>  $item->product->brand,
                                    'condition'           =>  $item->product->condition,
                                    'gtin'           =>  $item->product->gtin,
                                    'gtins'           =>  $item->product->gtins,
                                    'mpns'           =>  $item->product->mpns,
                                    'inventories'   => $inventories,
                                    'attributes'    => $attributes,
                                    'images'        => $images

                            ),
                );
            }
            $maxPages = round($products->totalItems / $products->itemsPerPage);
            $currentPage = round($products->startIndex / $products->itemsPerPage) + 1;
        }
        
        // reorgonize product list

        // set default filter settings
        $filter_url = '';
        if(is_array($_GET)) {
            foreach($_GET as $key => $value) {
                if(strstr($key,'filter_')) {
                    $filter_url .= '&' . $key . '='. $value;
                }
            }
        }

        // build next link
        $nextLink = '';
        if($products->nextLink) {
            $nextLink = '/(startIndex)/'.$this->convertUrlQuery($products->nextLink,'startIndex') . '?q=' . $namedParameters['text'] . $filter_url;
        }

        // build previous link
        $previousLink = '';
        if($products->previousLink) {
            $previousLink = '/(startIndex)/'.$this->convertUrlQuery($products->previousLink,'startIndex') . '?q=' . $namedParameters['text'] . $filter_url;
        }
        $result_products = array(
                'api_url'           =>  $this->api_url,
                'totalItems'        =>  $products->totalItems,
                'currentItemCount'  =>  $products->currentItemCount,
                'startIndex'        =>  $products->startIndex,
                'itemsPerPage'      =>  $products->itemsPerPage,
                'currentPage'       =>  $currentPage,
                'maxPages'          =>  $maxPages,
                'selfLink'          =>  $products->selfLink,
                'nextLink'          =>  $nextLink,
                'previousLink'      =>  $previousLink,
                'requestId'         =>  $products->requestId,
                'kind'              =>  $products->kind,
                'etag'              =>  $products->etag,
                'word_suggestion'   =>  array(
                                            'word' => $products->spelling->suggestion,
                                            'url' => str_replace('&q=' . urlencode($namedParameters['text']),'&q='.urlencode($products->spelling->suggestion),$_SERVER['HTTP_REFERER'])
                                        ),
                'items'             => $items
        );
        
        return $result_products;
    }


    public function fs_get_GoogleShoppingSearch_facet($namedParameters) {
        return $facets;
    }

    public function fs_get_GoogleShoppingSearch_filter($namedParameters) {

        // add filter: price
        if(key_exists('filter_from_price', $_GET) || key_exists('filter_to_price', $_GET)) {

            $price['filter_from_price'] = '*';
            $price['filter_to_price']   = '*';

            $prices_params = array('filter_from_price','filter_to_price');
            foreach($prices_params as $key => $value) {
                if(key_exists($value, $_GET) && $_GET[$value]) {
                    $price[$value] = $_GET[$value];
                }
            }

            $filter[] = 'price=['.implode(',',$price).']';
        }

        // add filter: brand
        if(key_exists('filter_brand', $_GET) && $_GET['filter_brand']) {
            $filter[] = 'brand=' . str_replace(',', '|', $_GET['filter_brand']);
        }

        return implode(',', $filter) . $namedParameters['filter'];

    }



    private function get_Products($params, $add_url='') {

        $this->api_url = $this->fs_settings['api_url'];
        $this->api_url .= '?key=' . $this->fs_settings['key']. '&q=' . urlencode($params['text']) . '&language=' . $this->fs_settings['language'] . '&country=' . $this->fs_settings['country'] . '&currency=' . $this->fs_settings['currency'] . '&alt=json' . $add_url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return json_decode($result);
    }

    private function convertUrlQuery($url, $key) {
        $url = parse_url($url);
        if($url['query']) {
            $queryParts = explode('&', $url['query']);
            foreach($queryParts as $k => $v) {
                $_v = explode('=',$v);
                if($_v[0] == $key)
                       return $_v[1];
            }
        }
        return '';
    }
}

?>
