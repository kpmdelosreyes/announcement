	<input type="hidden" id="pg_announce_order" value="{$sOrderby}" />
	<input type="hidden" id="pg_announce_sort" value="{$sSortby}" />
	<input type="hidden" id="pg_announce_searchtype" value="{$sSearchType}" />
	<input type="hidden" id="pg_announce_searchtext" value="{$sSearchText}" />
	<input type="hidden" id="pg_announce_startdate" value="{$sStartDate}" />
	<input type="hidden" id="pg_announce_enddate" value="{$sEndDate}" />
	<div class="table_header_area" >
		<ul class="row_1" >
			<li class="comment">
				<span class="all selected">All ({$iTotalRow})</span>
			</li>					
		</ul>
		<ul class="row_2">
			<li>
				<a href="#none" class="btn01" onclick="PLUGIN_Announce_content.confirmDelete();">Delete</a>
			</li>
			<li class="show">
				<label for="pg_announce_showrow">Show Rows</label>
				<select id="pg_announce_showrow" onchange="PLUGIN_Announce_content.paginate();">
					<option{if $iLimit == "10"} selected{/if}>10</option>
					<option{if $iLimit == "20"} selected{/if}>20</option>
					<option{if $iLimit == "30"} selected{/if}>30</option>
					<option{if $iLimit == "50"} selected{/if}>50</option>
					<option{if $iLimit == "100"} selected{/if}>100</option>
				</select>
			</li>
		</ul>
	</div>
	<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02">
		<colgroup>
			<col width="40px" />
			<col width="40px" />
			<col  />
			<col width="170px" />				
			<col width="170px" />				
		</colgroup>
		<thead>			
			<tr id="">
				<th class="chk"><input type="checkbox"  title="" class="input_chk" onclick="PLUGIN_Announce_content.checkAll(this);" /></th>
				<th>No.</th>
				<th><a href="javascript:void(0);" {if $sOrderby == 'pad_title'}class="{if $sSortby == 'DESC'}asc{else}desc{/if}"{/if} onclick="PLUGIN_Announce_content.sortNote('pad_title','{if $sSortby == 'DESC'}ASC{else}DESC{/if}')">Announcement</a></th>				
				<th><a href="javascript:void(0);" {if $sOrderby == 'pad_modified_date'}class="{if $sSortby == 'DESC'}asc{else}desc{/if}"{/if} onclick="PLUGIN_Announce_content.sortNote('pad_modified_date','{if $sSortby == 'DESC'}ASC{else}DESC{/if}')">Registered Date</a></th>		
				<th class="no_border">Management</th>
			</tr>
		</thead>
		<tbody id="pg_announce_listcontent">
			{if $aData|@count gt 0}
			{foreach $aData as $sValue}
			<tr>
				<td><input type="checkbox" class="input_chk" value="{$sValue.pad_idx}"></td>
				<td>{$sValue.pad_no}</td>
				<td class="col_06">
					<a href="javascript:void(0);" onclick="PLUGIN_Announce_content.viewNote({$sValue.pad_idx});" >{$sValue.pad_title}</a>
				</td>
				<td>{$sValue.pad_datetime}</td>
				<td>
					<span>
						<input type="button" value="Modify" class="btn01" onclick="PLUGIN_Announce_content.showModify({$sValue.pad_idx})" />
					</span>
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
	<div class="table_header_area">
		<ul class="row_2">
			<li>
				<a href="#" class="btn01" onclick="PLUGIN_Announce_content.confirmDelete();">Delete</a>
			</li>
			<li class="show">
				<a href="javascript:void(0);" class="btn01" onclick="PLUGIN_Announce_content.addNote();">Add New Post</a>
			</li>
		</ul>
	</div>
	<!-- pagination -->
	<div class="pagination">
		{$sPagination}
	</div>
	<!-- // pagination -->