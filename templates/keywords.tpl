{form_start}
<script src="{moduleUrl}/assets/tag-it-6ccd2de/js/tag-it.min.js"></script>
<link href="{moduleUrl}/assets/tag-it-6ccd2de/css/jquery.tagit.css" rel="stylesheet" type="text/css">
<script src="{moduleUrl}/assets/tags.js"></script>
<link href="{moduleUrl}/assets/tags.css" rel="stylesheet" type="text/css">
<div class="pageoverflow">
	<p class="pagetext"></p>
	<p class="pageinput">
		<input type="submit" name="{$actionid}submit" value="Opslaan" class="pagebutton">
		<input type="submit" name="{$actionid}cancel" formnovalidate value="Ongedaan maken" class="pagebutton">
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext"><label for="tags">Sleutelwoorden beheren:</label></p>
	<p class="pagetext small">Gebruik ENTER of TAB om uw sleutelwoord te bevestigen.</p>
	<div class="pageinput">
		<ul id="tags" data-name="{$actionid}keywords[]">
			{foreach $keywords as $keyword}
				<li>{$keyword|htmlentities}</li>
			{/foreach}
		</ul>
	</div>
</div>
{form_end}