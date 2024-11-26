/* radio img libbery */
function changeValue(o, img_name){
  document.getElementById('type').value=img_name;
  document.getElementById("myImg").src =o;
 }

function removeValue(o){
	document.getElementById('type').value=null;
	document.getElementById("myImg").src =o;
}

 function changeValueForGallery(o, img_name){ 

	var max_fields = 150;
	var wrapper = $(".container1"); 

	var x = 1;
	if (x < max_fields) {
		x++;
		$(wrapper).append('<div class="col-md-3 col-sm-12"><div class="mb-3 removeClass"><input type="hidden" name="gallery_img[]" value="'+img_name+'"><img src="'+o+'" width="100%" height="auto" class="border border-info"><a href="#" class="delete">Delete</a></div></div>'); //add input box
	} else {
		alert('You Reached the limits')
	} 	
}

$(wrapper).on("click", ".delete", function(e) {
	e.preventDefault();
	$(this).parent('.removeClass').remove();
	x--;
})

 //load more

$(document).ready(function(){
	$(".contentnew").slice(12, 20).show();
	$("#loadMoreID").on("click", function(e){
		e.preventDefault();
		$(".contentnew:hidden").slice(12, 20).slideDown();
		if($(".contentnew:hidden").length == 12) {
			$("#loadMoreID").text("No Content").addClass("noContent");
		}
	});

	//for gallery
	$(".contentnew2").slice(12, 20).show();
	$("#loadMoreID2").on("click", function(e){
		e.preventDefault();
		$(".contentnew2:hidden").slice(12, 20).slideDown();
		if($(".contentnew2:hidden").length == 12) {
		$("#loadMoreID2").text("No Content").addClass("noContent2");
		}
	});

})

// $(document).ready(function(){
// 	$(".contentnew2").slice(12, 20).show();
// 	$("#loadMoreID2").on("click", function(e){
// 		e.preventDefault();
// 		$(".contentnew2:hidden").slice(12, 20).slideDown();
// 		if($(".contentnew2:hidden").length == 0) {
// 		$("#loadMoreID2").text("No Content").addClass("noContent2");
// 		}
// 	});
// })
