function vote( id, vote ) {
	$.post( "vote.php?submissionId=" + id + "&vote=" + vote, {},
		function( data ) {
			if(data["status"] == "error") {
				alert("Failed to vote: " + data["reason"]);
			} else { // successfully voted :D
				$("#" + id + '-vote-count').text(data["count"]);
			}
		},
		"json"
	);
}