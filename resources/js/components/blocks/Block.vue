<template>
  <a v-if="article" :href='"/news/" + article.uri' class="block news-block" :data-source='article.source'>
    <div class="block__image"></div>
    <div v-if='article.category' class="block__badge"> {{ article.category }} </div>
    <span class="block__title">{{ article.name }}</span>
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
      if(this.article.image && this.article.image.indexOf('http') > -1) {
        this.article.image = this.article.image.split('/news/')[1];
      }
      this.image  = this.article.image && this.article.image != 'NULL' ? this.storage + this.article.image : this.image;

      this.handleScroll();
      window.addEventListener("scroll", this.handleScroll);
    },
    methods: {
      handleScroll() {
        if(service.isInViewport(this.$el) && !this.$el.classList.contains('loaded')) {
          let imageBlock = this.$el.querySelectorAll('.block__image')[0];
          let self = this;
          let image = new Image();  
          image.onload = function(){
            imageBlock.style.backgroundImage = `url(${self.image && typeof self.image != 'undefined' ? self.image : '/images/placeholders/placeholder.jpg'})`;
            self.$el.classList.add('loaded');
          } 
          image.src = this.image;           
        }
      }
    }
  }
</script>