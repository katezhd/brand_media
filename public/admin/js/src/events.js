App.events = function() {

	$('body').on('change', '.edit-form :input:not(.select2):not(.ajax-select):not(.groupEditorItem)', function(e) {
		$('.edit-form').data("changed", true);
	});

	$('body').on('change', '.summernote-light', function(e) {
		$('.edit-form').data("changed", true);
	});

	$(window).on('beforeunload', function(e) {
		if (App.st.action == 'edit' || App.st.action == 'create') {
			if ($(".edit-form").data("changed") && App.user.scopes[App.st.cntrl].update) {
				let confirmationMessage = 'Вы не сохранили изменения.'
										+ 'Если вы не сохраните изменения, они могут быть потеряны.';
		
				(e || window.event).returnValue = confirmationMessage; //Gecko + IE
				return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
			}
		}
	});

    $('body').on('click', App.controls.listBtn, function(e) {
		e.preventDefault();

		if ($(".edit-form").data("changed") && App.user.scopes[App.st.cntrl].update) {
			var swal = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-outline-success mr-2',
					cancelButton: 'btn btn-outline-secondary'
				},
				buttonsStyling: false,
			})
	
			swal.fire({
				title: "Внимание!",
				text: "Остались несохраненные изменения.",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Сохранить и выйти",
				cancelButtonText: "Выйти",
				allowOutsideClick: false
			}).then(function(result) {
				console.log(result);
				if (result.value) {
					let form = $('.edit-form');
					if (form[0].checkValidity() === false) {
						form.addClass('was-validated');
					} else {
						var id = $('.save-btn').attr('data-id'),
						data = $(App.controls.editForm).serialize();
						$('.save-btn').addClass('disabled');
						$('.preview-btn').addClass('disabled');
						App.editElem(id, data, function() {
							$('.edit-form').data("changed", false);
							$('#content').find('.list-btn').first().click();
						});
					}
				} else {
					$('.edit-form').data("changed", false);
					$('#content').find('.list-btn').first().click();
				}
			})
		} else {
			var hash = $(this).attr('href') ? 
			$(this).attr('href') : 
			$(this).attr('data-route');
			location.hash = hash;
			App.route();
			App.st.search = $('.app-search input').val();
			if(App.st.cntrl.indexOf('constructor') > -1) {
				App.initConstructor();
			} else if(App.st.cntrl.indexOf('stat') > -1) {
				App.initStats();
			} else {
				App.initListView(App.st.page);
			}
			App.initActive();
		}
	});

	$('body').on('click', App.controls.addBtn, function(e){
		e.preventDefault();

		if ($(this).attr('data-param') && $(this).attr('data-value')) {
			let params = $(this).attr('data-param').split(',');
			let values = $(this).attr('data-value').split(',');
			App.tmp.create = {};
			$(params).each((index, param) => {
				if(param && values[index]) {
					App.tmp.create[param] = values[index];
				}
			}) 
		}

		location.hash = $(this).attr('data-route');
		App.route();

		App.initActive();
		App.initEditView();
	});

	$('body').on('click', App.controls.editBtn, function(e){
		e.preventDefault();

		var id    = $(this).attr('data-id');
		var cntrl = $(this).attr('data-cntrl');

		cntrl = cntrl ? cntrl : App.st.cntrl;

		location.hash = '#' + cntrl + '-edit-' + id;
		App.route();

		App.initActive();
		App.initEditView(id);
	});

	$('body').on('click', App.controls.publishBtn, function(e){
		e.preventDefault();

		var id    = $(this).attr('data-id');
		var status = $(this).attr('data-status');

		let data = `status=${status}&publishing=1`;

		App.editElem(id, data, App.initListView);
	})

	$('body').on('click', App.controls.cancelBtn, function(e){
		e.preventDefault();

		location.hash = $(this).attr('data-route');
		App.route();

		App.initActive();
		App.initEditView(App.st.id);
	});

	$('body').on('click', App.controls.viewBtn, function(e){
		e.preventDefault();

		var id = $(this).attr('data-id');
		location.hash = '#' + App.st.cntrl + '-view-' + id;
		App.route();

		App.initActive();
		App.initEditView(id, 'preview');
	});

	// $('body').on('click', App.controls.copyBtn, function(e){
	// 	e.preventDefault();

	// 	var id = $(this).attr('data-id');
	// 	App.copyElem(id);
	// });

	$('body').on('click', App.controls.saveBtn, function(e){
		e.preventDefault();

		let form = $('.edit-form');

		if (form[0].checkValidity() === false) {

			form.addClass('was-validated');
			
			setTimeout(() => {
				if (App.st.cntrl == 'news') {
					$('.customizer').addClass('show-service-panel');
				}
			}, 300);

		} else {
			if (App.st.cntrl == 'news') {
				idevEditor.editor.destroy();
				idevEditor.clean();
			}
			var id = $(this).attr('data-id'),
			data = $(App.controls.editForm).serialize();
			
			if(App.st.cntrl.indexOf('constructor') > -1) {
				App.editElem(id, data, App.initConstructor);
			} else {
				$('.save-btn').addClass('disabled');
				$('.preview-btn').addClass('disabled');
				App.editElem(id, data);
			}
		}
	});

	$('body').on('click', '.template-btn', function(e) {
		e.preventDefault();

		let id = $(this).data('id'),
			data = {
				st_cntrl: 'news',
				st_action: 'create',
			};
		
		App.st.templates.map(template => {
			if (template.id == id) {
				data.text = template.text;
			}
		})

		console.log(data);

		App.initCreateView(data);
	})

	$('body').on('click', '.preview-btn', function(e){
		e.preventDefault();

		var id = $(this).attr('data-id'),
			title = $('[name="name"]').val(),
			previewUrl = `${window.location.origin}/preview/${id}/${hashCode(id + title)}`;

		let type = $('#editor').attr('data-type')
		if (type) {
			previewUrl = `${window.location.origin}/${type}/${id}/${hashCode(id + title)}`;
		}

		if (App.st.action == 'view') {
			window.open(previewUrl, '_blank');
		} else {
			let form = $('.edit-form');
			if (form[0].checkValidity() === false) {
	
				form.addClass('was-validated');
	
			} else {
	
				idevEditor.editor.destroy();
				idevEditor.clean();
				
				var data = $(App.controls.editForm).serialize();
	
				$('.save-btn').addClass('disabled');
				$('.preview-btn').addClass('disabled');
	
				App.editElem(id, data, function() {
					$('.edit-form').data("changed", false);
					window.open(previewUrl, '_blank');
				});
			}
		}

	});

	$('body').on('click', '.plan-btn', function(e){
		e.preventDefault();

		let form = $('.edit-form');
		if (form[0].checkValidity() === false) {

			form.addClass('was-validated');

		} else {

			var id = $('[name="id"]').val(),
			data = $(App.controls.editForm).serialize();
			data += '&schedule=1';

			$('.plan-btn').addClass('disabled')
						  .attr('disabled', 'disabled');

			App.editElem(id, data);

		}
		
	});

	$('body').on('input', '[invalid]', function() {
		$(this).removeAttr('invalid');
		$(this).parent().removeClass('was-validated');
		this.setCustomValidity('');
	});

	$('body').on('change', 'select[invalid]', function() {
		$(this).removeAttr('invalid');
		$(this).parent().removeClass('was-validated');
		this.setCustomValidity('');
	});

	$('body').on('click', App.controls.deleteBtn, function(e){
		e.preventDefault();

		var id    = $(this).attr('data-id');
		var cntrl = $(this).attr('data-cntrl');
		var swal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-outline-danger mr-2',
                cancelButton: 'btn btn-outline-secondary'
            },
            buttonsStyling: false,
        })

		swal.fire({
			title: "Удалить запись?",
			text: "Вы не сможете восстановить запись!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Да, удалить!",
			cancelButtonText: "Нет, отменить"
		}).then(function(result) {
			if (result.value) {
				App.deleteElem(id, cntrl);
			}
		})
	});

	$('body').on('click', '.review-toggler', function(e) {
		e.preventDefault();
		var id     = $(this).attr('data-id'),
			data   = {};
		
		data[$(this).attr('data-toggle')] = true;
		App.updateReview(id, data);
	})

	$('body').on('click', App.controls.uploadImgBtn, function(e){
		e.preventDefault();
		$('[name="image_delete"]').val(null);
		$(App.controls.uploadImgInput).click();
	});

	$('body').on('click', '.variant-image-btn', function(e){
		e.preventDefault();
		$(this).parents('.variant')
			   .find('[name*="variantImageupload"]')
			   .click();
	});

	$('body').on('click', '.variant-image-delete-btn', function(e){
		e.preventDefault();
		
		let parent = $(this).parents('.variant');

		parent.find('.variantImage')
			  .find('img')
			  .attr('src', 'assets/images/holder-landscape.jpg');

		parent.find('[name*="base64"]').val('');
		parent.find('[name*="image_delete"]').val(1);
	});

	$('body').on('click', App.controls.deleteImgBtn, function(e){
		e.preventDefault();

		$('[name="image_delete"]').val(1);

		$(this).parents('.el-card-avatar')
				.find('img')
				.attr('src', 'assets/images/holder.jpg');

		$(App.controls.deleteImgBtn).hide();
		$('.image-popup').hide();
	});

	$('body').on('change', App.controls.uploadImgInput, function(e){
		e.preventDefault();

		if (this.files && this.files[0]) {
    
			var FR= new FileReader();
			
			FR.addEventListener("load", function(reader) {
				if ($(App.controls.uploadImg).length) {
					$(App.controls.uploadImg).val(reader.target.result);
					$(App.controls.uploadImgPreview).attr('src', reader.target.result);
				}
				if ($(App.controls.uploadImgs).length) {
					let images = $(App.controls.uploadImgs).val();
					images = images ? JSON.parse(images) : [];
					images = images.concat([reader.target.result]);
					images = JSON.stringify(images);
					
					$(App.controls.uploadImgs).val(images);
					
					let preview = renderMustache('var', App.st.cntrl + '.image', {image : reader.target.result});
					
					if (App.st.cntrl == 'problems') {
						$(App.controls.uploadImgBtn).parents('.col-md-4').before($(preview));
					} else {
						$(App.controls.uploadImgBtn).parents('.card.el-element-overlay').before($(preview));
					}
				}
			}); 
			
			FR.readAsDataURL(this.files[0]);
		}

	});

	$('body').on('change', '[name*="variantImageupload"]', function(e){
		e.preventDefault();

		if (this.files && this.files[0]) {
    
			var FR= new FileReader();
			
			FR.addEventListener("load", function(reader) {

				let src    = reader.target.result,
					parent = $(e.target).parents('.variant');

				parent.find('[name*="base64"]').val(reader.target.result);

				parent.find('.variantImage').find('img').attr('src', src);
				parent.find('.variant-image-delete-btn').fadeIn();
			}); 
			
			FR.readAsDataURL(this.files[0]);
		}

	});

	// $('body').on('click', App.controls.calendarBtn, function(e){
	// 	e.preventDefault();

	// 	let id = $(this).attr('data-id');
	// 	location.hash = '#' + App.st.cntrl + '-calendar-' + id;
	// 	App.route();

	// 	App.initActive();
	// 	App.initCalendarView(id);
	// });


	// $('body').on('change', '[name="place"]', function() {
	// 	let data = {
	// 		parking_id : $(this).attr('data-parking'),
	// 		place : $(this).val()
	// 	}
	// 	App.reloadCalendarData(data);
	// });

	$('body').on('click', '.fc-header-toolbar button', () => {
		$('[name="place"]:checked').trigger('change');
	})

	$('body').on('click', '#cities .dropdown-item', function(e) {
		e.preventDefault();

		let currentCity = $(this).text(),
			currentCityID = $(this).attr('data-id');

		localStorage.setItem('currentCity', currentCity);

		if (currentCityID) {
			localStorage.setItem('currentCityID', currentCityID);
		} else {
			localStorage.removeItem('currentCityID');
		}

		location.reload();
	})

	$('body').on('click', '.freeDraw-create', function(e) {
		e.preventDefault();
		App.initFreeDraw();
	});

	$('body').on('click', '.freeDraw-edit', function(e) {
		e.preventDefault();
		App.initFreeDraw();
	});

	$('body').on('click', '.freeDraw-save', function(e) {
		e.preventDefault();
		App.initFreeDraw();
	});

	$('body').on('click', '.freeDraw-delete', function(e) {
		e.preventDefault();
		App.deleteFreeDraw();
	});

	$('body').on('click', '.daterangepicker .applyBtn', function() {
		if ($('[name="custom-period"]').length) {
			let dates = $('[name="custom-period"]').val().split(' - ');
			App.st.dateFrom = moment(dates[0], HUMAN_DAY).format(HUMAN_DATE);
			App.st.dateTill = moment(dates[1], HUMAN_DAY).endOf('day').format(HUMAN_DATE);
			if(App.st.cntrl.indexOf('stats') > -1) {
				App.initStats();
			} else {
				App.initListView();
			}
		}
	})

	$('.app-search').on('submit', (e) => {
		e.preventDefault();

		App.st.search = $('.app-search input').val();

		if (App.st.action == 'list') {
			$('.list-btn[href="#' + App.st.cntrl + '"]').click();
		}
	})

	$('.srh-btn').on('click', () => {
		$('.app-search input').val('');

		if (App.st.search.length > 0) {
			App.st.search = '';
			if (App.st.action == 'list') {
				$('.list-btn[href="#' + App.st.cntrl + '"]').click();
			}
		}
	})

	$('body').on('click', '.ajax-collapse', (e) => {
		e.preventDefault();
		App.loadCollapseContent(e.currentTarget, $(e.currentTarget).attr('data-url'));
	})

	$('body').on('click', '.templates-collapse', (e) => {
		e.preventDefault();
		let el = e.currentTarget;
		if (App.st.templates.length) {
			renderMustache($(el).attr('href'), `${App.st.cntrl}.collapse`, {data : App.st.templates});
			$(el).hide().next().collapse();
		} else {
			App.loadCollapseContent(e.currentTarget, $(e.currentTarget).attr('data-url'));
		}
	})

	// $('body').on('input', '[name="icon"]', (e) => {
	// 	let svg = e.target.value;
	// 	$('#iconPreview').html(svg);
	// })

	// $('body').on('input', '[name="noimage"]', (e) => {
	// 	let svg = e.target.value;
	// 	$('#iconPreview_1').html(svg);
	// })

	// $('body').on('click', '.action-btn', (e) => {
	// 	let id = $(e.target).attr('data-id'),
	// 		action = $(e.target).attr('data-action');

	// 	// let images = $(App.controls.uploadImgs).val();
	// 	// 	images = images ? JSON.parse(images) : [];

	// 	let text = $('[name="' + action + '_text"]').val();
	// 	let name = App.user.firstname;
	// 	name += App.user.lastname ? ' ' + App.user.lastname : '';

	// 	var swal = Swal.mixin({
	// 		customClass: {
	// 			confirmButton: 'btn btn-outline-success mr-2',
	// 			cancelButton: 'btn btn-outline-secondary'
	// 		},
	// 		buttonsStyling: false,
	// 	})

	// 	swal.fire({
	// 		title: "Внимание!",
	// 		text: "Вы уверены, что хотите отправить это сообщение автору этого запроса? Процесс отправки необратим, поэтому внимательно проверьте данные перед отправкой.",
	// 		type: "warning",
	// 		showCancelButton: true,
	// 		confirmButtonText: "Отправить",
	// 		cancelButtonText: "Отменить",
	// 		allowOutsideClick: false
	// 	}).then(function(result) {
	// 		if (result.value) {
	// 			App.createReview({
	// 				'appeal_id' : id,
	// 				'name'      : name,
	// 				'text'      : text,
	// 				'action'    : action,
	// 				'images'   : images
	// 			});
	// 		}
	// 	})
	// })

	// $('body').on('input', '[name="started_text"],[name="finished_text"],[name="refused_text"],[name="created_text"]', (e) => {
	// 	let el = $(e.target);
	// 	if (el.val().length > 5) {
	// 		el.parents('.card-body').find('.action-btn').removeAttr('disabled');
	// 	} else {
	// 		el.parents('.card-body').find('.action-btn').attr('disabled', 'disabled')
	// 	}
	// })

	// $('body').on('change', '[name="respond_text"]', (e) => {
	// 	$(e.target).parents('.card-body').find('.action-btn').removeAttr('disabled');
	// })

	// $('body').on('change', '.event-repeater input[name="is_repeated"]', (e) => {
	// 	if ($('.event-repeater input[name="is_repeated"]:checked').val() == '1') {
	// 		$('.event-repeater .durations').children().removeAttr('disabled');
	// 		$('.event-repeater .durations [data-value="1"]').focus()
	// 	} else {
	// 		$('.event-repeater .durations').children().attr('disabled', 'disabled');
	// 	}
	// })

	// $('body').on('click', '.durations .btn', (e) => {
	// 	$('.durations [name="duration"]').val($(e.target).attr('data-value'));
	// 	$('.durations [name="customDuration"]').val('');
	// })

	$('body').on('input', '[name="customDuration"]', (e) => {
		let val = $(e.target).val();
		if (val < 1) {
			val = 1;
			$('.durations [name="customDuration"]').val(val);
		}
		if (val > 12) {
			val = 12;
			$('.durations [name="customDuration"]').val(val);
		}
		$('.durations [name="duration"]').val(val);
	})

	$('body').on('change paste', '[name="video_link"]', (e) => {
		let url = $(e.target).val();
		let id = getYoutubeID(url);
		$('[name="video_code"]').val(id);
		$(e.target).next('iframe').removeClass('hidden');
		$(e.target).next('iframe').attr('src', `https://www.youtube.com/embed/${id}`);
	} )
	$('body').on('change', '[name^="videos"]', function(e) {
		let value = $(this).val();

		if (value.length) {
			let url   = new URL(value);
	
			console.log(url);
	
			if (url.host == 'youtu.be') {
				url.host = 'www.youtube.com';
				url.pathname = '/embed' + url.pathname;
			}

			let searchParams = url.searchParams;
			let start = searchParams.get('start');
			start = start ? start : searchParams.get('t')

			if (url.pathname == '/watch') {
				url.pathname = '/embed/' + searchParams.get('v');
				url.search = '';
			}

			if (start) {
				url.search = '?start=' + start;
			}

			$(this).val(url.href);
		}

	});

	$('body').on('click', '.unpublish-btn', function(e) {
		e.preventDefault();

		$('[name="is_published"]').val(0);
		$(App.controls.saveBtn).first().click();
	})

	$('body').on('select2:select', '.collapse-select', (e) => {
		let target = $('.collapse-select').select2().find(":selected").data("target");
		$('.collapse').on('shown.bs.collapse', () => {
			if (target == 'categories' || target == 'quote') {
				App.loadAjaxSelect(`#${target} .ajax-select`);
			} else {
				$(`#${target} .select2:not(.ajax-select)`).select2();
			}
		});
		$('.collapse').each((k, el) => {
			let id = $(el).attr('id');
			if(id == target) {
				$(el).collapse('show');
			} else {
				$(el).collapse('hide');
			}
		});
	})

	$('body').on('click', '.create-btn', (e) => {
		console.log($(e.target).attr('data-id'));

		let data = `imported_at=NULL&type=${$(e.target).attr('data-type')}`;

		let callback = () => {
			App.initListView();
		}
		
		App.editElem($(e.target).attr('data-id'), data, callback);
	})
}