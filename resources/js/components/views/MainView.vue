<template>
	<div ref='scrollComponent'>
    <PseudoDataItem v-if="preview">
    </PseudoDataItem>
		<DataItem :news="news" :blocks="blocks" :pages="pages"></DataItem>
    <div class="lds-ellipsis" v-if="loading"><div></div><div></div><div></div><div></div></div>
    <div class="news-error" v-if="error">
      <span>Не удалось загрузить. Попробуйте снова</span>
      <button @click="getNewPortion">
        <svg>
          <use xlink:href="#refresh"/>
        </svg>
      </button>
    </div>
	</div>
</template>
<script>
  import DataItem from './DataItem'
  import PseudoDataItem from './PseudoDataItem'
  import { ref, onMounted, onUnmounted } from 'vue'
  import service from '../../service'
  import { useRoute } from "vue-router"

export default {
  components: {
    DataItem,
    PseudoDataItem
  },
  props: ['except'],
  data() {
    return {
      preview: true,
    }
  },
  renderTriggered() {
    this.preview = false;
  },
  setup (props) {
    let perPage = 8,
        busy = false,
        totalPages,
        loading = ref(false),
        error = ref(false),
        firstIndex = ref(0),
        lastIndex = ref(0),
        pages = ref([]),
        blocksAmount = 5,
        showRecs = window.location.pathname.indexOf('news') > -1 ? true : false,
        params = {
          page: 1,
          except: props.except,
          status: 'visible',
          sort: 'published_at|desc',
          main: true
        };

    const route = useRoute();
    const news = ref([]);
    const reserve = ref([]);
    const blocks = ref([]);
    const recs = ref([]);

    if(params.page == 1) {
      getNewPortion();
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
          getNewPortion();
			}
		}

    function getInterests() {
      axios.get(`/recs.json`, {
        params: {
          path: '/news/' + route.params.uri,
        }
      }).then(({ data }) => {
        recs.value.push(...data.items);
      })
    }
    
    if(showRecs) {
      getInterests();
    }

    function getNewPortion () {
      if(params.page == 1 || totalPages >= params.page) {
        busy = true;
        loading.value = true;
        service.getserverNews(params).then((data) => {
          let serverNews = data.data.news,
              blockList = data.data.blocks,
              pageData = {
                page: params.page,
                last: perPage * serverNews.current_page,
                first: perPage * serverNews.current_page - perPage
              }
          pages.value.push(pageData);

          // Считаем кол-во новостей, которые нужно обрезать (вычесть блоки)
          let lastSlice = serverNews.data.length - blocksAmount;
          
          // Добавляем в резервный массив ненужные новости 
          reserve.value.push(...serverNews.data.slice(lastSlice));
          let newBlocks = [];

          // Если есть закрепленные блоки - добавляем их в массив с блоками
          if(blockList && blockList.length) {
            blockList.forEach(block => {
              let position = block.position.split('.')[1];
              if(block.is_promo == 1) {
                newBlocks[position] = makeBlockObject(block, 'promo');
              }
              if(!showRecs) {
                // Если нет рекомендаций
                newBlocks[position] = makeBlockObject(block, 'design');
              }
            });
          } 

          // recs.value.map(function(article){
          //   return article.source = 'recs';
          // })

          // Если в массиве с блоками есть новость из рекоммендаций - удаляем новость из рекоммендаций
          if(recs.value.length) {
            newBlocks.forEach((block) => {
              for (let i = 0; i < recs.value.length; i++) {
                if(block.id == recs.value[i].id) {
                  recs.value.splice(i, 1);
                }
              }
            });
          }

          // Если нет какого-то закрепленного блока - забираем из резервного массива, убираем новость из резервного массива
          for (let i = 1; i <= blocksAmount; i++) {
            if(!newBlocks[i]) {
              if(recs.value.length) {
                // Если есть рекомендации
                newBlocks[i] = makeBlockObject(recs.value[0], 'recs');
                recs.value = recs.value.slice(1);
              } else {
                // Если нет рекомендаций
                newBlocks[i] = makeBlockObject(reserve.value[0], 'block');
                reserve.value = reserve.value.slice(1);
              }
            }
          }

          // Проверяем, есть ли новости в резервном массиве
          if(reserve.value.length) {
            // Если есть, считаем сколько новостей мы можем забрать
            let pushLength = reserve.value.length >= perPage ? perPage : reserve.value.length;
            
            // Считаем, сколько нам еще нужно
            let remains = perPage - pushLength;
            if(pushLength < perPage) {
              // Если в резервном массиве недостаточно новостей
              // Добавляем в массив с новостями оставшееся из данных с сервера
              news.value.push(...serverNews.data.slice(0, remains));
            }

            // Добавляем в массив с новостями нужное кол-во и удаляем из из резервного массива
            news.value.push(...reserve.value.slice(0, pushLength));
            reserve.value = reserve.value.slice(pushLength);

            // Оставшиеся данные с сервера кладем в резервный массив
            reserve.value.push(...serverNews.data.slice(remains, lastSlice));
          } else {
            news.value.push(...serverNews.data.slice(0, lastSlice));
          }

          news.value.map(function(article){
            return article.source = 'feed';
          })

          blocks.value.push(newBlocks);

          totalPages = data.totalPages;
          busy = false;
          loading.value = false;
        }).catch(() => {
          loading.value = false;
          error.value = true;
        })
      }
      // console.log(document.querySelectorAll('.feed__title').length + document.querySelectorAll('.block--sm').length + document.querySelectorAll('.block--lg').length);
    }

    function makeBlockObject(block, source) {
      return {
              id: block.id,
              name: block.name ? block.name : block.title,
              image: block.image,
              category: block.category ? block.category.name : null,
              uri: block.uri ? block.uri : block.href.split('/news/')[1],
              source: source
            }
    }
    
		const scrollComponent = ref(null)
    
    return {
			news,
      blocks,
      loading,
      error,
			scrollComponent,
      getNewPortion,
      firstIndex,
      lastIndex,
      pages,
		}
  },
}
</script>