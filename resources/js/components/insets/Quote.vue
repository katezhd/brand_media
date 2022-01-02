<template>
    <div id="quoteContainer" class="quote inset-height" v-if="content.text">
        <svg class="quote__svg">
            <use xlink:href="#quotes"/>
        </svg>
        <span class="quote__text">{{ content.text }}</span>
        <div class="promo__btns">
            <a :href="'/news/' + content.news.uri" class="promo__btn" v-if="content.news" target="_blank">
                <svg>
                    <use xlink:href="#link"/>
                </svg>
            </a>
            <button class="promo__btn" @click="shareFbImage">
                <svg>
                    <use xlink:href="#facebook"/>
                </svg>
            </button>
            <a :href='telegram_link' class="promo__btn" target="_blank" @click="shareStats('telegram')">
                <svg>
                    <use xlink:href="#telegram"/>
                </svg>
            </a>
        </div>
        <span class="quote__author-wrap" v-if="content.name">
            <span class="quote__author">{{ content.name }}</span>
        </span>
    </div>
    <div class="quote inset-height" v-if="!content.text" style="justify-content: center;">
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
            this.link = window.location.origin + '/storage/social/quote-' + this.$props.content.id + '.jpg';
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
                        hashtag: '#цитата',
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
                    type: 'quote',
                    social: social,
                    inset_id: this.$props.content.id
                }
                service.shareStats(data);
            }
        }
    }
</script>
