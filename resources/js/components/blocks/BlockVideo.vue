<template>
  <a :href='"/news/" + article.uri' class="swiper-slide video-slider__slide">
    <div class="video-slider__img-wrap">
        <button class="play-btn play-btn--slider">
            <svg>
                <use xlink:href="#play"/>
            </svg>
        </button>
    </div>
    <span class="video-slider__title">{{ article.name }}</span>
  </a>
</template>

<script>
  import service from '../../service'

  export default {
    props: ['article'],
    data() {
      return {
        image: '/images/placeholders/placeholder.jpg',
        storage: '/storage/news/',
      }
    },
    mounted() {
      if(this.article.image) {
        this.image = this.storage + this.article.image;
      }
      this.handleScroll();
      window.addEventListener("scroll", this.handleScroll);
    },
    methods: {
      initVideoPlayer(video_code, event) {
          event.target.parentElement.innerHTML =`
          <iframe
              src="https://www.youtube.com/embed/${video_code}?autoplay=1&mute=1" frameborder="0" allowfullscreen>
          </iframe>
          `
      },
      handleScroll() {
          if(service.isInViewport(this.$el) && !this.$el.classList.contains('loaded')) {
              let imageBlock = this.$el.querySelectorAll('.video-slider__img-wrap')[0];
              let self = this;
              let image = new Image();  
              image.onload = function(){
                  imageBlock.style.backgroundImage = `url(${self.image})`;
                  imageBlock.classList.add('loaded');
              } 
              image.src = this.image; 
          }
      }
    }
  }
</script>
