<?php
$stylesheets = array('application.css');
$scripts = array('application.js');

include 'view/include/header.php';
include 'view/application/part/list-right.php';
$applications = $user->getApplications();
?>
<div>
<div class="list_holders">
<div class="title"><button class="new_holder_btn round4" onclick="javascript:newApplication()">+ | new application</button>Your Security Apps</div>
<div id="new_application" class="new_holder">
<form action="/application/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" class="round4 holder_name" name="application_name" placeholder="(Application Name)" />
<input type="text" class="round4 holder_description" name="description" placeholder="(Description)" />
<input type="submit" class="button" value="Create" />
</form>
</div>
<div class="holders">
<?php if (!empty($applications)) {
foreach ($applications as $application) { ?>
<div class="pdata">
<span class="detail">groups: <?=$application->getGroupCount() ?></span>
<span class="detail">rules: <?=$application->getRuleCount() ?></span>
</div>
<div class="section"><a class="application_link" href="/application/detail?id=<?=$application->getId(); ?>"><?=$application->getName(); ?></a>
<span class="description"><?=$application->getDescription(); ?></span></div>
<?php } 
} else { ?>
<center><div id="no_application">No application yet, <a id="create_now" href="javascript:newApplication()">create now</a> !</div></center>
<?php } ?>
</div>
</div>
</div>
<?php 
include 'view/include/footer.php'
?>