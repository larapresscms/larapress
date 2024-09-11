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
  
  //tempage design-----------------------------------
  document.addEventListener('DOMContentLoaded', () => {
      const leftList = document.getElementById('lp-left-list');
      const rightList = document.getElementById('lp-right-list');
      const orderInput = document.getElementById('lp-orderInput');
  
      // Initialize SortableJS for both containers
      const sortableLeft = new Sortable(leftList, {
  
          group: {
              name: 'shared',
              pull: 'clone',  // Enables copying
              put: false      // Disable items being put back in the left list
          },
          animation: 150,
          sort: false,  
          
          
          // group: 'shared',
           animation: 150,
           ghostClass: 'ghost',
           onEnd: updateOrder,
           
      });
  
      const sortableRight = new Sortable(rightList, {
          group: 'shared',
          animation: 150,
          ghostClass: 'ghost',
  
          onAdd: function (evt) {
              // Add close button to new items
              const item = evt.item;
              addCloseButton(item);
              updateOrder();
          },
  
          onEnd: updateOrder
      });
  
      // Update the hidden input with the current order
      function updateOrder() {
          const order = [...rightList.querySelectorAll('.lp-item')].map(item => item.getAttribute('data-id'));
          orderInput.value = order.join(',');
      }
  
      // Add a close button to the item
      function addCloseButton(item) {
          const closeButton = document.createElement('button');
          closeButton.className = 'close-btn';
          closeButton.innerHTML = '&times;';
          closeButton.addEventListener('click', function() {
              item.remove();
              updateOrder();
          });
          item.appendChild(closeButton);
      }
  
      // Add close buttons to any existing items in the right list (if any)
      document.querySelectorAll('#lp-right-list .lp-item').forEach(addCloseButton);
  
      // Trigger updateOrder on form submission
      //document.getElementById('orderForm').addEventListener('submit', updateOrder);
  
      //for footer----------------------------------------------------------------
      const rightListfooter = document.getElementById('lp-right-list-footer');
      const orderInputfooter = document.getElementById('lp-orderInput-footer');
  
      const sortableRightfooter = new Sortable(rightListfooter, {
          group: 'shared',
          animation: 150,
          ghostClass: 'ghost',
  
          onAdd: function (evt) {
              // Add close button to new items
              const item = evt.item;
              addCloseButtonfooter(item);
              updateOrderfooter();
          },
  
          onEnd: updateOrderfooter
      });
  
      // Update the hidden input with the current order
      function updateOrderfooter() {
          const order2 = [...rightListfooter.querySelectorAll('.lp-item')].map(item => item.getAttribute('data-id'));
          orderInputfooter.value = order2.join(',');
      }
  
      // Add a close button to the item
      function addCloseButtonfooter(item) {
          const closeButton = document.createElement('button');
          closeButton.className = 'close-btn';
          closeButton.innerHTML = '&times;';
          closeButton.addEventListener('click', function() {
              item.remove();
              updateOrderfooter();
          });
          item.appendChild(closeButton);
      }
  
      // Add close buttons to any existing items in the right list (if any)
      document.querySelectorAll('#lp-right-list-footer .lp-item').forEach(addCloseButtonfooter);
  });