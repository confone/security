<?php
register('/index', new SecurityHomeController());

register('/application/list',      new ApplicationListController());
register('/application/detail',    new ApplicationDetailController());
register('/application/group',     new GroupDetailController());
register('/application/new',       new CreateApplicationController());
register('/application/group/new', new CreateAppGroupController());

register('/rule/new',        new CreateRuleController());
register('/rule/update',     new UpdateRuleController());
register('/rule/throttling', new RuleThrottlingController());

register('/howto', new SecurityHowtoController());
?>
