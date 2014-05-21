<?php
register('POST', '/enforce/:groupname', new GroupRuleHandler(),       new GroupRuleValidator());
register('POST', '/rule/token',         new TokenRuleCreateHandler(), new TokenRuleCreateValidator());
?>