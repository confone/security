<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

global $base_host;

include 'view/include/header.php';
?>
<div class="new_group">
<form action="/application/group/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" name="group_name" placeholder="(Group Name)" />
<input type="hidden" name="application_id" value="<?=$application->getId() ?>" />
<input type="submit" class="button" value="Submit" />
</form>
</div>
<div class="add_rule">
New Rule: 
<?php include 'view/application/part/rule-select.php'; ?>
<input type="hidden" id="application_id" value="<?=$application->getId() ?>" />
<input type="button" onclick="javascript:addNewRule('<?=$base_host ?>')" class="button" value="Add" />
</div>
<div>
Public Key: <?=$application->getPublicKey() ?><br>
Private Key: <?=$application->getPrivateKey() ?>
</div>
<div>
Groups:<br>
<?php foreach ($application->getGroups() as $group) { ?>
<div><a href="/application/group?application_id=<?=$application->getId() ?>&id=<?=$group->getId() ?>"><?=$group->getGroupName(); ?></a></div>
<?php } ?>
</div>
<div>
Rules:<br>
<?php foreach ($application->getRootGroup()->getRules() as $rule) { ?>
<div><a href="<?=$rule->getUrl() ?>&application_id=<?=$application->getId() ?>"><?=$rule->getName(); ?></a></div>
<?php } ?>
</div>
<?php 
include 'view/include/footer.php'
?>