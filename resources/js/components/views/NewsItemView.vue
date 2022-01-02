<template>
    <article v-if="article" class="article">
        <div class="main-img__wrap lazy-image" v-if="article.image" :data-src="'/storage/news/' + article.image">
            <a v-if="category" :href='"/category/" + category.uri' class="main-img__badge">
                <span>{{ category.name }}</span>
            </a>
            <div class="article__info-date main-img__badge main-img__badge--right">
                <svg>
                    <use xlink:href="#clock"/>
                </svg>
                <span class="article__time">{{ published_at }}</span>
            </div>
        </div>
        <div v-if="!article.image" class="article__container main-img__altinfo">
            <a v-if="category" :href='"/category/" + category.uri' class="main-img__badge main-img__badge--alt">
                <span>{{ category.name }}</span>
            </a>
            <div class="article__info-date  main-img__badge main-img__badge--alt">
                <svg>
                    <use xlink:href="#clock"/>
                </svg>
                <span class="article__time">{{ published_at }}</span>
            </div>
        </div>

        <div class="article__container">
            <div class="article__tags">
                <a v-for="tag in article.tags" :key="tag.id" :href='"/tag/" + tag.uri' class="article__tag" ref="category">{{ tag.name }}</a>
            </div>
        </div>
        <div class="article__content">
            <div class="article__container">
                <h1 class="article__title">
                {{ article.name }}
                </h1>
            </div>
            <div v-html="article.text"></div>
        </div>
        <div class="article__container">
            <a v-if="author" :href='"/author/" + author.uri' class="article__info-item">
                <div class="article__author-img" :style="[author.image ? { backgroundImage: `url(/storage/authors/${author.image})` } : { backgroundImage: `url(/images/placeholders/author.svg)`}]"></div>
                <span class="article__author-name">{{ author.lastname }} {{ author.firstname }}</span>
            </a>
            <div class="article__actions">
                <div class="article__emotions">
                    <div class="article__emotion">
                        <button id="likeBtn" class="article__emotion-btn" @click="sendEmotion" :data-id="article.id" data-action="like">
                            <svg>
                                <use xlink:href="#like"/>
                            </svg>
                        </button>
                        <span>{{ article.like }}</span>
                    </div>
                    <div class="article__emotion">
                        <button id="dislikeBtn" class="article__emotion-btn" @click="sendEmotion" :data-id="article.id" data-action="dislike">
                            <svg>
                                <use xlink:href="#dislike"/>
                            </svg>
                        </button>
                        <span>{{ article.dislike }}</span>
                    </div>
                </div>
                <div class="promo__btns">
                    <button class="promo__btn" @click="share('facebook')">
                        <svg>
                            <use xlink:href="#facebook"/>
                        </svg>
                    </button>
                    <a class="promo__btn" target="_blank" :href='"https://t.me/share/url?url=" + url' @click="share('telegram')">
                        <svg>
                            <use xlink:href="#telegram"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="tolstoycomments-feed"></div>
    </article>
    <div class="news-error" v-if="notFound">
        <Error></Error>
    </div>
    <MainView v-if="article" style="padding-top: 25px" :except="article.id"></MainView>
</template>

<script>
    import MainView from './MainView'
    import service from '../../service'
    import { Fancybox } from "@fancyapps/ui"
    import "@fancyapps/ui/dist/fancybox.css"
    import Error from '../Error'

    export default {
        name: 'newsItemView',
        emits: ['category'],
        components: {
            MainView,
            Error
        },
        data() {
            return {
                articleSlider: null,
                article: null,
                author: '',
                category: '',
                published_at: '',
                url: window.location.href,
                notFound: false
            }
        }, 
        mounted() {
            this.initComments();
            this.get(this.$route.params.uri);    
            this.handleScroll();
            window.addEventListener("scroll", this.handleScroll)
        },
        updated() {
            this.setComments();
            this.initVideoPlayer();
            this.initSocialMediaScripts();
            this.handleScroll();

            Fancybox.bind(".article__image", {
                groupAttr: 'rel'
            });
            this.checkIfVoted();
        },
        methods: {
            share(social) {
                if(social == 'facebook') {
                    var url = window.location.href;
    
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`,
                        'facebook-share-dialog',
                        'width=800,height=600'
                    );
                }

                let newData = new FormData;
                newData.append('social', social);
                
                return axios.post(`/api/v1/app/news_stat/${this.article.id}`, newData)
                .then(({ data }) => {
                })
            },
            initComments() {
                !(function(w,d,s,l,x){w[l]=w[l]||[];w[l].t=w[l].t||new Date().getTime();var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=!0;j.src='//web.tolstoycomments.com/sitejs/app.js?i='+l+'&x='+x+'&t='+w[l].t;f.parentNode.insertBefore(j,f);})(window,document,'script','tolstoycomments','3984');
            },
            setComments() {
                window['tolstoycomments'] = window['tolstoycomments'] || [];
                window['tolstoycomments'].push({
                    action: 'init',
                    values: {
                        visible: true,
                        lang: 'ru'
                    }
                });
            },
            handleScroll() {   
                let lazyImage = document.querySelectorAll('.lazy-image');                

                for (let i = 0; i < lazyImage.length; i++) {
                    if(service.isInViewport(lazyImage[i]) && !lazyImage[i].classList.contains('loaded')) {
                        let imagePath = lazyImage[i].getAttribute('data-src');
                        let image = new Image();  
                        image.onload = function(){
                            lazyImage[i].style.backgroundImage = `url(${imagePath})`;
                            lazyImage[i].classList.add('loaded');
                        } 
                        image.src = imagePath; 
                    }
                }
            },
            initSocialMediaScripts() {
                let scripts = [],
                    targets = document.querySelectorAll('[data-scripts]');
                
                if (targets.length) {
                    targets.forEach(target => {
                        let src = target.getAttribute('data-scripts');

                        if (scripts.indexOf(src) == -1) {
                            scripts.push(src)
                        }
                    })

                }

                scripts.forEach(script => {
                    let scriptEl = document.createElement('script');
                    scriptEl.src = script;

                    document.querySelector('body').appendChild(scriptEl);
                });
            },
            initVideoPlayer() {
                let playerBtn = document.querySelectorAll('.article__video-wrap .play-btn');
                if(playerBtn.length) {
                    for (let i = 0; i < playerBtn.length; i++) {
                        playerBtn[i].addEventListener('click', (e) => {
                            let videoId = e.target.parentElement.getAttribute('data-id');
                            
                            e.target.parentElement.innerHTML =`
                            <iframe
                                src="https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1" frameborder="0" allowfullscreen>
                            </iframe>
                            `
                        })
                    }
                }
            },
            get(uri) {
                axios.get(`/api/v1/app/news/${uri}`)
                .then(({ data }) => {
                    this.published_at = service.getHumanDate(data.published_at)
                    this.article = data;
                    data.author ? this.author = data.author : this.author = null;

                    var newDiv = document.createElement("div");
                    newDiv.innerHTML = data.text;

                    let imageArray = newDiv.querySelectorAll('.article__image');
                    let articleVideo = newDiv.querySelectorAll('.article__video-wrap');
                    
                    for (let i = 0; i < imageArray.length; i++) {
                        imageArray[i].style.removeProperty('background-image');
                        // -- Удалить
                        if(!imageArray[i].classList.contains('lazy-image')) {
                            imageArray[i].classList.add('lazy-image');
                        }
                        // -- Удалить
                    }

                    for (let i = 0; i < articleVideo.length; i++) {
                        // -- Удалить
                        if(!articleVideo[i].classList.contains('lazy-image')) {
                            articleVideo[i].classList.add('lazy-image');
                            let videoImg = articleVideo[i].getAttribute('style').split('(')[1].split(')')[0];
                            articleVideo[i].setAttribute('data-src',videoImg);
                        }
                        // -- Удалить
                        articleVideo[i].style.removeProperty('background-image');
                    }

                    this.article.text = newDiv.innerHTML;

                    if(data.category) {
                        this.category = data.category;
                        this.$emit('category', data.category.uri);
                    }
                    this.checkIfVoted();
                })
                .catch(() => {
                    this.notFound = true;
                });
            },
            checkIfVoted() {
                let btns = document.querySelectorAll('.article__emotion-btn'),
                    news = JSON.parse(localStorage.getItem('news'));
                console.log(btns);
                console.log(news);

                if(news) {
                    for(let j = 0; j < news.length; j++) {
                        if(+news[j] == this.article.id) {
                            for (var i = 0; i < btns.length; i++) {
                                btns[i].disabled = true;
                                btns[i].classList.add('disable');
                            }
                        }
                    }
                }
            },
            sendEmotion(e) {
                let data = new FormData,
                    token = localStorage.getItem('token'),
                    btns = document.querySelectorAll('.article__emotion-btn'),
                    news_id = this.article.id,
                    action = e.target.getAttribute('data-action'),
                    news = JSON.parse(localStorage.getItem('news')),
                    self = this;

                if(token && typeof token !== undefined && token !== 'undefined') {
                    data.append('token', token);
                }

                data.append('news_id', news_id);
                data.append('action', action);

                axios.post('/api/v1/app/reaction', data)
                .then(function (response) {
                    localStorage.setItem('token', response.data.token);

                    if(news && news != null) {
                        news.push(news_id);
                    } else {
                        news = [news_id];
                    }
                    
                    localStorage.setItem('news', JSON.stringify(news));
                    for (var i = 0; i < btns.length; i++) {
                        if(btns[i].getAttribute('data-action') == action) {
                            let countSpan = btns[i].nextElementSibling;
                            let previous = +countSpan.innerText;
                            countSpan.innerHTML = previous + 1;
                        }
                    }
                    self.checkIfVoted();

                    self.$notify({
                        text: "Ваша реакция сохранена",
                        type: 'success',
                        // duration: 1000000,
                    });
                })
                .catch(error => {
                    self.$notify({
                        text: "Вы уже реагировали на данную статью",
                        type: 'error',
                        // duration: 1000000,
                    });
                })
            },
            // fbShare() {
            //     var url = window.location.href;

            //     window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`,
            //         'facebook-share-dialog',
            //         'width=800,height=600'
            //     );
            //     return false;
            // }
        },
    }
</script>
