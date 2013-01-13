<h1>Fishme Googleshoppingsearch - Prototype</h1>
<div id="gss_list">
    <form>
        <input type="text" class="text-input" name="q" value="{if ezhttp_hasvariable('q','get')}{ezhttp('q','get')}{else}{"SEARCH"|i18n("design/standard/googletools_gss")}{/if}" onclick="if (this.value == '{"SEARCH"|i18n("design/standard/googletools_gss")}') this.value = ''" />
        <fieldset>
            <legend>{"Price"|i18n("design/standard/googletools_gss")}</legend>
            from <input type="text" name="filter_from_price" value="{if ezhttp_hasvariable('filter_from_price','get')}{ezhttp('filter_from_price','get')}{/if}" /> USD to <input type="text" name="filter_to_price" value="{if ezhttp_hasvariable('filter_to_price','get')}{ezhttp('filter_to_price','get')}{/if}" /> USD
        </fieldset>
        <fieldset>
            <legend>{"Brand"|i18n("design/standard/googletools_gss")}</legend>
            only brand: <input type="text" name="filter_brand" value="{if ezhttp_hasvariable('filter_brand','get')}{ezhttp('filter_brand','get')}{/if}" /> <small>example: Nike, Calvin Klein</small>
        </fieldset>
        <input type="submit" name="send" value="send" />
        
    </form>
{if ezhttp_hasvariable('q','get')}

    {def $offset = '1'}

    {if $view_parameters.startIndex}
        {set $offset = $view_parameters.startIndex}
    {/if}

    {def $search_text = ezhttp('q','get')
         $filter = fs_get_GoogleShoppingSearch_filter()
         $products = fs_get_GoogleShoppingSearch($search_text, $offset, $filter)
    }
    {if gt($products.totalItems,0)}
        {$products.api_url}
        <h2>{'%1 items found when searching for "%2"'|i18n("design/standard/content/googletools_gss",,array($products.totalItems,$search_text|wash))}</h2>
        {include uri='design:googleshopping/pager.tpl' products=$products}
        {foreach $products.items as $key => $item}
            {include uri='design:googleshopping/item.tpl' item=$item}
        {/foreach}
        {include uri='design:googleshopping/pager.tpl' products=$products}
    {else}
        {'No results were found when searching for "%1" - maybe %2'|i18n("design/standard/content/googletools_gss",,array($search_text|wash,concat('<a href="' , $products.word_suggestion.url,'">', $products.word_suggestion.word,'</a>')))}
    {/if}
{else}
    {"No results founded!"|i18n("design/standard/googletools_gss")}
{/if}
</div>