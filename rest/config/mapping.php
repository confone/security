<?php
register('POST', '/enforce/:subject', new ThrottlingRuleHandler(), new ThrottlingRuleValidator());
?>