jQuery(document).ready(function() {	
		var todoListItem = jQuery('.todo-list');
		var todoListInput = jQuery('.todo-list-input');
 
		// create functionality
		jQuery('.todo-list-add-btn').on("click", function(event) {
			event.preventDefault();
			var action = 'create';
			var item = jQuery(this).prevAll('.todo-list-input').val();
			var bindHTML = '';
			jQuery.ajax({
		        type:'POST',
		        url:'action.php',
		        data:{action:action, item:item},
		        dataType:'json',                    
		        success: function (json) {
	            	if (item) {
						bindHTML+= '<li>';
							bindHTML+= '<div class="form-check">';
								bindHTML+= '<label class="form-check-label">';
									bindHTML+= '<input class="checkbox" type="checkbox" data-utaskid="'+json.task_id+'" />' + item;
									bindHTML+= '<i class="input-helper"></i>';
								bindHTML+= '</label>';
							bindHTML+= '</div>';
							bindHTML+= '<i data-dtaskid="'+json.task_id+'" class="remove fa fa-times"></i>';
						bindHTML+= '</li>';
						todoListItem.append(bindHTML);
						todoListInput.val("");
					}
	            },
		        error: function (xhr, ajaxOptions, thrownError) {
		            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		        }        
		    });
		});
 
		// update functionality
		todoListItem.on('change', '.checkbox', function() {
			var action = 'update';
			var task_id = jQuery(this).data('utaskid');
			if (jQuery(this).attr('checked')) {
				jQuery(this).removeAttr('checked');
				var status = 0;
			} else {
				jQuery(this).attr('checked', 'checked');
				var status = 1;
			}
			jQuery.ajax({
		        type:'POST',
		        url:'action.php',
		        data:{action:action, task_id:task_id, status:status},
		        dataType:'json',                    
		        success: function (json) {
		        	return true;
		        },
		        error: function (xhr, ajaxOptions, thrownError) {
		            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		        }        
	    	});
	    	jQuery(this).closest("li").toggleClass('completed');
		});
 
		// delete functionality
		todoListItem.on('click', '.remove', function() {
			var action = 'delete';
			var task_id = jQuery(this).data('dtaskid');
			jQuery.ajax({
		        type:'POST',
		        url:'action.php',
		        data:{action:action, task_id:task_id},
		        dataType:'json',                    
		        success: function (json) {
	            	return true;
	            },
		        error: function (xhr, ajaxOptions, thrownError) {
		            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		        }        
		    });
			jQuery(this).parent().remove();
		});
	});		