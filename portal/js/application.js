function addNewRule(baseUrl) {
	var ruleType = document.getElementById("rule_type").value;
	var appId = document.getElementById("application_id").value;
	var group = document.getElementById("group_id");
	if (group) {
		groupId = group.value;
	}

	if (ruleType=='throttling') {
		url = baseUrl+'/rule/throttling?application_id='+appId;
		if (group) {
			url = url+'&group_id='+groupId;
		}
	}

	window.location.href = url;
}