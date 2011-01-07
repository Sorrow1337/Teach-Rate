//jQuery
$(document).ready(function(){
	//Used to store average rating
	var storeAR;

	//Hide Average
	$(".simpleRatings input").mouseover(function() {
		var simpleRatingsBox = $(this).parent().parent();
		$(simpleRatingsBox).find(".average").hide();
		//Show curent star rating
		var rNum = $(this).val();
		storeAR = $(simpleRatingsBox).find(".R").html();
		$(simpleRatingsBox).find(".R").html("("+rNum+")");
	});
	//Show Average
	$(".simpleRatings input").mouseout(function() {
		var simpleRatingsBox = $(this).parent().parent();
		$(simpleRatingsBox).find(".average").show();
		//Return original average rating
		$(simpleRatingsBox).find(".R").html(storeAR);
	});
	//Update selected rating to hidden input
	$(".simpleRatings input").click(function() {
		var simpleRatingsBox = $(this).parent().parent();
		$(simpleRatingsBox).find("input[name='ratedJS']").val($(this).val());
	});

	//Process Rating
	$(".simpleRatings form").submit(function(formSubmit) {
		//Disable form submit
		formSubmit.preventDefault();
		//Parent Tag
		var simpleRatingsBox = $(this).parent();
		//Get form data
		var rData = $(this).serialize();
		//Get rSubmit.php location
		var rURL = $(this).attr("action");

		//Loading...
		$(this).css("background","none");
		$(this).html("<div class='load'></div>");
		$(simpleRatingsBox).find(".text").html("<span class='loadText'>Loading...</span>");

		//Submit
		$.ajax({
			type: "POST", url: rURL, cache: false, data: rData,
			success: function(html){
				//Animate fade out
				$(simpleRatingsBox).fadeTo(250,0,function(){
					//Update html
					$(simpleRatingsBox).html(html);
					var avgRate = $(simpleRatingsBox).find(".average").width();
					$(simpleRatingsBox).find(".average").width(0);
					//Animate fade in (No Callback)
					$(simpleRatingsBox).fadeTo(1000,1);
					//Animate average rating
					$(simpleRatingsBox).find(".average").animate({width: avgRate}, 2300, function(){
						//Internet Explorer 8 Opacity Fix
						$(simpleRatingsBox).removeAttr("style");
					});//End Animate average rating
				});//End Animate fade out
			}//End success
		});//End Submit

	});//End Process Rating
});//End jQuery