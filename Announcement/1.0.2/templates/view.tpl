{foreach from=$view item=value}
    <form class="pg_announce_textarea" id="pg_view_style">
            <input type="hidden" name="view_id" id="view_id" value="{$value.id}" />
            <!--<input type="text" name="view_title" id="view_title" value="{$value.title}" />-->
            <!--<textarea col="80" row="50" name="view_newpost" id="modify_newpost">{$value.content}</textarea>	       -->
	    <p id="view_title" class="pg_viewTitle_style">{$value.title}</p>
	    <p id="modify_newpost" class="pg_viewContent_style">{$value.content}</p>
	    <a href="#" class="btn_apply fix" title="Ok" onclick="addpostsave();">Okay</a>  
    </form>
{/foreach} 
