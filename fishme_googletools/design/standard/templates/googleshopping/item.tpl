<div class="gss-item">
    <div class="image">
        {if $item.data_map.images}
            <a href="{$item.data_map.link}" target="_blank"><img src="{$item.data_map.images.0.thumbnails.0.link}" /></a>
        {/if}
    </div>
    <div class="product-text">
        <h3><a href="{$item.data_map.link}" target="_blank">{$item.data_map.title}</a></h3>
        <p>{$item.data_map.description|shorten( 300 )}</p>
        <table>
            <tr>
                <td>{"Brand:"|i18n("design/standard/googletools_gss")}</td>
                <td><b>{$item.data_map.brand}</b></td>
            </tr>
            <tr>
                <td>{"Availability:"|i18n("design/standard/googletools_gss")}</td>
                <td><b>{$item.data_map.inventories.0.availability}</b></td>
            </tr>
            <tr>
                <td>{"Price:"|i18n("design/standard/googletools_gss")}</td>
                <td><b>{$item.data_map.inventories.0.price} {$item.data_map.inventories.0.currency}</b></td>
            </tr>
        </table>
    </div>
    <div class="clear"></div>
    <hr>
</div>