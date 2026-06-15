/* radio img libbery */
let currentPreviewId = null;
$('#exampleModalCenter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    currentPreviewId = button.data('preview'); 

});

function changeValue(imageUrl, img_name) {
	//console.log(currentPreviewId);
    if(currentPreviewId){
		document.getElementById(currentPreviewId+'_type').value=img_name;
        document.getElementById(currentPreviewId).src = imageUrl;
        
    }
    $('#exampleModalCenter').modal('hide');
}

// function changeValue(o, img_name){
//   document.getElementById('type').value=img_name;
//   document.getElementById("myImg").src =o;
//  }

function removeValue(o, myImg){
	// document.getElementById('type').value=null;
	// document.getElementById("myImg").src =o;
	if(myImg){
		document.getElementById(myImg+'_type').value=null;
        document.getElementById(myImg).src = o;        
    }
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

//input tag-------------------------------
function initTagsInput(wrapper) {

    const input = wrapper.querySelector('.tags-input input');
    const hidden = wrapper.querySelector('input[type="hidden"]');
    const tagsBox = wrapper.querySelector('.tags-input');
    let tags = [];

    // ✅ LOAD EXISTING VALUES (IMPORTANT)
    if (hidden.value.trim() !== "") {
        tags = hidden.value.split(",").map(tag => tag.trim());
        tags.forEach(tag => addTag(tag));
    }

    input.addEventListener("keydown", function(e) {
        if (e.key === "Enter" || e.key === ",") {
            e.preventDefault();
            let value = input.value.trim();
            if (value !== "" && !tags.includes(value)) {
                tags.push(value);
                addTag(value);
                updateHidden();
            }
            input.value = "";
        }
    });

    function addTag(text) {
        const tag = document.createElement("div");
        tag.className = "tag";
        tag.innerHTML = text + "<span>&times;</span>";

        tag.querySelector("span").onclick = function() {
            tags = tags.filter(t => t !== text);
            tag.remove();
            updateHidden();
        };

        tagsBox.insertBefore(tag, input);
    }

    function updateHidden() {
        hidden.value = tags.join(",");
    }
}
function initAllTags() {
    document.querySelectorAll('.tags-input-wrapper').forEach(wrapper => {
        if (!wrapper.dataset.initialized) {
            initTagsInput(wrapper);
            wrapper.dataset.initialized = "true";
        }
    });
}
