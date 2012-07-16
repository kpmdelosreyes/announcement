<h3>Modify Post</h3>
   {foreach from=$modify item=value}
    <form class="pg_announce_textarea" style="border:1px solid red;">
            <input type="hidden" name="modify_id" id="modify_id" value="{$value.id}" />
            <input type="text" name="modify_title" id="modify_title" value="{$value.title}" />
            <textarea col="80" row="50" name="modify_newpost" id="modify_newpost">{$value.content}</textarea>	
            <a href="#" class="btn_apply" title="Save" onclick="modifypostSave({$value.id});">Save</a>  

    </form>
    {/foreach} 

<!--<h3>Delete Category</h3>
  <form class="pg_announce_textarea" style="border:1px solid red ;">
	<p>Are you sure<br />
		you want to delete?</p>
	<div class="layer_btn_center topmg"><a href="#" class="btn_ly" title="Delete">Delete</a></div>
	<a href="#layer_01" class="clse" title="popup close" onclick="document.getElementById('layer_01').style.display='none'">X</a>
    </form>

	<!--<h3>Modify Post</h3>
   {foreach from=$modify item=value}
    <form class="pg_announce_textarea" style="border:1px solid red;">
            <input type="hidden" name="modify_id" id="modify_id" value="{$value.id}" />
            <input type="text" name="modify_title" id="modify_title" value="{$value.title}" />
            <textarea col="80" row="50" name="modify_newpost" id="modify_newpost">{$value.content}</textarea>	
            <a href="#" class="btn_apply" title="Save" onclick="modifypostSave({$value.id});">Save</a>  

    </form>
    {/foreach} 