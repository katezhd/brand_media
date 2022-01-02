<template>
    <div id="jokeContainer" class="joke inset-height" v-if="content.text">
        <span class="joke__title">Анекдот</span>
        <span class="joke__text">{{ content.text }}</span>
        <div class="promo__btns joke__promo">
            <button class="promo__btn" @click="shareFbImage">
                <svg>
                    <use xlink:href="#facebook"/>
                </svg>
            </button>
            <a :href='telegram_link' class="promo__btn" @click="shareStats('telegram')" target="_blank">
                <svg>
                    <use xlink:href="#telegram"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="joke inset-height error-data" v-if="!content.text" style="justify-content: center;">
        <div class="inset-error" style="margin: 0;">
            <span>К сожалению, данные сейчас недоступны</span>
            <svg>
                <use xlink:href="#cryEmoji"/>
            </svg>
        </div>
    </div>
</template>

<script>
    import service from '../../service'
    export default {
        props: ['content'],
        data() {
            return {
                link: null,
                text: 'Донбас 24 - только важные новости',
                telegram_link: null
            }
        },
        mounted() {
            service.initFacebook();
            this.link = window.location.origin + '/storage/social/joke-' + this.$props.content.id + '.jpg';
            this.telegram_link = `https://t.me/share/url?url=${this.link}&text=${this.text}`;
        },
        methods: {
            shareFbImage() {
                FB.init({
                    appId            : '619817516048268',
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v3.3'
                });
                FB.ui(
                    {
                        method: 'share',
                        href: this.link,
                        hashtag: '#анекдот',
                        quote: this.text
                    },
                    function (response) {
                        if (response && response.post_id) {
                            this.shareStats('facebook');
                            console.log('success');
                        } else {
                            console.log('error');
                        }
                    }
                )
            },
            shareStats(social) {
                let data = {
                    type: 'joke',
                    social: social,
                    inset_id: this.$props.content.id
                }
                service.shareStats(data);
            }
        }
    }
</script>
