<!-- Blue Template   -->
        {$sScriptCrossDomain}
	<input type="hidden" id="server_url" value="{$sPgDir}" />
        <input type="hidden" id="setInterval" value="{$setInterval}" />
        {if $template eq "gray"}
            <div id="pg_announce_gray_wrap">
        {else}
            <div id="pg_announce_blue_wrap">
        {/if}
		<h4>Announcement</h4>
		<div class="pg_announce_wrap1">
                        <p class="pg_announce_subheader">Latest Announcement</p>
			<div class="pg_announcement_content1">
                            
                         
                                 <ul id="pg_announce_accordion" > 
                                    {foreach from=$latest item=value}
                                       <li> <h3><a href="#none" class="pg_announce_title" rel="{$value.id}" onclick="PG_Announcement.showThis(this);" ><span class="pg_announce_h">{$value.title}</span></a></h3>
                                        <div class="content_id"><p class="showHide" style="display:none;"> </p> </div></li>
                                   {/foreach}
                                </ul>
                       
                        </div>
               </div>
        </div>
                        
      