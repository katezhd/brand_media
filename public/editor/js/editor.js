var idevEditor = {

	controls : {
		loader: $('.loader'),
		item: '.editor__item',
		headerItem: '.longread-header',
		gallery: '.article__images',
		galleryItem: '.article__image',
		youtubeItem: '.article__video-wrap',
		save: '.idevEditorEdit',
		publish: '.idevEditorPublish',
		preview: '.idevEditorPreview',
		issue: '.idevEditorIssue',
		itemAdd: '.library-col:not(.disabled)',
		itemHtml: '.library-html',
		editorAdd: '.editor__add',
		editorCopy: '.editor__copy',
		editorDelete: '.editor__delete',
		editorHide: '.editor__hide',
		editorMoveUp: '.editor__move--up',
		editorMoveDown: '.editor__move--down',
		imageUpload: '.fileupload',
		imageScale: '.editorImageScale',
		imageContainer: '.editorImageContainer',
		imageDelete: '.editorImageDelete',
		coverUpload: '.coverupload',
		youtubeElPreview: '.article__video-wrap'
	},

	youtube : Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-outline-success',
			cancelButton: 'btn btn-outline-secondary mr-2'
		},
		buttonsStyling: false,
	}),

	service : Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-outline-success',
			cancelButton: 'btn btn-outline-secondary mr-2'
		},
		buttonsStyling: false,
	}),

	editor : null,
	target : null,

	popover: null,

	canvas: null,

	tools : `<div class="editor__actions btn-group" role="group">
				<button type="button" class="editor__add btn btn-lg btn-success" data-toggle="modal" data-target="#libraryModal" title="Добавить после" data-toggle="collapse" data-target="#library" aria-expanded="false" aria-controls="library"><i class="ti-plus"></i></button>
				<button type="button" class="editor__copy btn btn-lg btn-info" title="Копировать"><i class="ti-layers"></i></button>
				<button type="button" class="editor__delete btn btn-lg btn-danger" title="Удалить" style="display:none"><i class="ti-trash"></i></button>
				<button type="button" class="editor__hide btn btn-lg btn-warning" title="Скрыть"><i class="ti-power-off"></i></button>
				<button type="button" class="editor__move--up btn btn-lg btn-light" title="Переместить вверх"><i class="ti-angle-double-up"></i></button>
				<button type="button" class="editor__move--down btn btn-lg btn-light" title="Переместить вниз"><i class="ti-angle-double-down"></i></button>
			</div>`,

	imageTools: `<div class="editor__uploads">
					<input class="fileupload" name="imageupload" type="file">
					<div class="btn-group" role="group">
						<button type="button" class="editorImageUpload btn btn-lg btn-success" title="Загрузить картинку"><i class="ti-image"></i></button>
						<button type="button" class="editorImageScale btn btn-lg btn-info" title="Изменить размер картинки"><i class="ti-fullscreen"></i></button>
					</div>
				</div>`,

	containerTools: `<div class="editor__container">
				<div class="btn-group" role="group">
					<button type="button" class="editorImageContainer btn btn-lg btn-primary" title="Изменить размер контейнера"><i class="ti-layout-slider"></i></button>
				</div>
			</div>`,

	progress: `<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
				<span class="sr-only">0% Complete</span>
			</div>
		</div>`,

	coverTools: `<div class="editor__uploads">
					<input type="file" name="coverupload" class="coverupload">
					<div class="btn-group" role="group">
						<button type="button" class="editorImageUpload btn btn-lg btn-success" title="Загрузить картинку"><i class="ti-image"></i></button>
						<button type="button" class="editorImageDelete btn btn-lg btn-danger" title="Удалить картинку"><i class="ti-trash"></i></button>
					</div>
				</div>`,

	coverPreviewTools: `<div class="editor__previews" style="display:none;">
				<div class="btn-group" role="group">
					<button type="button" class="coverPreview btn btn-light" data-layout="clear" style="display:none;" title="Скрыть"><i class="ti-close"></i></button>
				</div>
				&nbsp;
				<div class="btn-group" role="group">
					<button type="button" class="coverPreview btn btn-light" data-layout="full" title="Шапка новости"><i class="ti-layout-width-full"></i></button>
					<button type="button" class="coverPreview btn btn-light" data-layout="column" title="Новость в списке"><i class="ti-layout-grid2"></i></button>
					<button type="button" class="coverPreview btn btn-light" data-layout="video" title="Видео новость"><i class="ti-video-clapper"></i></button>
					<button type="button" class="coverPreview btn btn-light" data-layout="facebook" title="Пост Facebook"><i class="ti-facebook"></i></button>
				</div>
			</div>`,
	
	youtubeTools: `<div class="editor__service editor__youtube">
				<input class="fileupload" name="imageupload" type="file">
	            <div class="btn-group" role="group">
					<button type="button" class="editorYoutube btn btn-lg btn-success" title="Добавить видео"><i class="ti-youtube"></i></button>
					<button type="button" class="editorYoutubeImageUpload btn btn-lg btn-primary" title="Загрузить картинку"><i class="ti-image"></i></button>
				</div>
			</div>`,

	facebookTools: `<div class="editor__service editor__facebook">
			<div class="btn-group" role="group">
				<button type="button" class="editorFacebook btn btn-lg btn-success" title="Добавить пост Facebook"><i class="ti-facebook"></i></button>
			</div>
		</div>`,

	twitterTools: `<div class="editor__service editor__twitter">
		<div class="btn-group" role="group">
			<button type="button" class="editorTwitter btn btn-lg btn-success" title="Добавить пост Twitter"><i class="ti-twitter-alt"></i></button>
		</div>
	</div>`,

	instagramTools: `<div class="editor__service editor__instagram">
		<div class="btn-group" role="group">
			<button type="button" class="editorInstagram btn btn-lg btn-success" title="Добавить пост Instagram"><i class="ti-instagram"></i></button>
		</div>
	</div>`,

	embedTools: `<div class="editor__service editor__embed">
		<div class="btn-group" role="group">
			<button type="button" class="editorEmbed btn btn-lg btn-success" title="Добавить код HTML"><i class="ti-html5"></i></button>
		</div>
	</div>`,
	
	uploadImage: function() {
		let url = '/api/v1/news/image';	

		$(idevEditor.controls.imageUpload)
		.fileupload({
			url: url,
			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
			dataType: 'json',
			formData: {},
			done: function (e, data) {
				console.log(data.result);
				if(data.result.status == 'ok' && data.result.image) {
					idevEditor.makeImageThumb(data.result);	
					idevEditor.clean();
					toastr.success('Изображение загружено', '', App.toastr.options);
				} else {
					toastr.error('Ошибка при загрузке изображения', '', App.toastr.options);
				}	
			},
			start : function () {},
			always : function () {},
			progress: function (e, data) {
				let progress = parseInt(data.loaded / data.total * 100, 10);
				idevEditor.makeProgress(progress);
			}
		})
	},

	makeImageThumb: function(file) {
		let timestamp = new Date(),
			path  = `/storage/news/${file.image}?${timestamp.getTime()}`,
			style = `background-image: url(${path})`;

		$(idevEditor.target).attr('style', style);

		if (!$(idevEditor.target).hasClass(idevEditor.controls.youtubeElPreview)) {
			$(idevEditor.target).attr('data-image', file.image);
			$(idevEditor.target).attr('rel', 'gallery');
			$(idevEditor.target).attr('data-src', path);
			$(idevEditor.target).attr('data-caption', '');
			$(idevEditor.target).addClass('lazy-image');
		}

		$('.edit-form').data("changed", true);
	},

	makeProgress: function(value) {
		$(idevEditor.target).find('.progress-bar')
			.attr('aria-valuenow', value)
			.attr('style','width: ' + value + '%;')
			.find('.sr-only')
			.text(value + '% Complete');

		if (value == 100) {
			setTimeout(function(){
				idevEditor.makeProgress(0);
			}, 1000);
		}

	},

	pasteYoutube: function(html) {
	
		idevEditor.youtube.fire({
			title: 'Добавить видео',
			input: 'url',
			inputPlaceholder: 'Ссылка на видео',
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (value) => {
				let youtubeID = getYoutubeID(value);
				
				return fetch(`/api/v1/news/youtube`, {
					method: 'POST',
					headers: Object.assign({'Content-Type'  : 'application/json'}, App.user.headers()),
					body: JSON.stringify({
						"youtube_id" : youtubeID
					})
				})
				.then(response => {
					return response.json();
				})
				.then(response => {
					
					if (html) {
						$(idevEditor.target).after(html);
						idevEditor.target = idevEditor.target.next();
					}

					let wrap = $(idevEditor.target).find('.article__video-wrap');

					wrap.attr('data-id', youtubeID);
					wrap.attr('style', 'background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.3))');

					if (response.status == 'ok' && response.image) {
						let path = `/storage/youtube/${response.image}`;
						wrap.attr('style', `background-image: url(${path})`);
						wrap.attr('data-src', path);
						wrap.addClass('lazy-image');
						toastr.success('Видео загружено', '', App.toastr.options);
					}

					if (response.status == 'error') {
						toastr.success('Видео загружено, но не найдена картинка видео на Youtube', '', App.toastr.options);
					}
	
					$(idevEditor.target).find('.play-btn').fadeIn().attr('disabled', false);

					if (html) {
						let scrollTo = idevEditor.target.offset().top;
						idevEditor.scrollTop(scrollTo);
					}

					idevEditor.init();
					idevEditor.clean();
	
					return response;
				})
				.catch(error => {
					console.log(error);
					Swal.showValidationMessage(error);
					return false;
				});
			}
		})
	},

	pasteYoutubePlaceholder: function(html) {
		$(idevEditor.target).after(html);
		idevEditor.target = idevEditor.target.next();

		$(idevEditor.target).find('.play-btn').fadeIn().attr('disabled', true);

		let scrollTo = idevEditor.target.offset().top;
		idevEditor.scrollTop(scrollTo);

		idevEditor.init();
		idevEditor.clean();
	},

	pasteFacebook: function(html) {
	
		idevEditor.service.fire({
			title: 'Добавить пост Facebook',
			input: 'textarea',
			inputPlaceholder: 'Код вставки',
			inputValidator: (value) => {
				return new Promise((resolve) => {
					let isFacebook = value.includes(`<iframe src="https://www.facebook.com/plugins/post.php?`);
					isFacebook = isFacebook ? isFacebook : value.includes(`<iframe src="https://www.facebook.com/plugins/video.php?`)
					if (isFacebook) {
						resolve()
					} else {
						resolve('Некоректный код вставки поста Facebook')
					}
				})
			},
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (html) => {
				console.log(html);

				let isFacebookPost = html.includes(`<iframe src="https://www.facebook.com/plugins/post.php?`),
					isFacebookVideo = html.includes(`<iframe src="https://www.facebook.com/plugins/video.php?`);

				if (isFacebookPost) {
					html = html.replace('style="border:none;', 'style="max-width:100%;border:none;');
				}
				
				if (isFacebookVideo) {
					html = html.replace('style="border:none;', 'style="left:0;top:0;height:100%;width:100%;position:absolute;border:none;');
					html = `
						<div style="overflow:hidden;padding-bottom:56.25%;position:relative;height:0;">
							${html}
						</div>`;
				}

				$(idevEditor.target).after(`
					<div class="editor__item">
						<div class="article__container article__container--center">
							${html}
						</div>
					</div>`);
				idevEditor.target = idevEditor.target.next();

				if (html) {
					let scrollTo = idevEditor.target.offset().top;
					idevEditor.scrollTop(scrollTo);
				}

				idevEditor.clean();
				idevEditor.init();
			}
		})
	},

	pasteInstagram: function(html) {
	
		idevEditor.service.fire({
			title: 'Добавить пост Instagram',
			input: 'textarea',
			inputPlaceholder: 'Код вставки',
			inputValidator: (value) => {
				return new Promise((resolve) => {
					let isInstagram = value.includes(`<blockquote class="instagram-media"`);
					if (isInstagram) {
						resolve()
					} else {
						resolve('Некоректный код вставки поста Instagram')
					}
				})
			},
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (html) => {
				html = html.replace('<script async src="//www.instagram.com/embed.js"></script>','');

				$(idevEditor.target).after(`
					<div class="editor__item">
						<div class="article__container article__container--center" data-scripts="//www.instagram.com/embed.js">
							${html}
						</div>
					</div>`);
				idevEditor.target = idevEditor.target.next();

				if (html) {
					let scrollTo = idevEditor.target.offset().top;
					idevEditor.scrollTop(scrollTo);
				}

				idevEditor.clean();
				idevEditor.init();
			}
		})
	},

	pasteTwitter: function(html) {
	
		idevEditor.service.fire({
			title: 'Добавить пост Twitter',
			input: 'textarea',
			inputPlaceholder: 'Код вставки',
			inputValidator: (value) => {
				return new Promise((resolve) => {
					let isTwitter = value.includes(`<blockquote class="twitter-tweet">`);
					if (isTwitter) {
						resolve()
					} else {
						resolve('Некоректный код вставки поста Twitter')
					}
				})
			},
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (html) => {
				html = html.replace('<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>','');

				$(idevEditor.target).after(`
					<div class="editor__item">
						<div class="article__container article__container--center" data-scripts="https://platform.twitter.com/widgets.js">
							${html}
						</div>
					</div>`);
				idevEditor.target = idevEditor.target.next();

				if (html) {
					let scrollTo = idevEditor.target.offset().top;
					idevEditor.scrollTop(scrollTo);
				}

				idevEditor.clean();
				idevEditor.init();
			}
		})
	},

	pasteTiktok: function(html) {
	
		idevEditor.service.fire({
			title: 'Добавить пост Tiktok',
			input: 'textarea',
			inputPlaceholder: 'Код вставки',
			inputValidator: (value) => {
				return new Promise((resolve) => {
					let isTiktok = value.includes(`<blockquote class="tiktok-embed`);
					if (isTiktok) {
						resolve()
					} else {
						resolve('Некоректный код вставки поста Tiktok')
					}
				})
			},
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (html) => {
				html = html.replace('<script async src="https://www.tiktok.com/embed.js"></script>','');

				$(idevEditor.target).after(`
					<div class="editor__item">
						<div class="article__container article__container--center" data-scripts="https://www.tiktok.com/embed.js">
							${html}
						</div>
					</div>`);
				idevEditor.target = idevEditor.target.next();

				if (html) {
					let scrollTo = idevEditor.target.offset().top;
					idevEditor.scrollTop(scrollTo);
				}

				idevEditor.clean();
				idevEditor.init();
			}
		})
	},

	pasteEmbed: function(html) {
	
		idevEditor.service.fire({
			title: 'Добавить HTML-код',
			input: 'textarea',
			inputPlaceholder: 'Код вставки',
			inputValidator: () => {
				return new Promise((resolve) => {
					resolve()
				})
			},
			showCancelButton: true,
			reverseButtons: true,
			showCancelButton: true,
			confirmButtonText: "Добавить",
			cancelButtonText: "Отменить",
			allowOutsideClick: false,
			showLoaderOnConfirm: true,
			preConfirm: (html) => {
				let isInstagram = html.includes(`<blockquote class="instagram-media"`);

				if (isInstagram) {
					html = html.replace('<script async src="//www.instagram.com/embed.js"></script>','');
	
					$(idevEditor.target).after(`
						<div class="editor__item">
							<div class="article__container article__container--center" data-scripts="//www.instagram.com/embed.js">
								${html}
							</div>
						</div>`);
				}

				let isTwitter = html.includes(`<blockquote class="twitter-tweet">`);
				if (isTwitter) {
					html = html.replace('<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>','');

					$(idevEditor.target).after(`
						<div class="editor__item">
							<div class="article__container article__container--center" data-scripts="https://platform.twitter.com/widgets.js">
								${html}
							</div>
						</div>`);
				}

				let isTiktok = html.includes(`<blockquote class="tiktok-embed`);
				if (isTiktok) {
					html = html.replace('<script async src="https://www.tiktok.com/embed.js"></script>','');

					$(idevEditor.target).after(`
						<div class="editor__item">
							<div class="article__container article__container--center" data-scripts="https://www.tiktok.com/embed.js">
								${html}
							</div>
						</div>`);
				}

				if (!isInstagram && !isTwitter && !isTiktok) {
					let script = html.match(/<script[\s\S]*?src="(.*?)"[\s\S]*?>[\s\S]*?<\/script>/i);
					let scriptSrc = null;

					console.log(script);
					if (script && script.length == 2) {
						
						scriptSrc = script[1];
						script 	  = script[0];

						html = html.replace(script,'');

						if (scriptSrc) {
							html = `<div class="article__container article__container--center" data-scripts="${scriptSrc}">
							 			${html}
							 		</div>`;
						} else {
							html = `<div class="article__container article__container--center">
							 			${html}
							 		</div>`;
						}
					} 

					$(idevEditor.target).after(`
						<div class="editor__item">
							${html}
						</div>`);

				}
				
				idevEditor.target = idevEditor.target.next();

				if (html) {
					let scrollTo = idevEditor.target.offset().top;
					idevEditor.scrollTop(scrollTo);
				}

				idevEditor.clean();
				idevEditor.init();
			}
		})
	},

	scrollTop(value) {
		$('html, body').animate({
        	scrollTop: value
    	}, 800);
	},

	init () {
		$('#editor').find(idevEditor.controls.item).each(function(index, item){
			if (index) {
				let tools = idevEditor.tools;
				if (index > 1) {
					tools = idevEditor.tools.replace('style="display:none"', '');
				}
				$(item).prepend(tools);

				if ($(item).height() > $(window).height() * 0.75) {
					$(item).prepend(tools);
				}
			}
		});

		if (!$('#editor').attr('data-type')) {
			$('#editor').find(idevEditor.controls.galleryItem).each(function(index, item){
				$(item).append(idevEditor.imageTools);
				$(item).append(idevEditor.progress);
			});
	
			$('#editor').find(idevEditor.controls.gallery).each(function(index, item){
				$(item).parent().append(idevEditor.containerTools);
			});
	
			$('#editor').find(idevEditor.controls.youtubeItem).each(function(index, item){
				$(item).append(idevEditor.youtubeTools);
				$(item).append(idevEditor.progress);
			});
	
			$('#editor').find(idevEditor.controls.headerItem).each(function(index, item){
				$(item).after(idevEditor.coverPreviewTools);
				$(item).after(idevEditor.coverTools);
	
				if ($('[data-image]').length) {
					$('.editor__previews').show();
				}
	
			});
		}


		if (idevEditor.editor) {
			idevEditor.editor.destroy();
			idevEditor.editor = null;
		}

		let toolbarOpts = {
			allowMultiParagraphSelection: true,
			buttons: [
				'bold', 
				'italic', 
				'underline', 
				'anchor', 
				'justifyLeft', 
				'justifyCenter', 
				'justifyRight', 
				'removeFormat'
			],
			diffLeft: 0,
			diffTop: -10,
			buttonClass: 'btn btn-dark',
			relativeContainer: null,
			standardizeSelectionStart: false,
			static: false,
			align: 'center',
			sticky: false,
			updateOnEmptySelection: false
		};

		idevEditor.editor = new MediumEditor('.editable', {
			imageDragging: false,
			buttonLabels: 'fontawesome',
			toolbar: toolbarOpts,
			paste: {
				forcePlainText: true,
				cleanPastedHTML: false,
				cleanReplacements: [],
				cleanAttrs: ['class', 'style', 'dir'],
				cleanTags: ['meta'],
				unwrapTags: []
			},
			placeholder: {
    		    text: 'Начните вводить текст',
    		    hideOnClick: false
    		}
		});

		idevEditor.editor.subscribe('editableInput', function(event, data) {
			idevEditor.clean()
			if ($('.article__title').text().length) {
				$('.article__title').removeClass('error');
			}
		})

		if (!$('#editor').attr('data-type')) {
			setTimeout(function() {
				idevEditor.uploadImage();
			}, 1000);
		} else {
			idevEditor.clean();
			$('.edit-form').data("changed", false);
		}

	},

	drawCanvas(layout) {

		if (!idevEditor.canvas) {
			idevEditor.canvas = document.createElement("canvas");
			idevEditor.canvas.id = 'canvas';
		}

		$('[data-layout="clear"]').show();

		idevEditor.canvas.height = $('#editorCover').height();
		idevEditor.canvas.width = $('#editorCover').width();

		console.log(`Размеры канваса: ${idevEditor.canvas.width}x${idevEditor.canvas.height}`);

		let size = { w: 1200, h: 630 }, // facebook 
			newSize = { w: 0, h: 0 };

		if (layout == 'full') {
			size = {
				w: $('#editorCover').width(), 
				h: $(window).height() * 0.7
			};
		}

		if (layout == 'column') {
			size = {
				w: 490, 
				h: 343
			};
		}

		if (layout == 'video') {
			size = {
				w: 250, 
				h: 210
			};
		}

		console.log(`Исходное превью: ${size.w}x${size.h}`);

		if (size.w >= idevEditor.canvas.width) {
			newSize.w = idevEditor.canvas.width;
			newSize.h = idevEditor.canvas.width/size.w * size.h;

			if (newSize.h > idevEditor.canvas.height) {
				newSize.h = idevEditor.canvas.height;
				newSize.w = idevEditor.canvas.height/size.h * size.w;
			}

		} else {
			newSize.h = idevEditor.canvas.height;
			newSize.w = idevEditor.canvas.height/size.h * size.w;

			if (newSize.w > idevEditor.canvas.width) {
				newSize.w = idevEditor.canvas.width;
				newSize.h = idevEditor.canvas.width/size.w * size.h;
			}
		}


		if (newSize.h > idevEditor.canvas.height) {
			newSize.h = idevEditor.canvas.height;
			newSize.w = idevEditor.canvas.height/newSize.h * newSize.w;
		}

		console.log(`Масштабированное превью: ${newSize.w}x${newSize.h}`);

		$('#editorCover').html(idevEditor.canvas);

		let ctx = idevEditor.canvas.getContext("2d");

		ctx.clearRect(0,0,idevEditor.canvas.width,idevEditor.canvas.height);

		ctx.fillStyle = 'rgba(255,0,0, 0.5)'
		ctx.fillRect(0, 0, idevEditor.canvas.width/2 - newSize.w/2, newSize.h)
		ctx.fillRect(0, 0, newSize.w, idevEditor.canvas.height/2 - newSize.h/2)
		ctx.fillRect(idevEditor.canvas.width - (idevEditor.canvas.width/2 - newSize.w/2), 0, idevEditor.canvas.width/2 - newSize.w/2, newSize.h)
		ctx.fillRect(0, idevEditor.canvas.height - (idevEditor.canvas.height/2 - newSize.h/2), newSize.w, idevEditor.canvas.height/2 - newSize.h/2)
	},

	cleanCanvas() {
		if (idevEditor.canvas) {
			let ctx = idevEditor.canvas.getContext("2d");
			ctx.clearRect(0,0,idevEditor.canvas.width,idevEditor.canvas.height);
			$('[data-layout="clear"]').hide();
		}
	},

	reload() {
		idevEditor.destroy();
		idevEditor.init();
	},

	clean() {

		console.log('creaned');

		$('.article__image-name').each((index, item) => {
			$(item).prev('.article__image')
			.attr('data-caption', $(item).text());
		})

		let cleaner = $('<div>');
		cleaner.html($('#editor').html().trim());
		cleaner.find('.editor__item').first().remove();
		cleaner.find('.editor__actions').remove();
		cleaner.find('.editor__uploads').remove();
		cleaner.find('.editor__previews').remove();
		cleaner.find('.editor__container').remove();
		cleaner.find('.editor__service').remove();
		cleaner.find('.editor__youtubeIframe').remove();
		cleaner.find('.progress').remove();

		$('.edit-form').data("changed", true);
		$('[name="text"]').val(cleaner.html().trim().replace('<p><br></p>', ''));
		cleaner.remove();

	},

	destroy () {
		$('.editor__actions').each(function(index, item){
			$(item).remove();
		});
		$('.editor__uploads').each(function(index, item){
			$(item).remove();
		});
		$('.editor__previews').each(function(index, item){
			$(item).remove();
		});
		$('.progress').each(function(index, item){
			$(item).remove();
		});
		$('.editor__container').each(function(index, item){
			$(item).remove();
		});
		$('.editor__service').each(function(index, item){
			$(item).remove();
		});
		$('.editor__youtubeIframe').each(function(index, item){
			$(item).remove();
		});
		idevEditor.editor.destroy();
	}
};

$('body').on('click', idevEditor.controls.editorAdd, function(e){
	idevEditor.target = $(this).parents(idevEditor.controls.item);
});

$('body').on('click', idevEditor.controls.editorDelete, function(e) {
	e.preventDefault();
	let target = $(this).parents(idevEditor.controls.item);
	
	if (target.find('.article__image').length > 0) {
		target.find('.article__image').each((index, image) => {
				$.ajax({
					url: '/api/v1/news/image',
					data: {
						image: $(image).attr('data-image')
					},
					type: 'DELETE',
					xhrFields: {
						withCredentials: true
					},
					headers: App.user.headers()
				})
				.always(function() {
					if ((index + 1) == target.find('.article__image').length) {
						target.hide(400, function() {
							target.remove()
							idevEditor.clean()
							idevEditor.reload()
						});
					}
				});
		})
	} else {
		target.hide(400, function() {
			target.remove()
			idevEditor.clean()
			idevEditor.reload()
		});
	}
});

$('body').on('click', idevEditor.controls.editorHide, function(e) {
	e.preventDefault();
	let target = $(this).parents(idevEditor.controls.item);
		target.toggleClass('disabled')
		idevEditor.clean()
		idevEditor.reload()
});

$('body').on('click', idevEditor.controls.editorCopy, function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parents(idevEditor.controls.item);

	let currentHtml = idevEditor.target.clone().wrap('<p>').parent().html();
	idevEditor.target.after(currentHtml);
	idevEditor.scrollTop(idevEditor.target.offset().top + idevEditor.target.height());
	idevEditor.clean()
	idevEditor.reload()
});

$('body').on('click', idevEditor.controls.editorMoveDown, function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parents(idevEditor.controls.item);
	let currentHtml = idevEditor.target.clone().wrap('<p>').parent().html();
	let nextItem = idevEditor.target.next();
	if (nextItem.length) {
		idevEditor.target.fadeOut(function(){
			idevEditor.target.remove();
			nextItem.after(currentHtml);
			idevEditor.scrollTop(nextItem.offset().top + nextItem.height());
		});
	}
	setTimeout(() => {
		idevEditor.clean()
		idevEditor.reload()
	}, 500)
});

$('body').on('click', idevEditor.controls.editorMoveUp, function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parents(idevEditor.controls.item);
	let currentHtml = idevEditor.target.clone().wrap('<p>').parent().html();
	let prevItem = idevEditor.target.prev(idevEditor.controls.item);
	if (prevItem.length) {
		idevEditor.target.fadeOut(function(){
			prevItem.before(currentHtml);
			idevEditor.scrollTop(prevItem.prev().offset().top);
			idevEditor.target.remove();
		});
	}
	setTimeout(() => {
		idevEditor.clean()
		idevEditor.reload()
	}, 500)
});

$('body').on('click', idevEditor.controls.itemAdd, function(e) {
	e.preventDefault();
	
	idevEditor.destroy();

	let item = idevEditor.target;
		html = $(this).find('.library-html').html();
		html = `<div class="editor__item">${html}</div>`;

	$('#libraryModal').modal('hide');

	if (!$(this).hasClass('library-col-others')) {
		$(item).after(html);
	
		let scrollTo = item.offset().top + item.height();
		idevEditor.scrollTop(scrollTo);
		
		idevEditor.init();
		idevEditor.clean();

		if ($(this).hasClass('library-col-focus')) {
			$(item).next().find('.editable').focus();
		}
	} else {
		if ($(this).hasClass('library-col-youtube')) {
			if (!$('#editor').attr('data-type')) {
				idevEditor.pasteYoutube(html);
			} else {
				idevEditor.pasteYoutubePlaceholder(html);
			}
		}
		if ($(this).hasClass('library-col-facebook')) {
			idevEditor.pasteFacebook(html);
		}
		if ($(this).hasClass('library-col-instagram')) {
			idevEditor.pasteInstagram(html);
		}
		if ($(this).hasClass('library-col-twitter')) {
			idevEditor.pasteTwitter(html);
		}
		if ($(this).hasClass('library-col-tiktok')) {
			idevEditor.pasteTiktok(html);
		}
		if ($(this).hasClass('library-col-embed')) {
			idevEditor.pasteEmbed(html);
		}
	}


});

// Загрузка обложки и картинок
$('body').on('click', '.editorImageUpload', function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parent().parent().parent();

	if (!idevEditor.target.hasClass('article__image')) {
		idevEditor.target = $(this).parents(idevEditor.controls.item);	
		$(this).parents('.editor__uploads').find('.coverupload').click();
	} else {
		$(this).parents('.editor__uploads').find('.fileupload').click();
	}
})

// Загрузка обложки Youtube
$('body').on('click', '.editorYoutubeImageUpload', function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parents('.article__video-wrap');
	$(idevEditor.target).find('.fileupload').click();
})

// Удаление обложки
$('body').on('click', '.editorImageDelete', function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parent().parent().parent();
	if (!idevEditor.target.hasClass('article__image')) {
		idevEditor.target = $(this).parents(idevEditor.controls.item);	
		$('.edit-form').data("changed", true);
		$('[name="delete_image"]').val(1);
		$('[name="image"]').val('');

		let imageElPreview = $('#editorCover');

		if (imageElPreview.length) {
			imageElPreview.attr('style', `background-image: url(\'/editor/img/nature.jpg\')`);
			$('.editor__previews').hide();
		}

	} else {
		$(this).parent().find('.fileupload').click();
	}
})

$('body').on('click', '.editorYoutube', function(e) {
	e.preventDefault();

	idevEditor.target = $(this).parents('.editor__item');

	idevEditor.pasteYoutube(null);

});

$('body').on('click', '.article__video-wrap .play-btn', function(e) {
	e.preventDefault();

	let parent  = $(this).parents('.article__video-wrap'),
		videoID = parent.attr('data-id');

	parent.find('.editor__youtubeIframe').remove();
	parent.append(`<div class="editor__youtubeIframe">
					<iframe
						src="https://www.youtube.com/embed/${videoID}?autoplay=1&mute=1"
						frameborder="0"
						allowfullscreen>
					</iframe>
				</div>`);
})

$('body').on('change', '.coverupload', function(e){
	e.preventDefault();

	let extentions = {
		'image/jpeg': 'jpg',
		'image/png': 'png',
		'jpeg': 'jpg'
	}

	if (this.files && this.files[0]) {

		let FR= new FileReader();

		if (!extentions[this.files[0].type]) {
			toastr.error('Запрещено загружать изображения в формате ' + this.files[0].type + '.', '', App.toastr.options);
			return;
		}

		console.log(this.files[0].type)
		
		FR.addEventListener("load", function(reader) {
			let imageEl = $('[name="image"]'),
				imageElPreview = $('#editorCover');
			if (imageEl.length) {
				imageEl.val(reader.target.result);
				imageElPreview.attr('style', `background-image: url(${reader.target.result})`);
				$('.edit-form').data("changed", true);
				$('.editor__previews').show();
			}
		}); 
		
		FR.readAsDataURL(this.files[0]);
	}

});

$('body').on('input', '#editorTitle', function() {
	$('.edit-form').data("changed", true);

	$('[name="name"]').val($('#editorTitle').text());
})

$('body').on('click', idevEditor.controls.imageScale, function(e) {
	
	idevEditor.target = $(this).parent().parent().parent();

	let item = idevEditor.target;

	if (item.hasClass('article__image')) {
		let style = item.attr('style');
		let sizeCover = '; background-size: cover;';
		let sizeContain = '; background-size: contain;';
		if (style.includes(sizeCover)) {
			item.attr('style', style.replace(sizeCover,sizeContain));
		} else if (style.includes(sizeContain)) {
			item.attr('style', style.replace(sizeContain,sizeCover));
		} else {
			item.attr('style', style + sizeContain);
		}
	}
});

$('body').on('click', idevEditor.controls.imageContainer, function(e) {
	e.preventDefault();
	idevEditor.target = $(this).parents('.editor__item');
	idevEditor.target.find('.article__images').toggleClass('article__container');
});

$('body').on('click', '.article__image', function(e) {
	if(!$(e.target).hasClass('article__image')) return;

	idevEditor.target = $(this);
	$(this).find('.fileupload').click();
});

$('body').on('click', '#editorCover', function(e) {
	console.log(e.target);
	if(!$(e.target).hasClass('main-img__wrap')) return;

	idevEditor.target = $(this).parents(idevEditor.controls.item);	
	idevEditor.target.find('.coverupload').click();
});

$('body').on('click', '.coverPreview', function(e) {
	e.preventDefault();

	let layout = $(this).data('layout'),
		coverW = $('#editorCover').width(),
		coverH = $('#editorCover').height(),
		style = $('#editorCover').attr('style'),
		url = null,
		imgW = 0,
		imgH = 0;

	let urlMatches = style.match(/url\('(.*?)'\)/i);
	urlMatches = urlMatches ? urlMatches : style.match(/url\("(.*?)"\)/i);
	
	if (urlMatches && urlMatches.length == 2) {
		url = `${location.origin}/${urlMatches[1]}`;
	}

	// Если base64
	urlMatches = urlMatches ? urlMatches : style.match(/url\((.*?)\)/i);
	if (urlMatches && urlMatches.length == 2) {
		url = `${urlMatches[1]}`;
	}

	if (layout == 'clear') {
		$('#editorCover').css('height', $(window).height() * 0.7 + 'px');
		idevEditor.cleanCanvas();
		return;
	}

	if (url) {
		let img = new Image();
		img.onload = function() {
			imgW = this.width;
			imgH = this.height;

			console.log(`Размеры картинки: ${imgW}х${imgH}`);
			console.log(`Размеры хедера: ${coverW}х${coverH}`);

			coverH = coverW/imgW * imgH;
			console.log(`Размеры хедера масштабированного под картинку: ${coverW}:${coverH}`);

			$('#editorCover').css('transition', 'height 0.3s ease-in');
			$('#editorCover').css('height', coverH + 'px');

			setTimeout(() => {
				idevEditor.drawCanvas(layout);
			}, 400)
		};
		img.src = url;
	}
})

$(document).ready(function() {
	idevEditor.init();
});

$(window).on('load',function(){
   $('body').animate({'opacity':1},300);
});

