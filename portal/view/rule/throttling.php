<?php
$stylesheets = array('rule.css');
$scripts = array('rule.js');

$name = isset($rule) ? $rule->getName() : '';
$duration = isset($rule) ? $rule->getDuration() : '';
$allowance = isset($rule) ? $rule->getAllowance() : '';
$waitTime = isset($rule) ? $rule->getWaitTime() : '';
$description = isset($rule) ? $rule->getDescription() : '';

$action = isset($rule) ? '/rule/update' : '/rule/new';

include 'view/include/header.php';
?>
<div class="new_rule">
<form action="<?=$action ?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<?php if (isset($rule)) { ?>
<label><?=$name ?></label>
<?php } else { ?>
<input type="text" name="name" placeholder="(Name)" value="<?=$name ?>" />
<?php } ?>
<input type="text" name="duration" placeholder="(duration)" value="<?=$duration ?>" />
<input type="text" name="allowance" placeholder="(allowance)" value="<?=$allowance ?>" />
<input type="text" name="wait_time" placeholder="(wait_time)" value="<?=$waitTime ?>" />
<input type="text" name="description" placeholder="(description)" value="<?=$description ?>" />
<input type="hidden" name="type" value="<?=RuleThrottling::TYPE ?>" />
<?php if (isset($groupId)) { ?>
<input type="hidden" name="group_id" value="<?=$groupId ?>" />
<?php } ?>
<?php if (isset($rule)) { ?>
<input type="hidden" name="rule_id" value="<?=$rule->getId() ?>" />
<?php } ?>
<input type="hidden" name="application_id" value="<?=$applicationId ?>" />
<input type="submit" class="button" value="Submit" />
</form>
</div>
<?php 
include 'view/include/footer.php'
?>