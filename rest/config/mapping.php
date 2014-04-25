<?php
register('POST', '/enforce/:groupname', new GroupRuleHandler(), new GroupRuleValidator());
?>