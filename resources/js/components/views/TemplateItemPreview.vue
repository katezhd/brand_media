<template>
    <article v-if="error" class="article">
        <div class="article__content">
            <div class="article__container">
                <h1 class="article__title" style="text-align: center;padding: 5vh 0;">Предпросмотр страницы недоступен :(</h1>
            </div>
        </div>
    </article> 
    <article v-if="!error && article" class="article">
        <div class="main-img__wrap" style="background-image: url('/editor/img/nature.jpg');">
            <span class="main-img__badge">Категория материала</span>
        </div>

        <div class="article__container">
            <div class="article__tags"></div>
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
</template>

<script>
    
    export default {
        name: 'templateItemPreview',
        components: {},
        data() {
            return {
                user: null,
                article: null,
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
        },
        updated() {
            this.initVideoPlayer();
        },
        methods: {
            initVideoPlayer() {
                let playerBtn = document.querySelectorAll('.article__video-wrap .play-btn')[0];
                if(playerBtn) {
                    playerBtn.addEventListener('click', (e) => {
                        let videoId = e.target.parentElement.getAttribute('data-id');
                        
                        e.target.parentElement.innerHTML =`
                        <iframe
                            src="https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1" frameborder="0" allowfullscreen>
                        </iframe>
                        `
                    })
                }
            },
            get(id) {
                let self = this;
                
                axios.get(`/api/v1/template/${id}`,{
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${this.user.token}`
                    }
                })
                .then(({ data }) => {
                    
                    if (this.$route.params.key == this.hashCode(data.id + data.name)) {
                        this.article = data;
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
