<template>
  <a v-if="article" :href='"/news/" + article.uri' class="feed__item news-block" :data-source='article.source'>
    <span class="feed__title">
    {{ article.name }}
    </span>
    <time class="feed__time" datetime="09:54">{{ published_at }}</time>
  </a>
</template>

<script>
  import service from '../../service'

  export default {
    props: ['article'],
    setup(props) {
      if(props.article) {
        let published_at = service.getHumanTime(props.article.published_at);
  
        return {
          published_at
        }
      }
    },
  }
</script>