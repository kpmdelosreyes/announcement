<input type="hidden" id="pg_announce_order" value="{$sOrderby}" />
<input type="hidden" id="pg_announce_sort" value="{$sSortby}" />
<input type="hidden" id="pg_announce_searchtype" value="{$sSearchType}" />
<input type="hidden" id="pg_announce_searchtext" value="{$sSearchText}" />
<input type="hidden" id="pg_announce_startdate" value="{$sStartDate}" />
<input type="hidden" id="pg_announce_enddate" value="{$sEndDate}" />


<ul class="row_1">
                    <li class="comment">
                            <span class="all selected">All ({$iTotalRow})</span>
                    </li>					
             </ul>                        
            
            <!-- // table header -->
            <ul style="margin-top:20px">
                    <li style="display:inline">
                            <span>			
                                    <input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis();" value="Delete" />
                            </span>
                    </li>
                    <li style="display:inline;float:right">
                            <span>
                                    <label for="pg_simplenote_showrow"  >Show Rows</label>
                                    <select id="pg_simplenote_showrow" onchange="paginate();">
                                        <option{if $iLimit == "10"} selected{/if}>10</option>
					<option{if $iLimit == "20"} selected{/if}>20</option>
					<option{if $iLimit == "30"} selected{/if}>30</option>
					<option{if $iLimit == "50"} selected{/if}>50</option>
					<option{if $iLimit == "100"} selected{/if}>100</option>
                                    </select>
                            </span>
                    </li>
            </ul>
            <!-- table horizontal -->
            <table border="1" cellpadding="0" cellspacing="0" class="table_hor_02" style="margin-top:10px;">
                    <colgroup>
                            <col width="5%" />
                            <col width="5%" />
                            <col width="65%" />	
                            <col width="12%" />				
                            <col width="13%" />					
                    </colgroup>
                    <thead>			
                            <tr id="">
                                    <th class="chk"><input type="checkbox" id="select-all" title="select all" class="input_chk" onClick="checkAll(this);" /></th>
                                    <th>No.</th>
                                    <th><a href="#" {if $sOrderby == 'pad_title'}class="{if $sSortby == 'DESC'}asc{else}desc{/if}"{/if} onclick="sortThis('pad_title','{if $sSortby == 'DESC'}ASC{else}DESC{/if}')">Announcement</a></th>				
                                    <th><a href="#" {if $sOrderby == 'pad_modified_date'}class="{if $sSortby == 'DESC'}asc{else}desc{/if}"{/if} onclick="sortThis('pad_modified_date','{if $sSortby == 'DESC'}ASC{else}DESC{/if}')">Registered Date</a></th>		
                                    <th class="no_border">Management</th>
                            </tr>
                    </thead>
                    <tbody id="pg_tbl_content">
                       
                        {if $aData|@count gt 0}
                        {foreach from=$aData key=key item=value}
                           
                            <tr onmouseover="this.className='over'" onmouseout="this.className=''" style="border:1px solid green">
                                <input type="hidden" name="hidden_id" id="hidden_id" value="{$value.id}" />
                                <td><input type="checkbox" id="{$value.pad_idx}" value="{$value.id}" name="file_checkbox"  title="" class="input_chk" /></td>
                                <td>{$value.pad_no} </td>
                                <td class="table_subtitle"><a href="#" title="View Content" onclick="viewPost({$value.id});return false;" >{$value.title}</a></td>				
                                <td>{$value.date}</td>				
                                <td>
                                    <input type="button" class="btn_2" name="modify"  id="modify" style="margin-right:5px" onclick="modifypost({$value.id});return false;" value="Modify" />
                                    <!--<input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis({$value.id});" value="Delete" /> -->
                                </td>		
                            </tr>
                        {/foreach}
                        {else}
			 <tr>
				<td colspan="5" class="data_none">No registered note has been found.</td>
			</tr> 
			{/if}
                    </tbody>
            </table>
            <!-- // table horizontal -->	
            <div style="margin-top:10px">			
                    <span><input type="button" id="delete" name="delete" class="btn_2" onclick="deleteThis();" value="Delete" /></span>
                    <span style="float:right"><input type="button" id="addpost" name="addpost" value="Add New Post" class="btn_2" onclick="addnewpost();return false;" /></span>
            </div>	
            <!-- pagination -->
            <div class="pagination">				
                   {$pagination}				
            </div>