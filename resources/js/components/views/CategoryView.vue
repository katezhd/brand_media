<template>
  <div class="container" ref='scrollComponent'>
    <div class="list" v-if="category">
        <h1 class="list__title">Новости в категории</h1>
        <span class="list__name">{{ category.name }}</span>
    </div>
    <div class="row row--3pcs">
      <BlockCategory 
        v-for="article in news" 
        :key="article.id" 
        :article="article"></BlockCategory>
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
    <div class="news-error" v-if="!category">
      <Error></Error>
    </div>
  </div>
</template>

<script>
  import BlockCategory from '../blocks/BlockCategory'
  import Error from '../Error'
  import { ref, onMounted, onUnmounted } from 'vue'
  import service from '../../service'
  import { useRoute } from "vue-router"
  
  export default {
    name: 'categoryView',
    components: {
      BlockCategory,
      Error
    },
    setup () {
      let busy = false,
          totalPages,
          loading = ref(false),
          error = ref(false);
          
      
      const route = useRoute(),
            news = ref([]),
            category = ref({});

      let params = {
            page: 1,
            category: route.params.uri,
            status: 'visible',
            sort: 'published_at|desc',
          };

      if(params.page == 1) {
        getNewPortion ();
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
            params.page++;
            getNewPortion ();
        }
      }

      function getNewPortion () {
        if(params.page == 1 || totalPages >= params.page) {
          busy = true;
          loading.value = true;
          service.getNewsList(params).then((data) => {
            news.value.push(...data.data.news.data);
            totalPages = data.totalPages;
            busy = false;
            loading.value = false;
            if(params.page == 1) {
              category.value = data.data.category;
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
        category,
        loading,
        error,
        scrollComponent,
        getNewPortion
      }
    },
  }
</script>
