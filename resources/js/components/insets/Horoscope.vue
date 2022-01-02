<template>
    <div id="horoscopeContainer" class="horoscope inset-height" v-if="horoscope" :style='{ backgroundImage: `url(/images/horoscope/${horoscope.sign.slug}.svg)` }'>
        <div class="horoscope__overlay"></div>
        <div class="horoscope__bg">
            <button class="horoscope__btn" @click="open = true">
                <span class="horoscope__name">{{ horoscope.sign.name }}</span>
                <svg>
                    <use xlink:href="#chevron"/>
                </svg>
            </button>
            <span class="horoscope__text">{{ horoscope.text }}</span>
        </div>
        <div class="horoscope__aside">
            <img :src="'/images/horoscope/' + horoscope.sign.slug + '.svg'" alt="">
            <div class="promo__btns">
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
    </div>
    <div v-if="!horoscope" class="horoscope inset-height" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <span class="horoscope__name">Гороскоп</span>
        <div class="inset-error">
            <span>К сожалению, данные сейчас недоступны</span>
            <svg>
                <use xlink:href="#cryEmoji"/>
            </svg>
        </div>
    </div>
    
    <transition name="fade">
        <Modal v-if="open" @close="open = false" @id="getHoroscope" :controller="modal_type"></Modal>
    </transition>
</template>

<script>
    import service from '../../service'
    import Modal from '../modals/Modal'

    export default {
        components: {
            Modal,
        },
        data() {
            return {
                open: false,
                sign_id: 1,
                horoscope: null,
                modal_type: 'horoscope_signs',
                link: null,
                text: 'Донбас 24 - только важные новости',
                telegram_link: null
            }
        },
        mounted() {
            service.initFacebook();
            this.getHoroscope();
        },
        updated() {
            this.link = window.location.origin + '/storage/social/' + this.horoscope.sign.slug + '.jpg';
            this.telegram_link = `https://t.me/share/url?url=${this.link}&text=${this.text}`;
        },
        methods: {
            getHoroscope(sign_id = false) {
                if(localStorage.getItem('sign_id') && typeof localStorage.getItem('sign_id') != undefined) {
                    this.sign_id = localStorage.getItem('sign_id');
                }

                if(sign_id) {
                    localStorage.setItem('sign_id', sign_id);
                }

                axios.get(`/api/v1/app/horoscope`, {
                    params: {
                        sign_id: sign_id ? sign_id : this.sign_id,
                    }
                }).then(({ data }) => {
                    this.horoscope = data;
                })
            },
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
                        hashtag: '#гороскоп',
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
                    type: 'horoscope',
                    social: social,
                    name: this.horoscope.sign.name
                }
                service.shareStats(data);
            }
        }
    }
</script>
