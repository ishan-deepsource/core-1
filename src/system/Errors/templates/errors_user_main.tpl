<div class="z-fullerror">
    <h1>{gt text="Error on %s" tag1=$modvars.ZConfig.sitename}</h1>
    <ul>
        {foreach from=$messages item=message}
        <li>{$message|safehtml}</li>
        {/foreach}
    </ul>
    <p><a href="javascript:history.back(-1)">{gt text="Go back to previous page"}</a></p>
</div>
