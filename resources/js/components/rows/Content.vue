<template>
  <div>
    <div class="row feed" v-if="news.slice(0, 4).length">
      <BlockFeed
        v-for="article in news.slice(0, 4)" 
        :key="article.id" 
        :article="article"></BlockFeed>
    </div>
    <div class="row" v-if="blocks.slice(1, 3).length">
      <Block 
        v-for="article in blocks.slice(1, 3)" 
        :key="article.id" 
        :article="article" 
        class="block--lg"></Block>
    </div>
    <div class="row" v-if="blocks.slice(3, 6).length">
      <Block 
        v-for="article in blocks.slice(3, 6)" 
        :key="article.id" 
        :article="article"
        class="block--sm"></Block>
    </div>
    <div class="row feed" v-if="news.slice(4, 8).length">
      <BlockFeed
        v-for="article in news.slice(4, 8)" 
        :key="article.id" 
        :article="article"></BlockFeed>
    </div>
  </div>
</template>

<script>
  import Block from '../blocks/Block'
  import BlockFeed from '../blocks/BlockFeed'

  export default {
    components: {
      Block,
      BlockFeed,
    },
    props: ['news', 'blocks']
  }
</script>
