<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

include 'view/include/header.php';
include 'view/application/part/detail-right.php';

$groups = $application->getGroups();
$rules = $application->getRootGroup()->getRules();

global $base_host;
?>
<div class="list_holders" style="min-height:100px;">
<div class="title">
<button class="new_holder_btn round4" onclick="javascript:showHideDiv('new_path')">+ | new group</button>
<a href="javascript:hideShowDiv('group_list')" onclick="javascript:updateExpendLabel('group_exp')">App Groups <span id="group_exp">(-)</span></a>
</div>
<div id="new_path" class="new_holder">
<form action="/application/group/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" class="round4 holder_name" name="group_name" placeholder="(Group Name)" />
<input type="hidden" name="application_id" value="<?=$application->getId() ?>" />
<input type="submit" class="button round4" value="Submit" />
</form>
</div>
<div id="group_list" class="holders">
<?php if (!empty($groups)) {
foreach ($groups as $group) { ?>
<div class="pdata">
<span class="detail">rules: <?=$group->countGroupRules() ?></span>
</div>
<div class="section"><a class="project_link" href="/application/group?application_id=<?=$application->getId() ?>&id=<?=$group->getId() ?>"><?=$group->getGroupName() ?></a>
</div>
<?php } 
} else { ?>
<center><div id="no_application">No group yet, <a id="create_now" href="javascript:showHideDiv('new_path')">create now</a> !</div></center>
<?php } ?>
</div>
</div>
<?php 
include 'view/include/footer.php'
?>