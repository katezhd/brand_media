<template>
  <a :href='"/news/" + article.uri' class="swiper-slide category-block__item" :data-image='image'>
    <div class="category-block__img"></div>
    <div class="category-block__badge">{{ published_at }}</div>
    <span class="category-block__title">{{ article.name }}</span>
  </a>
</template>

<script>
  import service from '../../service'

  export default {
    props: ['article'],
    setup(props) {
      let published_at = service.getHumanDate(props.article.published_at);

      return {
        published_at
      }
    },
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
    updated() {
      this.handleScroll();
    },
    methods: {
      handleScroll() {
        if(service.isInViewport(this.$el) && !this.$el.classList.contains('loaded')) {
          let imageBlock = this.$el.querySelectorAll('.category-block__img')[0];
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
