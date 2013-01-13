{if $products.previousLink}
    <a href="{$products.previousLink}">{"previous page"|i18n("design/standard/googletools_gss")}</a>
{/if}
{if $products.nextLink}
    <a href="{$products.nextLink}">{"next page"|i18n("design/standard/googletools_gss")}</a>
{/if}
    --- <span><b>{$products.currentPage}</b>/{$products.maxPages}</span>