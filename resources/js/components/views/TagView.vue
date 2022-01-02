<template>
  <div class="container" ref='scrollComponent'>
    <div class="list" v-if="tag">
      <h1 class="list__title">Новости по тегу</h1>
      <span class="list__name">#{{ tag.name }}</span>
    </div>
    <div class="row row--3pcs">
      <Block v-for="article in news" 
        :key="article.id" 
        :article="article"
        class="block--sm"></Block>
    </div>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div class="news-error" v-if="error">
      <span>Не удалось загрузить. Попробуйте снова</span>
      <button @click="getNewPortion">
        <svg>
          <use xlink:href="#refresh"/>
        </svg>
      </button>
    </div>
    <div class="news-error" v-if="!tag">
      <Error></Error>
    </div>
  </div>
</template>

<script>
  import Block from '../blocks/Block'
  import Error from '../Error'
  import { ref, onMounted, onUnmounted } from 'vue'
  import service from '../../service'
  import { useRoute } from "vue-router"

  export default {
    name: 'tagView',
    components: {
      Block,
      Error
    },
    setup () {
      let busy = false,
          totalPages,
          loading = ref(false),
          error = ref(false);

      const route = useRoute(),
            news = ref([]),
            tag = ref({});

      let params = {
            page: 1,
            tag: route.params.uri,
            status: 'visible',
            sort: 'published_at|desc',
          };

      if(params.page == 1) {
        getNewPortion()
      }

      onMounted(() => {
        window.addEventListener("scroll", handleScroll)
      })

      onUnmounted(() => {
        window.removeEventListener("scroll", handleScroll)
      })

      const handleScroll = (e) => {
        let element = scrollComponent.value
        if (element.getBoundingClientRect().bottom < (window.innerHeight + 100) && !busy) {
          // if(totalPages > page) {
            params.page++;
            getNewPortion()
          // }
        }
      }

      function getNewPortion() {
        if(params.page == 1 || totalPages >= params.page) {
          busy = true;
          loading.value = true;
          service.getNewsList(params).then((data) => {
            let newsList = [];
            data.data.news.data.forEach(el => {
              newsList.push({
                id: el.id,
                name: el.name,
                image: el.image,
                category: el.category ? el.category.name : null,
                uri: el.uri
              })
            });
            news.value.push(...newsList);
            console.log(news.value);
            totalPages = data.totalPages;
            busy = false;
            loading.value = false;
            if(params.page == 1) {
              tag.value = data.data.tag;
            }
          }).catch(() => {
            loading.value = false;
            error.value = true;
          })
        }
      }
      
      const scrollComponent = ref(null)

      return {
        news,
        tag,
        loading,
        error,
        scrollComponent,
        getNewPortion
      }
    },
  }
</script>
