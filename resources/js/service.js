let service = {
    getNewsList: function(params) {
        return axios.get(`/api/v1/app/news`, {
                params: params
            }).then(({ data }) => {
                if(data) {
                    let totalPages = Math.ceil(data.news.total / data.news.per_page);
                    let newsList ={
                        data: data,
                        totalPages: totalPages
                    }
                    
                    return newsList;
                }
                return {}
            })
    },
    getInsets: function (page) {
        return axios.get(`/api/v1/app/insets`, {
                params: {
                    status: 'visible',
                    page: page,
                    sort: 'position|asc'
                }
        }).then(({ data }) => {
            if(data) {
                let newData = data.data.map((item) => {
                    let newItem = {
                        type: item.type,
                        position: item.position,
                        id: item.id
                    };
                    if(item.type == 'custom') {
                        newItem['left'] = item.left;
                        newItem['right'] = item.right;
                    } else if(item.type == 'categories'){
                        newItem['category_name'] = item.category.name;
                        newItem['category_uri'] = item.category.uri;
                    }
                        return newItem
                })
                return newData;
            }
            return {};
        })
    },
    shareStats: function(data) {
        let newData = new FormData;
        for(let key in data) {
            newData.append(key, data[key]);
        }
        
        return axios.post(`/api/v1/app/inset_stat`, newData)
        .then(({ data }) => {
        })
    },
    getHumanDate: function(date, full = false) {
        if(full) {
            date = new Date(date).toLocaleDateString(
                'ru',{
                    month: 'long',
                    day: 'numeric'
                });
        } else {
            date = new Date(date).toLocaleDateString(
                'ru',{
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }
        return date;
    },
    getNumberDate: function(date) {
        date = new Date(date).toLocaleDateString(
            'ru',{
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            });
        return date;
    },
    getHumanTime: function(date) {
        if(service.isToday(date)) {
            date = new Date(date);
            date = Intl.DateTimeFormat('ru', { 
                hour: "numeric", 
                minute: "numeric", 
            }).format(date);
        } else {
            if(window.innerWidth < 375) {
                date = new Date(date).toLocaleDateString(
                    'ru', {
                        month: 'short',
                        day: 'numeric',
                    });
            } else {
                date = new Date(date).toLocaleDateString(
                    'ru', {
                        month: 'long',
                        day: 'numeric',
                    });
            }
        }
        return date;
    },
    getWeekDay: function(date, full) {
        if(full) {
            date = new Date(date).toLocaleDateString(
                'ru',{
                    weekday: 'long',
                });
        } else {
            date = new Date(date).toLocaleDateString(
                'ru',{
                    weekday: 'short',
                });
        }
        return date;
    },
    isToday: function (date) {
        const today = new Date();
        date = new Date(date);

        return date.getDate() == today.getDate() &&
            date.getMonth() == today.getMonth() &&
            date.getFullYear() == today.getFullYear()
    },
    isInViewport: function(el) {
        var rect = el.getBoundingClientRect();
        var windowHeight = (window.innerHeight || document.documentElement.clientHeight);
        var windowWidth = (window.innerWidth || document.documentElement.clientWidth);
    
        var vertInView = (rect.top <= windowHeight) && ((rect.top + rect.height) >= 0);
        var horInView = (rect.left <= windowWidth) && ((rect.left + rect.width) >= 0);
    
        return (vertInView && horInView);
    },
    initFacebook: function() {
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    }
}

export default service