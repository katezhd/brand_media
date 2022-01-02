<template>
  <div class="video-slider swiper" ref="videoSlider" v-if="news.length">
    <div class="swiper-wrapper">
      <BlockVideo v-for="article in news" 
        :key="article.id" 
        :article="article"></BlockVideo>
    </div>
  </div>
  <div class="quote inset-height" v-if="!news.length" style="justify-content: center; width: 100%">
    <div class="inset-error" style="margin: 0;">
        <span>К сожалению, данные сейчас недоступны</span>
        <svg>
          <use xlink:href="#cryEmoji"/>
        </svg>
    </div>
  </div>
</template>
<script>
  import BlockVideo from '../blocks/BlockVideo';
  import Swiper from 'swiper';
  import 'swiper/css';
  import service from '../../service'

  export default {
    data() {
      return {
        videoSlider: null,
        news: [],
        params: {
          page: 1,
          video: true,
          status: 'visible',
          sort: 'published_at|desc',
        }
      }
    },
    components: {
      BlockVideo
    },
    mounted() {
      service.getNewsList(this.params)
      .then((data) => {
        this.news = data.data.news.data;
      })
    },
    updated() {
      this.$nextTick(function () {
          this.videoSlider =  new Swiper('.video-slider', {
          slidesPerView: 'auto',
          spaceBetween: 10,
          freeMode: true,
          // loop: true,
          mousewheel: {
            enabled: true
          },
          breakpoints: {
            768: {
              spaceBetween: 30
            }
          }
        })
      })
    }
  }
</script>