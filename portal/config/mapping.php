<?php
register('/index', new SecurityHomeController());

register('/application/list',   new ApplicationListController());
register('/application/detail', new ApplicationDetailController());

register('/rule/throttling', new RuleThrottlingController());

register('/howto', new SecurityHowtoController());
?>
