<template>
  <div v-if="news.length">
    <span class="category-block__name">{{ category_name }}</span>
    <div class="category-slider swiper" ref="categorySlider">
      <div class="swiper-wrapper">
        <BlockCategory v-for="article in news" 
          :key="article.id" 
          :article="article"></BlockCategory>
      </div>
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
  import BlockCategory from '../blocks/BlockCategory';
  import Swiper from 'swiper';
  import 'swiper/css';
  import service from '../../service'

  export default {
    data() {
      return {
        CategorySlider: null,
        news: [],
        params: {
          page: 1,
          category: this.$props.category.category_uri,
          status: 'visible',
          sort: 'published_at|desc'
        }
      }
    },
    props: ['category', 'category_name'],
    components: {
      BlockCategory
    },
    mounted() {
      service.getNewsList(this.params)
      .then((data) => {
        this.news = data.data.news.data;
      })
    },
    updated() {
      this.$nextTick(function () {
          this.CategorySlider = new Swiper('.category-slider', {
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