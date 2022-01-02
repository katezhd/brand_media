"use strict";

const HUMAN_DATE = 'DD-MM-YYYY HH:mm';
const HUMAN_TIME = 'HH:mm';
const HUMAN_DAY  = 'DD-MM-YYYY';
const MACHINE_DATE = 'YYYY-MM-DD HH:mm:ss';
const MACHINE_TIME = 'HH:mm';
const MACHINE_DAY = 'YYYY-MM-DD';

let App = {

	user: {
		id : null,
		startCntrl : null,
		firstname : null,
		lastname: null,
		image: null,
		lang: 'ru',
		token: function() {
			let user = localStorage.getItem('user');
			user = user ? JSON.parse(user) : {};
			return user.token ? user.token : null;
		},
		headers: function() {
			return {
				'Authorization'   : `Bearer ${App.user.token()}`,
				'Accept'          : 'application/json',
			}
		}
	},

    st : {
        cntrl: null,
        action: null,
    
        apiCntrl: null,
        caption: null,
        icon: null,
        page: 1,
        id: null,
    
        sort: 'id|desc',
        search: '',
        dateFrom: null,
		dateTill: null,
		period: 'month',

		filters: {},
		chartFilters: {},

		// freeDraw: null,
		// polygon: [],
		repeaters: [],
		templates: [],
	},
	
	toastr: {
		options: { 
			"showMethod" : "slideDown", 
			"hideMethod" : "slideUp", 
			timeOut      : 2000 
		}
	},

    init: function() {
		console.log(`FUNCTION init`);

		if (App.route()) {

			App.events();
			switch (App.st.action) {
				case 'create':
					App.initEditView();
					break;
				case 'edit':
					let singular = $('.sidebar-link[href="#' + App.st.cntrl + '"]').attr('data-singular');
					if (!singular &&  App.st.cntrl == 'users' && App.st.id != App.user.id) {
						location.hash = 'users-edit-' + App.user.id;
						location.reload();
					} else {
						App.initEditView(App.st.id);
					}
					break;
				case 'view':
					App.initEditView(App.st.id, 'preview');
					break;
				case 'constructor':
					App.initConstructor();
					break;
				case 'stats':
					App.initStats();
					break;
				default:
					App.initListView(App.st.page);
					break;
			} 
			App.initActive();
		}
	},

	checkToken: function() {
		console.log(`FUNCTION checkToken`);
		let user = localStorage.getItem('user');
		user = user ? JSON.parse(user) : {};

		if (!user.token) {
			return false;
		}

		return true;
	},

	doConfirmUser: function(e) {
		console.log(`FUNCTION doConfirmUser`);
		if (e.keyCode == 13) {
            let username = $('[name="username"]').val().trim();
            let password = $('[name="password"]').val().trim();
            if (username && password) {
                $(".swal2-confirm").click();
            }
        }
	},

	login: function(callback) {
		console.log(`FUNCTION login`);
		$(App.controls.loader).fadeOut();

		var swal = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-block btn-outline-primary mr-2'
			},
			buttonsStyling: false,
		})

		swal.fire({
			title: "Авторизуйтесь, пожалуйста",
			html: renderMustache('var', 'auth.login', {}),
			type: "warning",
			focusConfirm: false,
			confirmButtonText: "Войти",
			showLoaderOnConfirm: true,
			allowOutsideClick: false,
			preConfirm: () => {
				return fetch(`/api/v1/token`, {
					method: 'POST',
					headers: {
						"Content-Type": "application/json",
    					"Accept": "application/json",
					},
					body: JSON.stringify({
						"email"     : $('[name="username"]').val(),
						"password"  : $('[name="password"]').val(),
						"recaptcha" : $('#recaptcha').val()
					})
				})
				.then(response => {
					return response.json()
				})
				.then(response => {
					console.log(response);
					if (response.status == 'error') {
						console.log(response.message);
						throw new Error(response.message);
					}
					if (response.error) {
						console.log(response.message);
						throw new Error('Неправильный email или пароль')
					}
					return response
				})
				.catch(error => {
					console.log(error);
					Swal.showValidationMessage(error);
					recaptcha();
					return false;
				});
			}
		})
		.then((result) => {
			console.log(result);
			if (result.value) {
				let user = result.value;
				localStorage.setItem('user', JSON.stringify(user));
				App.initUser(callback);
			}
		})
	},

	logout: function() {
		console.log(`FUNCTION logout`);
		localStorage.removeItem('user');
		location.reload();
	},

	getUserRoles: function(callback) {
		console.log(`FUNCTION getUserRoles`);
		$.ajax({
			url: `/api/v1/roles?user_id=${App.user.id}`,
			type: 'GET',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
		})
		.done(function(data) {
			let modules = [];
			let roles = [];
			let scopes = {};
			data.data.forEach(role => {
				roles.push(role.id);

				if (role.modules) {
					role.modules.forEach(module => {
						if (module.pivot && module.pivot.scopes) {
							scopes[module.plural] = JSON.parse(module.pivot.scopes);
						}
					})
				}
				
				let newModules = role.modules.filter(m => {
					let exist = false;
					modules.forEach(module => {
						exist = exist ? exist : module.id == m.id;
					})
					return !exist;
				});
				modules = modules.concat(newModules);
			});

			App.user.roles = roles;
			App.user.scopes = scopes;

			// console.log(App.user.scopes);

			modules = modules.sort(function(ob1, ob2) {
				if (ob1.sort > ob2.sort) return 1;
				if (ob1.sort < ob2.sort) return -1;
				return 0;
			});

			// let hasNotices = false;
			let initModule = null;
			modules.forEach(module => {
				// if (module.plural == 'notices') {
				// 	hasNotices = true;
				// }
				if (!initModule) {
					initModule = module.parent_id ? module.plural : null;
					if (!initModule && module.plural.indexOf('_group') == -1) {
						initModule =  module.plural;
					}
				}
			})

			App.user.startCntrl = initModule;

			let topLevelModules = modules.filter(m => {
				return !m.parent_id;
			})

			let bottomLevelModules = modules.filter(m => {
				return m.parent_id;
			})

			modules = topLevelModules.map(tm => {
				tm.childs = [];
				bottomLevelModules.forEach(bm => {
					if (bm.parent_id == tm.id) {
						tm.childs.push(bm);
					}
				}) 
				return tm;
			})

			modules = modules.map(m => {
				if (m.childs.length) {
					m.hasChilds = true;
				}
				return m;
			})

			// console.log(modules);

			renderMustache('#sidebarnav', 'auth.menu', {'modules' : modules}, 'append');
			callback();
		})
		.fail(function(error) {
			App.showError(error);
		});
	},

	getUser: function(callback) {
		console.log(`FUNCTION getUser`);
		$.ajax({
			url: '/api/v1/user',
			type: 'GET',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
		})
		.done(function(data) {
			console.log(data);

			App.user.image = data.image ? data.image : null;
			App.user.firstname = data.firstname ? data.firstname : null;
			App.user.lastname = data.lastname ? data.lastname : null;
			App.user.id = data.id ? data.id : null;
			App.user.startCntrl = 'news';

			if (App.user.image) {
				$(App.controls.userAvatar)
					.attr('src', `/storage/users/${App.user.image}`);
			}
			if (App.user.firstname || App.user.lastname) {
				$(App.controls.userName)
					.text(`${App.user.firstname}`);
				$(App.controls.userAvatar)
					.attr('alt', `${App.user.firstname}`);
			}
			if (App.user.id) {
				$(App.controls.userLink)
					.attr('href', `#users-edit-${App.user.id}`)
					.on('click', function(e) {
						e.preventDefault();
						let href = $(this).attr('href');
						location.hash = href;
						App.route();
						App.initActive();
						App.initEditView(href.replace('#users-edit-', ''));
					});
			}

			App.getUserRoles(callback);

		})
		.fail(function(error) {
			localStorage.removeItem('user');
			App.showError(error)
			App.initUser(callback);
		});
	},

	initUser: function(callback) {
		console.log(`FUNCTION initUser`);
	
		if (!App.checkToken()) {
			App.login(callback);
		} else {
			App.getUser(callback);
		}
	},

    route: function(uri) {
		console.log(`FUNCTION route`);
		var hash = window.location.hash;

		// console.log(hash.length);
		// return
        
		if (!hash.length) {
			window.location.hash = App.user.startCntrl;
			App.init();
			return false;
		}

		uri = typeof uri !== 'undefined' ? uri : hash;
		uri = uri.replace('#','');

		var route = uri.split('-');
		// console.log(route);
		App.st.cntrl    = typeof route[0] !== 'undefined' && route[0] ? route[0] : App.user.startCntrl;
        App.st.action   = typeof route[1] !== 'undefined' && route[1] ? route[1] : 'list';

				if(App.st.cntrl.indexOf('constructor') > -1) {
					App.st.action = 'constructor';
				}

				if(App.st.cntrl.indexOf('stats') > -1) {
					App.st.action = 'stats';
				}
        
		App.st.apiCntrl = App.getApiCntrl();
		App.st.caption  = App.getCaption();
		App.st.icon     = App.getIcon();
		App.st.sort     = App.getSort();
        
		if(App.st.action == 'list') {
			App.st.id   = typeof route[3] !== 'undefined' ? route[3] : null;
			App.st.page = typeof route[2] !== 'undefined' ? route[2] : 1;
		} else {
			App.st.id   = typeof route[2] !== 'undefined' ? route[2] : null;
		}

		return uri.replace('#','');
	},
	
	tmp : {},
    
    controls: {
        loader          : '.preloader',
        listBtn 		: '.list-btn',
        addBtn 		    : '.add-btn',
        saveBtn 		: '.save-btn',
		editBtn 		: '.edit-btn',
		viewBtn 		: '.view-btn',
		publishBtn 		: '.publish-btn',
		// copyBtn 		: '.copy-btn',
		cancelBtn 		: '.cancel-btn',
        deleteBtn 		: '.delete-btn',
        calendarBtn 	: '.calendar-btn',
		content         : '#content',
		editForm		: '.edit-form',
		modal			: '#appModal',
		editor			: null,
		uploadImg       : '[name="image"]',
		uploadImgs      : '[name="images"]',
		uploadImgInput  : '[name="imageupload"]',
		uploadImgBtn    : '.upload-image-btn',
		uploadImgPreview: '.image-preview',
		deleteImgBtn	: '.delete-image-btn',
		userAvatar      : '.userAvatar',
		userName        : '.userName',
		userLang        : '.userLang',
		userLink		: '.userLink',
		// calendar		: null
    },
    
    getApiCntrl: function() {
		console.log(`FUNCTION getApiCntrl`);
		switch (App.st.cntrl) {
			
			default:
				let cntrl = $('.sidebar-link[href="#' + App.st.cntrl + '"]').attr('data-singular');
				if (!cntrl &&  App.st.cntrl == 'users') cntrl = 'user';
				return cntrl ? cntrl : App.st.cntrl;
		}
	},

	getCaption: function() {
		console.log(`FUNCTION getCaption`);
        var caption = $('.sidebar-link[href="#' + App.st.cntrl + '"]')
                        .find('.hide-menu')
						.text()
		if (!caption &&  App.st.cntrl == 'users') caption = 'Пользователи';
        return caption ? caption.trim() : null;
	},

	getIcon: function() {
		console.log(`FUNCTION getIcon`);
		var icon =  $('.sidebar-link[href="#' + App.st.cntrl + '"]')
            .find('i')
            .attr('class');

        return icon ? icon.trim() : null;
	},

	getSort: function() {
		console.log(`FUNCTION getSort`);
        var sort = $('.sidebar-link[href="#' + App.st.cntrl + '"]')
                        .attr('data-order')
        return sort ? sort.trim() : 'id|desc';
	},

	initCreateView: function(data) {
		console.log(`FUNCTION initCreateView`);
		App.st.cntrl = data.st_cntrl;
		App.st.action = data.st_action;
		App.st.apiCntrl = App.getApiCntrl();
		App.st.icon = App.getIcon();
		App.st.caption = App.getCaption();

		window.location.href = `#${App.st.cntrl}-create`;

		data = Object.assign(
			data, 
			{st: App.st}, 
			{now : moment().format(MACHINE_DATE)},
			{doer : App.user});

		data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});

		renderMustache(App.controls.content, App.st.cntrl +  '.edit', data);
		App.initEditControls();
		idevEditor.init();
		$(App.controls.loader).fadeOut(400);
	},
    
    initEditView: function(id, mode) {
		console.log(`FUNCTION initEditView`);
		let now = moment().format(MACHINE_DATE);
		
		let preview = (mode && mode == 'preview') ? mode : null;

		if (!id) {
			let data = Object.assign(
				{st: App.st}, 
				{now : now},
				{doer : App.user}
			);

			data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});
			data = Object.assign(data, {origin: location.origin});

			// if (App.st.cntrl == 'address_notices' || App.st.cntrl == 'address_statuses') {
			// 	data = Object.assign(data, {branch_ids: App.user.branches.join(',')});
			// }

			// if(['quiz_variants', 'inspector_quiz_variants'].indexOf(App.st.cntrl) > -1  && App.tmp.create) {
			// 	data.path = App.tmp.create.path;
			// 	data.quiz_id = App.tmp.create.quiz_id;
			// }

			renderMustache(App.controls.content, App.st.cntrl +  '.edit', data);

			if (App.st.cntrl == 'news') {
				$('#main-wrapper').addClass('mini-sidebar');
				$('#main-wrapper').attr('data-sidebartype', 'mini-sidebar');
			}

			App.initEditControls();

			// if (App.st.cntrl == 'entities' && !mode) {
			// 	App.initDrag();
			// }

			// if (['entities', 'appeal_types', 'vacancies', 'events'].indexOf(App.st.cntrl) > -1 && !mode) {
			// 	App.initRepeater([{
			// 		target : '.email-repeater',
			// 		data : []
			// 	}, {
			// 		target : '.phone-repeater',
			// 		data : []
			// 	}]);
			// }

			// if (['news'].indexOf(App.st.cntrl) > -1 && !mode) {
			// 	App.initRepeater([{
			// 		target : '.video-repeater',
			// 		data : []
			// 	}]);
			// }

			// if (['news'].indexOf(App.st.cntrl) > -1 && !mode) {
			// 	App.initRepeater([{
			// 		target : '.image-repeater',
			// 		data : []
			// 	}]);
			// }

			idevEditor.init();

			$(App.controls.loader).fadeOut(400);
		} else {

			let data = {};

			$.ajax({
				url: '/api/v1/' + App.st.apiCntrl + '/' + id,
				type: 'GET',
				data: data,
				xhrFields: {
					withCredentials: true
				},
				headers: App.user.headers(),
				beforeSend: function(){
					$(App.controls.loader).fadeIn(400);
				}
			})
			.done(function(data) {
				data = Object.assign(data, {st: App.st}, {now : now}, {preview : preview});

				data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});
				data = Object.assign(data, {origin: location.origin});

				let singular = $('.sidebar-link[href="#' + App.st.cntrl + '"]').attr('data-singular');
				if (!singular && App.st.cntrl == 'users' && App.st.id == App.user.id) {
					data = Object.assign(data, { isOwner: true });
				}

				// if (App.st.cntrl == 'address_notices' || App.st.cntrl == 'address_statuses') {
				// 	data = Object.assign(data, {branch_ids: App.user.branches.join(',')});
				// }

				// if (App.st.cntrl == 'quizes' && data.variants && data.variants.length) {
				// 	data.with_variants = true;
				// }
				// if (App.st.cntrl == 'inspector_quizes' && data.variants && data.variants.length) {
				// 	data.with_variants = true;
				// }

				renderMustache(App.controls.content, App.st.cntrl +  '.edit', data);

				if (App.st.cntrl == 'news') {
					$('#main-wrapper').addClass('mini-sidebar');
					$('#main-wrapper').attr('data-sidebartype', 'mini-sidebar');
				}
				
				App.initEditControls();
				App.convertDates();
				App.initPercents();

				App.initModels();

				// if (App.st.cntrl == 'news' && !mode) {
				// 	App.initDrag();
				// }

				// if (['entities', 'appeal_types', 'vacancies', 'events'].indexOf(App.st.cntrl) > -1 && !mode) {
				// 	App.initRepeater([{
				// 		target : '.email-repeater',
				// 		data : data.emails
				// 	}, {
				// 		target : '.phone-repeater',
				// 		data : data.phones
				// 	}]);
				// }

				// if (['news'].indexOf(App.st.cntrl) > -1 && !mode) {
				// 	App.initRepeater([{
				// 		target : '.image-repeater',
				// 		data : data.images
				// 	}]);
				// 	App.initRepeater([{
				// 		target : '.video-repeater',
				// 		data : data.videos
				// 	}]);
				// }

				// if (['events'].indexOf(App.st.cntrl) > -1) {
				// 	App.initCalendar(data);
				// }

				// setTimeout(() => {
					// }, 500);
				if (!preview) {
					idevEditor.init();
				}
			})
			.fail(function(error) {
				App.showError(error);
			})
			.always(function() {
				if (!$('.ajax-content').length) {
					$(App.controls.loader).fadeOut(400);
				}
			});
		}
	},

	editElem: function(id, data, callback) {
		console.log(`FUNCTION editElem`);
		var url = '/api/v1/' + App.st.apiCntrl;
			url = id ? url + '/' + id : url;

		$.ajax({
			url: url,
			type: id ? 'PUT' : 'POST',
			dataType: 'json',
			data: data,
			// processData: false,
			// contentType: false,
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {

			if (!callback) {
				$('.edit-form').data("changed", false);
				location.hash = '#' + App.st.cntrl + '-edit-' + data.id;
				App.route();
				App.initEditView(data.id);
			}

			if (App.st.cntrl == 'templates') {
				App.st.templates = [];
			}
			
			if (id) {
				toastr.success('Запись сохранена', '', App.toastr.options);
			} else {
				toastr.success('Запись создана', '', App.toastr.options);
			}

			if (callback) {
				callback();
			}
		})
		.fail(function(error) {
			App.showError(error);
		})
		.always(function(){
			$(App.controls.loader).fadeOut(400);
			$('.save-btn').removeClass('disabled');
			$('.preview-btn').removeClass('disabled');
		});
	},

	createImage: function(src, url, callback) {
		console.log(`FUNCTION createImage`);
		$.ajax({
			url: url,
			data: {
				image: src
			},
			type: 'POST',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers()
		})
		.done(function(data) {
			toastr.success('Изображение сохранено', '', App.toastr.options);
			callback()
		})
		.fail(function(error) {
			App.showError(error);
		});
	},

	deleteImage: function(url, callback) {
		console.log(`FUNCTION deleteImage`);
		$.ajax({
			url: url,
			type: 'DELETE',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers()
		})
		.done(function(data) {
			toastr.success('Изображение удалено', '', App.toastr.options);
			callback()
		})
		.fail(function(error) {
			App.showError(error);
		});
	},

	deleteElem: function(id, cntrl) {
		console.log(`FUNCTION deleteElem`);
		cntrl = cntrl ? cntrl : App.st.apiCntrl;

		$.ajax({
			url: '/api/v1/' + cntrl + '/' + id,
			type: 'DELETE',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {
			if (cntrl == App.st.apiCntrl) {
				location.hash = '#' + App.st.cntrl + '-list-' + App.st.page;
				App.route();
				App.initListView(App.st.page);
			}

			// if (cntrl != App.st.apiCntrl && cntrl == 'quiz_variant') {
			// 	$(`.variant-${id}`).slideUp();
			// }
			// if (cntrl != App.st.apiCntrl && cntrl == 'inspector_quiz_variant') {
			// 	$(`.variant-${id}`).slideUp();
			// }
			toastr.success('Запись удалена', '', App.toastr.options);
		})
		.fail(function(error) {
			App.showError(error);
		})
		.always(function(){
			$(App.controls.loader).fadeOut(400);
		});
	},

	// copyElem: function(id) {
	// 	console.log(`FUNCTION copyElem`);
	// 	$.ajax({
	// 		url: '/api/v1/' + App.st.apiCntrl + '/' + id + '/copy',
	// 		type: 'POST',
	// 		xhrFields: {
	// 			withCredentials: true
	// 		},
	// 		headers: App.user.headers(),
	// 		beforeSend: function(){
	// 			$(App.controls.loader).fadeIn(400);
	// 		}
	// 	})
	// 	.done(function(data) {
	// 		// if (App.st.cntrl == 'imports') {
	// 		// 	location.hash = '#notices-edit-' + data.id;
	// 		// } else {
	// 			location.hash = '#' + App.st.cntrl + '-edit-' + data.id;
	// 		// }
	// 		App.route();
	// 		App.initEditView(data.id);
	// 		toastr.success('Запись создана', '', App.toastr.options);
	// 	})
	// 	.fail(function(error) {
	// 		App.showError(error);
	// 	})
	// 	.always(function(){
	// 		$(App.controls.loader).fadeOut(400);
	// 	});
	// },

    initListView: function(page) {
		console.log(`FUNCTION initListView`);
		page    = typeof page !== 'undefined' ? page : 1;

		let data = {
			page   : page,
			sort   : App.st.sort,
			search : App.st.search,
			from   : App.st.dateFrom,
			till   : App.st.dateTill
		};

		let filters = App.st.filters[App.st.cntrl];
		
		if (filters) {
			for (let i in filters) {
				let filter = filters[i];
				if (filter.value) {
					data[filter.name] = filter.value;
				}
			}
		}

		let url = App.st.cntrl;

		if (App.st.cntrl == 'inset_contents') {
			url = App.st.cntrl + '?status=editable';
		}

		$.ajax({
			type: 'GET',
			url: '/api/v1/' + url,
			data: data,
			dataType: 'json',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {
			// console.log('**********');
			// console.log(data);
			if (!data.data) {
				data = Object.assign({}, {
					data : data
				});
			}
			
			data = Object.assign(data, {st: App.st});
			data = Object.assign(data, {origin: location.origin});

			data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});

			// if (App.st.cntrl == 'address_notices' || App.st.cntrl == 'address_statuses') {
			// 	data = Object.assign(data, {branch_ids: App.user.branches.join(',')});
			// }

			if (App.st.dateFrom && App.st.dateTill) {
				data = Object.assign(data, {
					fromFormated : moment(App.st.dateFrom, HUMAN_DATE).format(MACHINE_DATE),
					tillFormated : moment(App.st.dateTill, HUMAN_DATE).format(MACHINE_DATE)
				});
			}

			if (App.st.cntrl == 'activitylogs') {
				App.st.modules = data.modules;
			}
		
			renderMustache(App.controls.content, App.st.cntrl + '.list', data);
			
			App.initSign();
			App.initTotal();
			App.initPercents();
			App.initModels();

			// подключение таблицы с данными, пагинацией, 
			// сортировкой и кнопками DataTable
			App.initDataTable(data);

			// if (App.st.cntrl == 'slides') {
			// 	App.initDragWithSaving();
			// }

			// ин-ция селектов, чекбоксов и пр.
			App.initEditControls();

		})
		.fail(function(error) {
			App.showError(error);
		})
		.always(function(){
			$(App.controls.loader).fadeOut(400);
		});		
	},

	initConstructor() {
		console.log('FUNCTION initConstructor');
		let url = App.st.cntrl;

		App.initRepeater([{
			target : '.page-repeater',
			data : []
		}]);
		
		let data = {
			status			: 'visible',
			sort   			: App.st.sort,
			constructor	: true
		};

		let filters = App.st.filters[App.st.cntrl];
		
		if (filters) {
			for (let i in filters) {
				let filter = filters[i];
				if (filter.value) {
					data[filter.name] = filter.value;
				}
			}
		}

		$.ajax({
			type: 'GET',
			url: '/api/v1/' + url,
			data: data,
			dataType: 'json',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {
			let newsAmount = 5;
			let pages = [];
			let oldData = data;

			$(data).each((k, el) => {
				let page = el.position.split('.')[0] - 1;
				if(!pages.hasOwnProperty(page)) {
					pages[page] = [];
				}

				let num = el.position.split('.')[1];
				for (let i = 1; i <= newsAmount; i++) {
					if(i == num) {
						pages[page] = {};
					}
				}
			})

			if (!data.data) {
			data = Object.assign({}, {
				data : data
			});
		}
			data = Object.assign(data, {st: App.st});
	
			data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});

			data = Object.assign(data, {pages: pages});

			renderMustache(App.controls.content, 'news.constructor', data);
		
			App.initRepeater([{
				target : '.page-repeater',
				data : data.pages
			}]);

			$(oldData).each((k, el) => {
				var newOption = new Option(el.name, el.id, false, false);
				let page = el.position.split('.')[0] - 1,
					num = el.position.split('.')[1];
				$(`[name="pages[${page}][${num}]"]`).append(newOption);
				$(`[name="pages[${page}][${num}]"]`).val(el.id).trigger('change');

				$($(`[name="pages[${page}][${num}]"]`)).parents('.card-image').css('background-image', `url(/storage/news/${el.image})`);
				if(el.is_promo === 1) {
					$($(`[name="pages[${page}][${num}]"]`)).parents('.card-image').find('.promo-badge').removeClass('hidden');
				}
			})

		}).fail(function(error) {
				App.showError(error);
		})
		.always(function(){
			$(App.controls.loader).fadeOut(400);
		});
	},
	initStats(page) {
		console.log('FUNCTION initStats');
		page    = typeof page !== 'undefined' ? page : 1;

		let url = App.st.cntrl;

		let data = {
			page   : page,
			sort   : App.st.sort,
			search : App.st.search,
			from   : App.st.dateFrom,
			till   : App.st.dateTill
		};

		let filters = App.st.filters[App.st.cntrl];
		
		if (filters) {
			for (let i in filters) {
				let filter = filters[i];
				if (filter.value) {
					data[filter.name] = filter.value;
				}
			}
		}

		$.ajax({
			type: 'GET',
			url: '/api/v1/' + url,
			data: data,
			dataType: 'json',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {

			if (!data.data) {
				data = Object.assign({}, {
					data : data
				});
			}
			data = Object.assign(data, {st: App.st});
			data = Object.assign(data, {uScopes: App.user.scopes[App.st.cntrl]});
			// data = Object.assign(data, {pages: pages});

			if (App.st.dateFrom && App.st.dateTill) {
				data = Object.assign(data, {
					fromFormated : moment(App.st.dateFrom, HUMAN_DATE).format(MACHINE_DATE),
					tillFormated : moment(App.st.dateTill, HUMAN_DATE).format(MACHINE_DATE)
				});
			}
		
			renderMustache(App.controls.content, `${App.st.cntrl.split('_stats')[0]}.stats`, data);
			
			App.initSign();
			App.initTotal();
			App.initPercents();
			App.initModels();

			App.initDataTable(data);
			App.initDataCharts();
			App.initEditControls();
		}).fail(function(error) {
				App.showError(error);
		})
		.always(function(){
			$(App.controls.loader).fadeOut(400);
		});
	},
	initDataCharts() {
		console.log('FUNCTION initDataCharts');
		let data = {
			from   : App.st.dateFrom,
			till   : App.st.dateTill,
			period : App.st.period, 
		};

		let chartFilters = App.st.chartFilters[App.st.cntrl];
		
		if (chartFilters) {
			for (let i in chartFilters) {
				let filter = chartFilters[i];
				if (filter.value) {
					data[filter.name] = filter.value;
				}
			}
		}

		let url = App.st.cntrl.split('_')[0] + '_charts';

		console.log(data);

		$.ajax({
			type: 'GET',
			url: '/api/v1/' + url,
			data: data,
			dataType: 'json',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
			beforeSend: function(){
				$(App.controls.loader).fadeIn(400);
			}
		})
		.done(function(data) {
			console.log(data);
			let labels = [],
					series = [[],[],[],[],[]],
					legendNames = ['Facebook', 'Telegram'];

			$(data).each((k, el) => {
				if(el.count && el.date) {
					if(labels.indexOf(el.date) == -1) {
						labels.push(el.date);
					}
					let dataKey = Object.keys(labels).find(key => labels[key] === el.date);
					if(App.st.cntrl.indexOf('insets') > -1) {
						if(el.social == 'facebook') {
							series[0][dataKey] = el.count;
							series[1][dataKey] = series[1][dataKey] ? series[1][dataKey] : 0
						} else {
							series[1][dataKey] = el.count;
							series[0][dataKey] = series[0][dataKey] ? series[0][dataKey] : 0
						}
					} else if(App.st.cntrl.indexOf('news') > -1) {
						
					}
				}
			})
			console.log(labels);
			console.log(series);

			new Chartist.Line('.dataChart', {
				labels: labels,
				series: series
				}, {
						low: 0,
						scaleMinSpace: 20,
						showArea: true,
						fullWidth: true,
						plugins: [
								Chartist.plugins.tooltip(),
								Chartist.plugins.legend({
										legendNames: legendNames,
								})
						],
						axisY: {
								onlyInteger: true,
								offset: 20,
						}
				});
		})
		
	},
	initDataTable(data) {
		console.log(`FUNCTION initDataTable`);
		$.fn.dataTable.models.oSettings.fnRecordsTotal = function() { 
			return data.total || data.data.length || 0; 
		};
		$.fn.dataTable.models.oSettings.fnRecordsDisplay = function() { 
			return data.total || data.data.length || 0; 
		};

		$.fn.dataTable.models.oSettings.fnDisplayEnd = function() { 
			return data.to || data.total || data.data.length; 
		};

		let order = App.st.sort.split('|'),
			index = $('[data-orderable]').index($('[data-orderable="' + order[0] + '"]'));
		
		order = [[ index > -1 ? index : '0', order[1] ]];

		let dataTable = $('#file_export').DataTable({
			dom: 'frtip',
			paging: data.total && (data.total > data.per_page) ? true : false,
			pageLength :  data.per_page ? data.per_page : 1000,
			iDisplayStart: data.from ? (data.from - 1) : 0,
			order: order,
			searching: false,
			language: {
				url: (App.user.lang == 'ua') ? 
					"js/lib/pages/datatable/Ukrainian.json" :
					"js/lib/pages/datatable/Russian.json"
			},
			initComplete: function() {
				App.convertDates();

				$("#content tbody").unmark({
					done: function() {
						if (App.st.search.length) {
							$("#content tbody").mark(App.st.search, {});
						}
					}
				});
			}
		});

		dataTable.on('page.dt', function() {
			let info = dataTable.page.info(),
				p = info.page + 1;
			location.hash = `#${App.st.cntrl}-list-${(p)}`;
			App.route();
			if(App.st.cntrl.indexOf('stats') > -1) {
				App.initStats(p);
			} else {
				App.initListView(p);
			}
		})

		dataTable.on('click', 'th', function(e) {
			e.preventDefault();
			$(App.controls.loader).fadeIn(100);
			let order = dataTable.order(),
			field = $('[data-orderable]').eq(order[0][0]).attr('data-orderable');
			
			$('.sidebar-link[href="#' + App.st.cntrl + '"]')
					.attr('data-order', `${field}|${order[0][1]}`)

			App.route();
			if(App.st.cntrl.indexOf('stats') > -1) {
				App.initStats();
			} else {
				App.initListView();
			}
		})
	},

	showError: function(error) {
		console.log(`FUNCTION showError`);
		console.log(error);
		let status = error.status;
		switch (status) {
			case 401:
				toastr.error('Пожалуйста, попробуйте авторизоваться снова.', 
					'Отказано в доступе', 
					App.toastr.options);
				App.initUser(App.init);
				break;
			
			case 422:
				toastr.error('Произошла ошибка', '', App.toastr.options);
				let errors = error.responseJSON;
					errors = errors.errors;
				for (let e in errors) {
					$(`[name="${e}"]`).attr('invalid', true);
					errors[e].map(message => {
						console.log(e);
						toastr.error(message, '', App.toastr.options);
						$(`[name="${e}"]`).next('.invalid-feedback').text(message);
						$(`[name="${e}"]`).parents('.form-group').addClass('was-validated');
						if ($(`[name="${e}"]`)[0]) {
							$(`[name="${e}"]`)[0].setCustomValidity(message);
						}

						if (e == 'name' && (App.st.cntrl == 'news' || App.st.cntrl == 'pages')) {
							$('.article__title').addClass('error');
						}

					})
				}

				idevEditor.reload();
				break;
		
			default:
				toastr.error('Произошла ошибка', '', App.toastr.options);
				idevEditor.reload();
				break;
		}
	},

    initActive: function() {
		console.log(`FUNCTION initActive`);
		$('.sidebar-item').removeClass('selected');
		$('.sidebar-link').removeClass('active');

		$('.sidebar-link[href="#' + App.st.cntrl + '"]')
		  .addClass('active')
		  .parents('#sidebarnav > .sidebar-item')
		  .addClass('selected')
		  .find('.has-arrow')
		  .addClass('active')
		  .next('.collapse')
		  .addClass('in');
	},

	initSign: function() {
		console.log(`FUNCTION initSign`);
		$('[data-sign]').each((index, el) => {
			let sign = $(el).attr('data-sign'),
				text = $(el).text();
			
			$(el).text(sign * text);
		})
	},

	initModels: function() {
		$('[data-model]').each((index, el) => {
			let module = $(el).attr('data-model'),
				text = module;
			
				
			$(App.st.modules).each((indexM, elM) => {
				if (elM.models && elM.models.indexOf(module) != -1) {
					text = elM.name;
					// console.log(elM);
					if (elM.parent) {
						text += ` (${elM.parent.name})`;
					}
				}
			})

			$(el).text(text);
		})
	},

	initTotal: function() {
		console.log(`FUNCTION initTotal`);
		let sums = {};
		$('[data-total]').each((index, el) => {
			let field  = $(el).attr('data-total'),
				text   = $(el).attr('data-text'),
				amount = $(el).attr('data-tprice'),
				sign   = $(el).attr('data-tsign');
			
			if (! (field in sums)) {
				sums[field] = {
					sum : 0,
					text : text
				}
			} 
			
			sums[field].sum += sign * amount;	
		})
		for (let field in sums) {
			sums[field].sum = sums[field].sum.toFixed(2);
			$('[data-total-' + field + ']').text(`${sums[field].sum} ${sums[field].text}`);
		}
	},

	convertDates: function() {
		console.log(`FUNCTION convertDates`);
		$('[data-date]').each(function(index, el) {
			$(el).html(formatDate($(el).attr('data-date'), $(el).attr('data-format')));
		});
	},

	initPercents: function() {
		console.log(`FUNCTION initPercents`);
		let total = +$('[data-percents-total]').attr('data-percents-total'); 
		total = total ? total : 1;
		
		$('[data-percents]').each(function(index, el) {
			$(el).text(Math.round($(el).attr('data-percents') * 100 / total));
		});
	},

	initAjaxSelect: function() {
		console.log(`FUNCTION initAjaxSelect`);
		if ($('.ajax-select').length) {
			$('.ajax-select').each((index, el) => {
				App.loadAjaxSelect(el);
			});
		}
	},

	loadAjaxSelect: function(el) {
		console.log(`FUNCTION loadAjaxSelect`);
		let maxLength = $(el).attr('data-selection-length') ? 
						$(el).attr('data-selection-length') : 
						0;

		let allowClear = $(el).attr('data-allow-clear') ? 
						$(el).attr('data-allow-clear') : 
						false;

		let tags = $(el).attr('data-tags') ? 
						$(el).attr('data-tags') : 
						false;
		console.log(el);

		$(el).select2({
			language: 'uk',
			maximumSelectionLength: maxLength,
			placeholder: allowClear ? 'не выбрано' : null,
			allowClear: allowClear,
			tags: tags,
			ajax: {
				url: $(el).attr('data-url'),
				dataType: 'json',
				xhrFields: {
					withCredentials: true
				},
				headers: App.user.headers(),
				data: function (params) {
					return {
						search: params.term
					};
				},
				delay: 500,
				processResults: function (data) {

					if (!data.data) {
						data = Object.assign({}, {
							data : data
						});
					}

					if (App.st.action == 'list') {
						data.data.unshift({
							id: '',
							name: $(el).attr('data-label')
						});
					}

					return {
						results: $.map(data.data, function (item) {
							// console.log(item);
							let text = item.name ? 
										(item.parent ? `${item.name} (${item.parent.name})` : item.name) :
										null;
							text = text ? 
									text : 
									(item.firstname || item.lastname) ?
										`${item.lastname} ${item.firstname}` :
										null;
							text = item.type_name ?
									item.type_name :
									text;
							if(App.st.cntrl.indexOf('constructor') > -1) {
								return {
									text 	: text,
									id   	: item.id,
									image : item.image,
									is_promo : item.is_promo == 1 ? true : false
								}
							} else {
								return {
									text : text,
									id   : item.id,
								}
							}
						})
					};
				},
				cache: true
			}
		})
		.on('select2:select', function(e) {
			console.log(e);
			let data = e.params.data;
			$('.edit-form').data("changed", true);

			if(App.st.cntrl.indexOf('constructor') > -1) {
				$(e.target).parents('.card-image').css('background-image', `url(/storage/news/${data.image})`);
				if(data.is_promo) {
					$(e.target).parents('.card-image').find('.promo-badge').removeClass('hidden');
				}
			}
			App.applyFilter(el, data);
		})
		.on('select2:unselect', function(e) {
			$('.edit-form').data("changed", true);
			if(App.st.cntrl.indexOf('constructor') > -1) {
				$(e.target).parents('.card-image').css('background-image', `url(/constructor/placeholder.jpg)`);
				$(e.target).parents('.card-image').find('.promo-badge').addClass('hidden');
			}
		})
		.on('select2:clear', function(e) {
			$('.edit-form').data("changed", true);
			if(App.st.cntrl.indexOf('constructor') > -1) {
				$(e.target).parents('.card-image').css('background-image', `url(/constructor/placeholder.jpg)`);
				$(e.target).parents('.card-image').find('.promo-badge').addClass('hidden');
			}
		});
	},

	applyFilter(el, data) {
		console.log(`FUNCTION applyFilter`);
		if ($(el).hasClass('filter-select')) {
			if (! (App.st.cntrl in App.st.filters)) {
				App.st.filters[App.st.cntrl] = {};
			}
			
			App.st.filters[App.st.cntrl][$(el).attr('name')] = {
				name: $(el).attr('name'),
				value: $(el).val(),
				text : data.text
			};

			if(App.st.cntrl.indexOf('stats') > -1) {
				App.initStats();
			} else {
				App.initListView();
			}
		}
		if ($(el).hasClass('chart-select')) {
			if (! (App.st.cntrl in App.st.chartFilters)) {
				App.st.chartFilters[App.st.cntrl] = {};
			}
			
			App.st.chartFilters[App.st.cntrl][$(el).attr('name')] = {
				name: $(el).attr('name'),
				value: $(el).val(),
				text : data.text
			};
			App.initStats();
		}
	},

	reloadAjaxSelects: function(el, names) {
		console.log(`FUNCTION reloadAjaxSelects`);
		names.forEach(name => {
			App.reloadAjaxSelect(el, name);
		})
	},

	reloadAjaxSelect: function(el, name) {
		console.log(`FUNCTION reloadAjaxSelect`);
		let select = '.ajax-select[name="' + name + '"]',
			url    = $(select).attr('data-base-url');

		if ($(select).hasClass("select2-hidden-accessible")) {
			$(select).val(null).trigger("change");
			$(select).attr('data-url', url + $(el).val());
			
			App.loadAjaxSelect(select);
		}

	},

	initEditControls: function() {
		console.log(`FUNCTION initEditControls`);
		$('[name="color"]').minicolors({
			theme: 'bootstrap'
		});

		$('.image-popup').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			mainClass: 'mfp-img-mobile',
			image: {
				verticalFit: true
			}
		});

		$(".scrollable").perfectScrollbar({
			wheelPropagation:!0
		})

		$(".select2:not(.ajax-select)").select2().on('select2:select', function(e) {
			if ($(this).attr('name') == 'period' || $(this).attr('name') == 'chartsPeriod') {
				let now = moment().format(HUMAN_DATE); 
				console.log('select2:not(.ajax-select)');

				if ($(this).val() == 'custom') {
					App.initPeriodPicker();
					$('[name="custom-period"]').parent().fadeIn();
				} else {
					$('[name="custom-period"]').parent().fadeOut();
				}

				if($(this).attr('name') == 'chartsPeriod') {
					if (! (App.st.cntrl in App.st.chartFilters)) {
						App.st.chartFilters[App.st.cntrl] = {};
					}
					App.st.chartFilters[App.st.cntrl]['period'] = $(this).val();
				} else {
					App.st.period = $(this).val();

					switch (App.st.period) {
						case 'day':
							App.st.dateFrom = moment().startOf('day').format(HUMAN_DATE);
							App.st.dateTill = now;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
						case 'week':
							App.st.dateFrom = moment().startOf('week').format(HUMAN_DATE);
							App.st.dateTill = now;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
						case 'month':
							App.st.dateFrom = moment().startOf('month').format(HUMAN_DATE);
							App.st.dateTill = now;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
						case 'quarter':
							App.st.dateFrom = moment().startOf('quarter').format(HUMAN_DATE);
							App.st.dateTill = now;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
						case 'year':
							App.st.dateFrom = moment().startOf('year').format(HUMAN_DATE);
							App.st.dateTill = now;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
						case 'custom':
							let dates = $('[name="custom-period"]').val().split(' - ');
							App.st.dateFrom = moment(dates[0], HUMAN_DAY).format(HUMAN_DATE);
							App.st.dateTill = moment(dates[1], HUMAN_DAY).endOf('day').format(HUMAN_DATE);
							break;
						default: 
							App.st.dateFrom = null;
							App.st.dateTill = null;
							if(App.st.cntrl.indexOf('stats') > -1) {
								App.initStats();
							} else {
								App.initListView();
							}
							break;
					}
				}
			} else {
				$('.edit-form').data("changed", true);
			}
			App.applyFilter($(this)[0], e.params.data);
		});

		$(".select2:not(.ajax-select)[data-selected]").each(function(index, el) {
			$(el).val($(el).attr('data-selected')).trigger('change');
			if ($(el).attr('data-selected') == 'custom') {
				App.initPeriodPicker();
				$('[name="custom-period"]').parent().fadeIn();
			}
		});

		App.initAjaxSelect();

		if ($('#simple-map').length > 0) App.initMap();
	
		let toolbar = [
			['history', ['undo','redo']],
			['style', ['bold', 'italic', 'clear']],
			// ['fontsize', ['fontsize']],
			// ['color', ['color']],
			// ['para', ['paragraph']],
			['insert', ['link']],
			['view', ['fullscreen', 'codeview']]
		];

		$('.summernote-light').summernote({
			lang: 'ru-RU',
			height: App.st.cntrl == 'abouts' ? 500 : 300,
			width: '100%',
			toolbar: toolbar,
			callbacks : {
				onInit: function() {
					$('.note-link-popover').hide();
				},
				onKeyup: function() {
					$('.edit-form').data("changed", true);
				},
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        			e.preventDefault();
        			document.execCommand('insertText', false, bufferText);
					
					$('.edit-form').data("changed", true);
				},
				onBlur: function() {
					var str = $(App.controls.editor).summernote('code').trim();
					$(App.controls.editor).val(str);
					$('.note-link-popover').hide();
				},
				onFocus: function() {
					App.controls.editor = $(this);
				}
			},
		})

		moment.locale('uk');

		$('[data-checked]').each(function(i,e) {
			if ($(e).attr('data-checked') == 1 || $(e).attr('data-checked') == 'true') {
				$(e).prop('checked', true).change();
				$('.edit-form').data("changed", false);
			}
		});

		$('[data-make-count]').each(function(i,el) {
			let url        = $(el).attr('data-make-count'),
				refreshers = $(el).attr('data-refresh').split(',');
			
			App.initRefresherCount(url, refreshers);
			
			refreshers.forEach(refresher => {
				$(`[name="${refresher}"]`).on('change', () => {
					App.initRefresherCount(url, refreshers);
				})
			})

		})

		$('.datepicker').each((index, el) => {
			App.initDatePicker(el);
		})

		$('.timepicker').each((index, el) => {
			App.initTimePicker(el);
		})

		$('.ajax-content:not(.ajax-content-wait-for-trigger)').each(function(i,e) {
			App.loadAjaxContent(e);
		});

		if ($('.collapse').length > 0) {
			let target = $('.collapse-select').find(":selected").data("target");
			$(`#${target}`).on('shown.bs.collapse', () => {

				if (target == 'categories' || target == 'quote') {
					App.loadAjaxSelect(`#${target} .ajax-select`);
				} else {
					$(`#${target} .select2:not(.ajax-select)`).select2();
				}
			});
			$(`#${target}`).collapse('show');
		}

	},

	initDrag() {
		console.log(`FUNCTION initDrag`);
		if ($('#draggable-area').length) {
			dragula([$('#draggable-area')[0]])
				.on("drag", function(e) {})
				.on("drop", function(e) {
					$('.variant [name*="sort"]').each((i, el) => {
						$(el).val(i + 1);
					})
				})
				.on("over", function(e, t) {
					$(e).removeClass('card-over')
				})
				.on("out", function(e, t) {
					$(e).removeClass('card-over')
				})
		}
	},

	initDragWithSaving() {
		console.log(`FUNCTION initDragWithSaving`);
		if ($('#draggable-area').length) {
			dragula([$('#draggable-area')[0]])
				.on("drag", function(e) {})
				.on("drop", function(e) {
					let data = [];

					$('.draggable-item').each((i, el) => {
						data.push({
							id: $(el).attr('data-id'),
							sort: i + 1
						});
					})

					data.pop();

					$.ajax({
						type: 'PUT',
						url: '/api/v1/' + App.st.cntrl + '/sort',
						data: { data : data },
						dataType: 'json',
						xhrFields: {
							withCredentials: true
						},
						headers: App.user.headers(),
						beforeSend: function(){
							$(App.controls.loader).fadeIn(400);
						}
					})
					.done(function() {
						toastr.success('Записи сохранены', '', App.toastr.options);
					})
					.fail(function(error) {
						App.showError(error);
					})
					.always(function(){
						$(App.controls.loader).fadeOut(400);
					});
				})
				.on("over", function(e, t) {
					$(e).removeClass('card-over')
				})
				.on("out", function(e, t) {
					$(e).removeClass('card-over')
				})
		}
	},
	
	initRepeater(opts) {
		console.log(`FUNCTION initRepeater`);
		// console.log(opts);

		opts.forEach(opt => {
			App.st.repeaters[opt.target] = $(opt.target).repeater({
				initEmpty: false,
				isFirstItemUndeletable: true,
				show: function() {
					$(this).slideDown();
					if(opt.target == '.page-repeater') {
						$(this).find('.card-title').data('num', $('div[data-repeater-item]').length);
						$(this).find('.card-title span').text($('div[data-repeater-item]').length);
					}
					App.initAjaxSelect();
				},
				hide: function(remove) {
					let self = $(this);
					swal.fire({
						title: "Внимание!",
						text: "Вы уверены, что хотите удалить эту запись?",
						type: "warning",
						showCancelButton: true,
						confirmButtonText: "Да, удалить!",
						cancelButtonText: "Нет, отменить"
					}).then(function(result) {
						if (result.value) {
							self.slideUp(remove);
						}
					})
				}
			});
	
			
			if (opt.data && opt.data.length) {
				// console.log(App.st.repeaters[opt.target]);
				// console.log(opt.data);
				App.st.repeaters[opt.target].setList(opt.data);
			}
		})
		App.initAjaxSelect();
	},

	initTimePicker(el) {
		console.log(`FUNCTION initTimePicker`);
		let value = $(el).val();

		$(el).val(value ? value : null).daterangepicker({
			timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 1,
            timePickerSeconds: false,
			autoUpdateInput: false,
            locale: {
				format: HUMAN_TIME,
				applyLabel: 'Применить',
				cancelLabel: 'Отменить'
			}
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        }).on('apply.daterangepicker', function(ev, picker) {
			$(el).val(picker.startDate.format(HUMAN_TIME) + '-' + picker.endDate.format(HUMAN_TIME));
		})
	},

	initDatePicker(el) {
		console.log(`FUNCTION initDatePicker`);
		let now = moment(),
			value = $(el).val();

		// console.log(value);

		$(el).val(value ? moment(value, MACHINE_DATE).format(HUMAN_DATE) : null).daterangepicker({
			singleDatePicker: true,
    		showDropdowns: true,
			startDate: moment(),
			timePicker: true,
			timePicker24Hour: true,
			autoUpdateInput: false,
			locale: {
				format: HUMAN_DATE,
				applyLabel: 'Применить',
				cancelLabel: 'Отменить'
			}
		}, function(chosen_date) {
			// console.log(chosen_date);
			$(el).val(chosen_date.format(HUMAN_DATE));
			$('.plan-btn').removeAttr('disabled');
		});
	},

	initRefresherCount(url, refreshers) {
		console.log(`FUNCTION initRefresherCount`);
		let data = {};

		refreshers.forEach(refresher => {
			data[refresher] = $(`[name="${refresher}"]`).val();
		})
				
		$.ajax({
			url: `/api${url}`,
			type: 'GET',
			data: data,
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
		})
		.done(function(data) {
			$($(`[data-make-count="${url}"]`)).text(data.count);
			if (data.count) {
				$('.send-btn').removeAttr('disabled');
			} else {
				$('.send-btn').attr('disabled', 'disabled');
			}
		})
		.fail(function(error) {});
	
	},

	initPeriodPicker() {
		console.log(`FUNCTION initPeriodPicker`);
		let from = App.st.dateFrom ? 
				moment(App.st.dateFrom, HUMAN_DATE).format(HUMAN_DATE) :
				moment().format(HUMAN_DATE), 

			till = App.st.dateTill ? 
				moment(App.st.dateTill, HUMAN_DATE).format(HUMAN_DATE) :
				moment().format(HUMAN_DATE);

		$('.periodpicker').val(`${from} - ${till}`).daterangepicker({
			locale: {
				format: HUMAN_DAY,
				applyLabel: 'Применить',
    			cancelLabel: 'Отменить',
			}
		});
	},

	
	loadAjaxContent: function (el) {
		console.log(`FUNCTION loadAjaxContent`);
		let url = $(el).attr('data-url');
		let target = $(el).attr('data-target');
		let template = $(el).attr('data-template');

		$.ajax({
			url: `/api${url}`,
			type: 'GET',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers()
		})
		.done(function(data) {

			data = {
				data: data,
				st: App.st,
				preview : App.st.action == 'view'
			};

			renderMustache(target, `${App.st.cntrl}.${template}`, data);
			$(target).show();

			$(el).addClass('loaded');

			App.convertDates();

			$('[data-checked]').each(function(i,e) {
				if ($(e).attr('data-checked') == 1 || $(e).attr('data-checked') == 'true') {
					$(e).prop('checked', true).change();
					$('.edit-form').data("changed", false);
				}
			});

			// if (App.st.cntrl == 'complaints') {
			// 	setTimeout(function() {
			// 		$("#chat-list").scrollTop($("#chat-list")[0].scrollHeight);
			// 	}, 500)
			// }
		})
		.fail(function(error) {
			App.showError(error);
			$(target).hide();
		})
		.always(function() {
			$(App.controls.loader).fadeOut(400);
		});
	},

	loadCollapseContent: function (el, url) {
		console.log(`FUNCTION loadCollapseContent`);
		$.ajax({
			url: `/api${url}`,
			type: 'GET',
			xhrFields: {
				withCredentials: true
			},
			headers: App.user.headers(),
		})
		.done(function(data) {
			if ($(el).attr('href') == '#templates') {
				App.st.templates = data.data;
			}
			renderMustache($(el).attr('href'), `${App.st.cntrl}.collapse`, data);
			$(el).hide().next().collapse();
		})
		.fail(function(error) {
			App.showError(error);
		});
	},
}

function recaptcha() {
	console.log(`FUNCTION recaptcha`);
	grecaptcha.ready(function() {
		grecaptcha.execute().then(function (token) {
			var recaptchaDiv = document.getElementById('recaptcha');
			recaptchaDiv.value = token;
		});
	});
};


