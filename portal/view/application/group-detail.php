<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

global $base_host;

include 'view/include/header.php';
?>
<div class="add_rule">
New Rule: 
<select id="rule_type">
<option value="throttling">Throttling</option>
</select>
<input type="hidden" id="group_id" value="<?=$group->getId() ?>" />
<input type="hidden" id="application_id" value="<?=$applicationId ?>" />
<input type="button" onclick="javascript:addNewRule('<?=$base_host ?>')" class="button" value="Add" />
</div>
Application Group: <?=$group->getGroupName() ?><br>
Rules:
<?php foreach ($group->getRules() as $rule) { ?>
<div><a href="<?=$rule->getUrl() ?>&application_id=<?=$applicationId ?>"><?=$rule->getName(); ?></a></div>
<?php } ?>
<?php 
include 'view/include/footer.php';
?>