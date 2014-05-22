<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

global $base_host;

include 'view/include/header.php';
include 'view/application/part/group-right.php';

$rules = $group->getRules();
?>
<div class="list_holders">
<div class="title">
<button class="new_holder_btn round4" onclick="javascript:showHideDiv('new_rule')">+ | new rule</button>
App Group: <label id="group_name"><?=$group->getGroupName() ?></label>
</div>
<div id="new_rule" class="new_holder">
<label>Rule type:</label>
<?php include 'view/application/part/rule-select.php'; ?>
<input type="hidden" id="group_id" value="<?=$group->getId() ?>" />
<input type="hidden" id="application_id" value="<?=$applicationId ?>" />
<input type="button" onclick="javascript:addNewRule('<?=$base_host ?>')" class="button round4" value="Add" />
</div>
<div id="rule_list">
<label>List of Rules:</label>
<?php $index = 1; foreach ($rules as $rule) { ?>
<div <?=($index%2==1 ? 'class="odd"' : '') ?>>
<div class="type">type: <?=$rule->getType() ?></div>
<a href="<?=$rule->getUrl() ?>&application_id=<?=$applicationId ?>"><?=$rule->getName(); ?></a>
</div>
<?php $index++; } ?>
</div>
</div>
<?php 
include 'view/include/footer.php';
?>