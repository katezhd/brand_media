<template>
    <article v-if="error" class="article">
        <div class="article__content">
            <div class="article__container">
                <h1 class="article__title" style="text-align: center;padding: 5vh 0;">Предпросмотр страницы недоступен :(</h1>
            </div>
        </div>
    </article> 
    <article v-if="!error && article" class="article">
        <div class="main-img__wrap lazy-image" v-if="article.image" :data-src="'/storage/news/' + article.image">
            <a v-if="category" :href='"/category/" + category.uri' class="main-img__badge">
                <span>{{ category.name }}</span>
            </a>
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
            <div class="article__info">
                <a v-if="author" :href='"/author/" + author.uri' class="article__info-item">
                    <div class="article__author-img" v-if="author.image" :style="{ 'background-image': 'url(/storage/authors/' + author.image + ')' }"></div>
                    <span class="article__author-name">{{ author.lastname }} {{ author.firstname }}</span>
                </a>
            </div>
        </div>
    </article>
</template>

<script>
    import service from '../../service'
    import { Fancybox } from "@fancyapps/ui";
    import "@fancyapps/ui/dist/fancybox.css";

    export default {
        name: 'newsItemPreview',
        components: {},
        data() {
            return {
                user: null,
                article: null,
                author: null,
                category: null,
                error: false
            }
        }, 
        mounted() {
            this.user = localStorage.getItem('user');
            this.user = this.user ? JSON.parse(this.user) : null;

            if (!this.user) {
                this.error = true;
                return;
            }
            
            this.get(this.$route.params.id);
            this.handleScroll();
            window.addEventListener("scroll", this.handleScroll)
        },
        updated() {
            this.initVideoPlayer();
            this.initSocialMediaScripts();
            this.handleScroll();
            
            Fancybox.bind(".article__image", {
                groupAttr: 'rel'
            });
        },
        methods: {
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
            get(id) {
                let self = this;
                
                axios.get(`/api/v1/app/preview/${id}`,{
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${this.user.token}`
                    }
                })
                .then(({ data }) => {
                    
                    if (this.$route.params.key == this.hashCode(data.id + data.name)) {
                        this.article = data;

                        this.author = data.author ?? null;
                        this.category = data.category ?? null;

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
                    } else {
                        this.error = true
                    }
                })
                .catch(function (er) {
                    self.error = true
                    
                    if (er.response && er.response.status == 401) {
                        setTimeout(() => {
                            window.location = `${window.location.origin}/admin`
                        }, 2000);
                    }
                });
            },
            hashCode(str) {
                let hash = 0, i, chr;
                if (str.length === 0) return hash;
                for (i = 0; i < str.length; i++) {
                    chr   = str.charCodeAt(i);
                    hash  = ((hash << 5) - hash) + chr;
                    hash |= 0;
                }
                return Math.abs(hash);
            }
        }
    }
</script>
