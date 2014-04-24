<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

include 'view/include/header.php';
?>
<div class="add_rule">
<form action="/rule/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" name="code" placeholder="(Image Code)" />
<input type="hidden" name="group_id" value="<?=$group->getId() ?>" />
<input type="hidden" name="application_id" value="<?=$applicationId ?>" />
<input type="submit" class="button" value="Submit" />
</form>
</div>
Application Group: <?=$group->getGroupName() ?><br>
Rules:
<?php foreach ($group->getRules() as $rule) { ?>
<div><a href="/rule/detail?application_id=<?=$applicationId ?>&id=<?=$rule->getId() ?>"><?=$rule->getName(); ?></a></div>
<?php } ?>
<?php 
include 'view/include/footer.php';
?>