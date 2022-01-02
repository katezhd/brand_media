<template>
    <article v-if="article" class="article">
        <div class="main-img__wrap lazy-image" v-if="article.image" :data-src="'/storage/news/' + article.image">
        </div>

        <div class="article__content">
            <div class="article__container">
                <h1 class="article__title">
                {{ article.name }}
                </h1>
            </div>
            <div v-html="article.text"></div>
        </div>
    </article> 
    <div class="news-error" v-if="notFound">
        <Error></Error>
    </div>
</template>

<script>
    import MainView from './MainView'
    import service from '../../service'
    import { Fancybox } from "@fancyapps/ui"
    import "@fancyapps/ui/dist/fancybox.css"
    import Error from '../Error'

    export default {
        name: 'newsItemView',
        components: {
            MainView,
            Error
        },
        data() {
            return {
                article: null,
                url: window.location.href,
                notFound: false
            }
        }, 
        mounted() {
            this.get(this.$route.params.uri);    
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
            get(uri) {
                axios.get(`/api/v1/app/page/${uri}`)
                .then(({ data }) => {
                    this.article = data;
                })
                .catch(() => {
                    this.notFound = true;
                });
            },
        },
    }
</script>
