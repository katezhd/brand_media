<template>
  <div class="container">
    <div v-for="page in pages" :key="page.page">
      <Content :news="news.slice(page.first, page.last)" :blocks="blocks[page.page - 1]"></Content>
      <Inset :page="page.page"></Inset>
    </div>
  </div>
</template>

<script>
  import Content from '../rows/Content'
  import Inset from '../rows/Inset'

  export default {
      components: {
          Content,
          Inset,
      },
      props: ['news', 'blocks', 'lastIndex', 'firstIndex', 'pages'],
    }
</script>
