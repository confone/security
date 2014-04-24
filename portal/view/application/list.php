<?php

include 'view/include/header.php';
?>
<div id="new_application">
<form action="/application/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" name="application_name" placeholder="(Application Name)" />
<input type="text" name="description" placeholder="(Description)" />
<input type="submit" class="button" value="Create" />
</form>
</div>
<?php foreach ($user->getApplications() as $application) { ?>
<div><a href="/application/detail?id=<?=$application->getId(); ?>"><?=$application->getName(); ?></a></div>
<?php } ?>
<?php 
include 'view/include/footer.php'
?>