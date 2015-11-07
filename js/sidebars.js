jQuery(function(){
	jQuery('.esolutions_sidebars_block input[name=new_sidebar]').keypress(function(e){
		if(e==13){
			jQuery(this).parent().find('input.create_sidebar').click();
			return false;
		}
	});
	jQuery('.create_sidebar').click(function(){
		var data = {
			action: 'create_sidebar',
			new_sidebar: jQuery(this).parent().find("input[name=new_sidebar]").val(),
			esolutions_sidebars_create_sidebar: jQuery(this).parent().parent().find('#esolutions_sidebars_create_sidebar').val(),
		};
		
		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType:'json', 
			data:data, 
			beforeSend: function(){
				jQuery('.new_sidebar > img.loading').css("display","block");
			},
			success:function(response) {
				if(response){
					id_sidebar = "esolutions_sidebars"+response.ID;
					nombre_sidebar = response.post_title;
					jQuery('.inactives').append('<div id="' + id_sidebar + '">' + nombre_sidebar + '<a href="javascript:return false;" class="add"></a><a href="javascript:return false;" class="remove"></a><a href="javascript:return false;" class="up"><a href="javascript:return false;" class="down"></a></div>');
					jQuery('.new_sidebar > img.loading').css("display","none");
					jQuery('input[name=new_sidebar]').val("");
					esolutions_update_buttons();
				}else{
					alert("Error");
				}
			}
		});
		return false;
	});
	
	
	jQuery(".inactives,.actives").sortable({
		connectWith:".sidebars-sortable",
		scroll: false,
		tolerance: 'pointer',
		axis: 'y',
		stop: function(event,ui){
			esolutions_update();
		}
	});
	
	esolutions_update_buttons();
	
	jQuery(".btadd").click(function(){
		jQuery(this).parent().find("div.new_sidebar").toggle();
		if(jQuery(this).is(".activo")){
			jQuery(this).removeClass("activo");
		}else{
			jQuery(this).addClass("activo");
		}
		return false;
	})
})
function esolutions_update(){
	jQuery(".esolutions_sidebars_block").each(function(){
		var a = "";
		jQuery(this).find(".actives").children("div").each(function(){
			a += jQuery(this).attr("id")+",";
		})
		jQuery(this).find(".esolutions-sidebars").val(a);
	})
}
function esolutions_update_buttons(){
	jQuery(".actives .remove, .inactives .remove").click(function(){
		jQuery(this).parent().appendTo(jQuery(this).parent().parent().parent().find(".inactives.sidebars-sortable"));
		esolutions_update();
		return false;
	})
	jQuery(".actives .add, .inactives .add").click(function(){
		jQuery(this).parent().appendTo(jQuery(this).parent().parent().parent().find(".actives.sidebars-sortable"));
		esolutions_update();
		return false;
	})
	jQuery(".actives .down, .inactives .down").click(function(){
		jQuery(this).parent().insertAfter(jQuery(this).parent().next());
		esolutions_update();
		return false;
	})
	jQuery(".actives .up, .inactives .up").click(function(){
		jQuery(this).parent().insertBefore(jQuery(this).parent().prev());
		esolutions_update();
		return false;
	})
}
