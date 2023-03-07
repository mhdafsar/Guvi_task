function profile(){
$(document).ready(function() {
	// Display the loading message
	$('#loading').show();
	
	// Make an AJAX request to load the profile information
	$.ajax({
		url: 'profile.json',
		dataType: 'json',
		success: function(data) {
			// Hide the loading message
			$('#loading').hide();
			
			// Display the profile information
			$('#profile-content').html(
				'<p>Name: ' + data.name + '</p>' +
				'<p>Age: ' + data.age + '</p>' +
				'<p>Location: ' + data.dob + '</p>' +
				'<p>Interests: ' + data.contact + '</p>' 
			);
		},
		error: function() {
			// Display an error message if the AJAX request fails
			$('#loading').html('Error loading profile information');
		}
	});
});
}