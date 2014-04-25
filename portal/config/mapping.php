<?php
register('/index', new SecurityHomeController());

register('/application/list',      new ApplicationListController());
register('/application/detail',    new ApplicationDetailController());
register('/application/group',     new GroupDetailController());
register('/application/new',       new CreateApplicationController());
register('/application/group/new', new CreateAppGroupController());

register('/rule/new',              new CreateRuleController());
register('/rule/update',           new UpdateRuleController());
register('/rule/throttling',       new RuleThrottlingController());
register('/rule/blacklist',        new RuleBlacklistController());
register('/rule/blacklist/add',    new RuleBlacklistAddController());
register('/rule/blacklist/remove', new RuleBlacklistRemoveController());
register('/rule/whitelist',        new RuleWhitelistController());
register('/rule/whitelist/add',    new RuleWhitelistAddController());
register('/rule/whitelist/remove', new RuleWhitelistRemoveController());

register('/howto', new SecurityHowtoController());
?>
